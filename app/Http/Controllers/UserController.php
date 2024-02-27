<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\Employee;
use App\Models\User;
 use App\Models\Employee;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request): View
    // {
    //     $data = User::latest()->paginate(5);
  
    //     return view('admin.users.index',compact('data'))
    //         ->with('i', ($request->input('page', 1) - 1) * 5);
    // }

    public function showCompany($companyId)
    {
        $company = User::findOrFail($companyId);

        $user = $company->user;
        echo '<pre>';print_r( $user ); die;

        return view('employee.show', compact('user', 'company'));
    }


    public function showEmployee($employeeId)
    {
        $employee = User::findOrFail($employeeId);

        // Retrieve the employee's company
        $user = $employee->user;

        return view('employee.show', compact('employee', 'user'));
    }

    public function showUser($userId)
    {
        $user = User::findOrFail($userId);


        $employees = $user->employees;

        return view('companies.show', compact('user', 'employees'));
    }

    // public function add_user(){
    //     $user = new User();
    //     $user->name = 'new user';
    //     $user->email = 'muhamadshera71@gmail.com';
    //     $user->password = '12345678';
    //     $user->save();
    // }

    // public function registerEmployee(Request $request, $userId)
    // {
    //     // Find the company
    //     $user = User::find($userId);

    //     if (!$user) {
    //         return redirect()->route('users.index')->with('error', 'Company not found.');
    //     }

    //     $usernew = new User([
    //         'name' => $request->input('name'),
    //         'Designation' => $request->input('Designation'),
         
    //     ]);
    
    //     // Save the employee associated with the company
    //     $user->employee()->save($usernew);
    
    // }

   

    //get user on employee id
    // public function show_user($id){
    //     $user = Employee::find($id)->user;
    //    return $user;
    //  }

    //  public function show_users(){

      
    //     $listusers['listusers'] = Employee::with('user')->where('users_id','=',Auth::user()->id)->get();
    // //    return $users;
    //    return view('Employees.index')->with($listusers) ->with('i', (request()->input('page', 1) - 1) * 5);
    //  }





    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id','DESC')->with('roles')->get();
            // echo "<pre>"; print_r($data); die;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    $roles='';
                    $mroles = $row->getRoleNames();
                    if(!empty($mroles)){
                        foreach($mroles as $v){
                            $roles .='<label class="badge badge-success">'.$v.'</label>';
                        }
                    }
                    return $roles ;
                })
                ->addColumn('action', function($row){
                    // $url = "/notification/delete/".$row->id;
                    // $btn = '<a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                    // $btn .= ' <a href="'.@url("/meeting/$row->meeting_id/participent".$row->id).'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';
                    $btn='';
                    if (Gate::allows('approve-user')){
                        $btn .=' <a class="btn btn-xs btn-info" href="'.route('users.show',$row->id).'"><i class="fas fa-eye"></i></a>';
                        if($row->client_id > 0 && $row->is_approved=='on'){
                        $btn .=' <a class="btn btn-xs btn-primary" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-check"></i></a>';
                        }elseif($row->client_id == '' && $row->is_approved=='ban'){
                        $btn .= ' <a class="btn btn-xs btn-danger" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-ban"></i></a>';
                        }else{
                            $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('users.approve',$row->id).'"><i class="fas fa-check"></i></a>';
                        $btn .= ' <a class="btn btn-xs btn-danger" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-ban"></i></a>';
                        }
                    }
                    $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('users.edit',$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                    $url = route("users.destroy", $row->id);
                    $btn .= ' <a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                       
                    return $btn;
                })
                ->addColumn('rownum', function ($row) {
                    return '';
                })
                ->rawColumns(['rownum','roles', 'action'])
                ->make(true);
        }
        $data['pageTitle'] = 'Users';
        $data['userListActive'] = 'active';
        $data['userOpening'] = 'menu-is-opening';  
        $data['userOpend'] = 'menu-open';
        return view('admin.users.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id): View
    // {
    //     $user = User::find($id);
    //     return view('admin.users.show',compact('user'));
    // }
    public function show($id)
    {
        $user = User::find($id);
        $pageTitle = 'View User';
        $userListActive = 'active';
        $userOpening = 'menu-is-opening';
        $userOpend = 'menu-open';
        return view('admin.users.show',compact('user', 'pageTitle', 'userListActive', 'userOpening', 'userOpend'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        $user = User::find(Auth::user()->id);
        $pageTitle = 'Change Password';
        $profileActive = 'active';
        $profileOpening = 'menu-is-opening';
        $profileOpend = 'menu-open';
    
        return view('admin.users.change-password',compact('user', 'pageTitle', 'profileActive', 'profileOpening', 'profileOpend'));
    }
    public function update_password(Request $request){
        $validator = Validator::make($request->all(), [
            'old-password' => 'required',
            'password' => 'required|string|min:8|same:confirm-password',
        ]);
        
        if ($validator->fails()) {
            return redirect('change-password')
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::find($request->id);
        if (Hash::check($request->input('old-password'), $user->password)) {
            // Update the user's password with the new password
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // Redirect to a success page or return a response
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            // If the current password is incorrect, show an error message
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect'])->withInput();
        }

    }
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id): RedirectResponse
    // {
    //     User::find($id)->delete();
    //     return redirect()->route('users.index')
    //                     ->with('success','User deleted successfully');
    // }
    public function destroy($id)
    {
        if(User::find($id)->delete()){
            return 'ok';
        }else{
            return 'notok';
        }
    }

    public function show_user()
    {
        // You can now use $userId as the user ID
        // Make sure to validate and sanitize the input as needed
        
        // Example: Retrieve user details by ID
        $user = Auth::user();

        // Get the user ID
        $userId = $user->id;

        // Your logic here...

     
        return view('admin.dashboard', compact('userId'));
    }

    public function dashboard(){

        $totalUsers = User::count();
        $totalUsers =  $totalUsers-1;

        $user =  auth()->user();
        //  echo '<pre>';print_r( $user ); die;
        $totalEmployeesForCurrentUser = $user->employee()->count();
         

        $totalEmployees = Employee::count();



        return view('admin.dashboard', compact('totalUsers', 'totalEmployees','totalEmployeesForCurrentUser'));
    }

    public function userdashboard(Request $request, $id){
        return view('admin.dashboard',  ['userId' => $id]);
    }

    public function approved($id)
    {

        // $settings = AppSettingsModel::create();
        $user = User::find($id);
        // $user->client_id = $settings->id;
        $user->is_approved = 'on';
        $user->save();
        
        $roles = ['company'];
        $user->assignRole($roles);
        return redirect()->route('users.index')->with('success','User created successfully');
    }

    public function unapprove($id)
    {
        $user = User::find($id);
        $user->is_approved = 'ban';
        $user->save();
        
        return redirect()->route('users.index')->with('success','User updated successfully');
    }
}

?>