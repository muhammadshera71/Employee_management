<?php
    
namespace App\Http\Controllers;
    
use App\Models\Employee;
use App\Models\EmployeeHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

    
class EmployeeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','show']]);
         $this->middleware('permission:employee-create', ['only' => ['create','store']]);
         $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }


    public function getEmployeeName($cnic)
    {
        $employee = Employee::where('employees.name', $cnic)->get();

        // echo"<pre>";print_r($employee->name) ;die();
        if ($employee) {
            return response()->json(['name' => $employee->name]);
        } else {
            return response()->json(['name' => null]);
        }


    }


    public function checkNumber($cnic)
    {
        $exists = Employee::where('employees.cnic', $cnic)->exists();

        return response()->json(['exists' => $exists]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


 


     public function search(Request $request)
     {
       
         $search = $request['search'] ?? "";
       if($search !=""){
        $listusers['listusers']  =DB::table('employees')->select(

         'employees.id as id',
         'employees.name as employee_name',
         'employees.cnic as employee_cnic', 
         'employee_history.users_id as users_id',
         'users.name as company_name',
         'employee_history.start_date as latest_joining_date',
    
             DB::raw('MAX(employee_history.start_date) as latest_joining_date')
              )->where('employees.name', 'LIKE',"%$search%")->orWhere('cnic','LIKE',"%$search%")
                ->join('users', 'users.id', '=', 'employees.users_id')
                ->join('employee_history', 'users.id', '=', 'employee_history.users_id')
                ->orderBy('users_id', 'desc') 
                ->groupBy('employee_history.employees_id', 'users.name','users.id','id', 'employee_history.start_date', 'company_name')
                ->limit(1)
                ->get();

                // $latestUserId = EmployeeHistory::join('users', 'users.id', '=', 'employee_history.users_id')
                // ->orderBy('users.id', 'asc')
                // ->value('users.id');
                


            //    echo "<pre>";print_r($listusers);die();
                
                
                // $listusers ['listusers']= DB::table('employees')->select(
                //     'employees.id as id',
                //     'employees.name',
                //     'employees.cnic')
                // -> where('employees.name', 'LIKE',"%$search%")->orWhere('cnic','LIKE',"%$search%")
                // ->distinct()
                // ->get();

        //         $listusers ['listusers'] = DB::table('employee_history as history')
        //         ->join('employees', 'employees.id', '=', 'history.employees_id')
        //         ->join('users', 'users.id', '=', 'history.users_id')
        //         ->select('employees.name', 'employees.id as id', 'employees.cnic', 
        //         'history.users_id as users_id',
        //         'users.name as company_name',

        //            DB::raw('MAX(start_date) as latest_joining_date'),
        //             DB::raw('AVG(history.reviews) as average_rating'),
        //             DB::raw('MAX(history.id) as company_id')
        //             )
                    
        //          -> where('employees.name', 'LIKE',"%$search%")->orWhere('cnic','=',"$search")
        //          ->groupBy('history.employees_id', 'users.name',
        //           'users_id')
        //    ->get();

        
    //     $subQuery = DB::table('employee_history as history')
    //     ->select(
    //       'history.users_id as users_id',
    //             'users.name as company_name',
    //             'history.employees_id', 'users.name',)
        
    //     ->groupBy('users_id');

    //    echo "<pre>";print_r( $subQuery);die();
           
       

    // $listusers['listusers'] = DB::table('employee_history as history')
    //     ->join('employees', 'employees.id', '=', 'history.employees_id')
    //     ->join('users', 'users.id', '=', 'history.users_id') // Add this join
    //     ->select(
    //         'employees.name as employee_name',
    //         'employees.id as employee_id',
    //         'employees.cnic',
    //         DB::raw('AVG(history.reviews) as average_rating'),
    //         DB::raw('MAX(history.start_date) as latest_joining_date'),
    //         'users.name as users_name' // Include users_name
    //     )
    //     ->where('employees.name', 'LIKE', "%$search%")
    //     ->orWhere('cnic', 'LIKE', "%$search%")
    //     ->groupBy('employees.name', 'employees.cnic', 'id', 'users.name')
    //     ->get();

            

            
            
            // echo "<pre>";print_r($listusers);die();
            
            }
            else{ 
            //       if(Auth::user()->hasRole('Admin')){
            //         $listusers['listusers'] = DB::table('employees')->select(
            //             'employees.id as id',
            //             'employees.name',
            //             'employees.cnic')
            //         -> where('employees.name', 'LIKE',"%$search%")->orWhere('cnic','LIKE',"%$search%")
            //         ->distinct()
            //         ->get();
            // }else{   
            //     $listusers['listusers'] = DB::table('employees')->select(
            //         'employees.id as id',
            //         'employees.name',
            //         'employees.cnic')
            //         ->distinct()
                    
                    
            //         -> where('employees.name', 'LIKE',"%$search%")->orWhere('cnic','LIKE',"%$search%")->get();
            //         // echo "<pre>";print_r($listusers);die();
            // }
            $listusers =[];
            return view('employees.search',compact('listusers'));

            }

            // echo"<pre>";print_r($listusers);die();
            
       

        return view('employees.search',compact('listusers','search')) ->with($listusers,$search);
     }
    //  public function add_employee($id){
    //     $user = User::find($id);
    //         $employee = new Employee();
    //         $employee -> name = "employee 1";
    //         $employee -> phone = "03059869600";
    //         $user -> employee()-> save($employee); 
    //  }


        // get employee based on user id
    //  public function show_employee($id){
    //     $employee = User::find($id)->employee;
    //     return $employee;
    //  }

    //  public function show_new(){

    //     return DB::table('users')
    //     ->join('employees', 'users.id', '=', 'employees.id')
    //     ->get();
    //  }

    //  public function show_company(){

    //     return DB::table('users')
    //     ->join('company', 'users.id', '=', 'company.id')
    //     ->get();
    //  }

        //get 

        

    public function updateStatus(Request $request, $employeeId)
{
    $employee = User:: join('employees', 'users.id', '=', 'employees.users_id')
    ->select('users.*')
    ->get();

    $request->validate([
        'newStatus' => 'required|in:active,inactive,terminated,on_leave', // Add other valid status values as needed
    ]);

    $employee->statusHistory()->create([
        'status' => $request->input('newStatus'),
    ]);

    return redirect()->back()->with('success', 'Status updated successfully.');
}

    public function index(Request $request)
    {

        

        
              if(Auth::user()->hasRole('Admin')){

            $listusers['listusers'] = DB::table('employees')->select(
                    'employees.id as id',
                    'employees.name',
                    'employees.cnic',
                    'employees.status',
                    )
            ->get();
        }else{

            $listusers['listusers'] = DB::table('employees')->select(
                'employees.id as id',
                'employees.name',
                'employees.cnic',
                'employees.status',
                ) ->where('users_id', auth()->user()->id)
        ->get();
            
            // $listusers['listusers'] = User::join('employees', 'users.id', '=', 'employees.users_id')
            // ->where('users_id', auth()->user()->id)
            // ->select('users.*', 'employees.Designation' , 'employees.cnic', 'employees.status')
            // ->get();
        }
        

        return view('employees.index',compact('listusers')) ->with($listusers)->with('i', (request()->input('page', 1) - 1) * 5);
   
    }

    public function detailsindex($cnic)
    {

        $employees = DB::table('employee_history')->join('users', 'users.id','=','employee_history.users_id')
        ->join('employees', 'employees.id','=','employee_history.employees_id')->select(
                'employees.id as id',
                'employees.cnic as cnic',
                'users.name as users_name',
                'employees.name as employees_name',
                'employee_history.company_name',
                'employee_history.position',
                'employee_history.start_date',
                'employee_history.end_date',
                'employee_history.remarks',
                'employee_history.reviews',
                'employee_history.job_desc',
                'employee_history.location',
                'employee_history.salary',
            )->where('cnic', $cnic)
        ->get();



        // echo"<pre>";print_r($employees);die();
        

        return view('employees.detailsindex',compact('employees'))->with('i', (request()->input('page', 1) - 1) * 5);
   
    }



    // public function show_users(){

        
    //     $listusers['listusers'] = Employee::with('user')->where('users_id','=',Auth::user()->id)->get();
    // //    return $users;
    //    return view('employees.index',compact('listusers'))->with($listusers) ->with('i', (request()->input('page', 1) - 1) * 5);
    //  }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = DB::table('employees')->select('employees.id as employees_id','employees.status as employees_status')->get();
        return view('employees.create',compact('employees'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $user = User::find($id);

        // request()->validate([
        //     'name' => 'required',
        // ]);
        // $request->merge(['parent_id' => auth()->user()->id]);

        $user =  auth()->user();

        // $user = User::create($request->all());
        // echo 'pre'; print_r($user ); die;

        $employee = $user->employee()->create([
        'name' =>$request ->input ('name'),
        // 'Designation' => $request->input('Designation'),
        'cnic' => $request->input('cnic'),
        'users_id' => $user->id   ]);

        

    //    var_dump($ok); die;
        return redirect()->route('employees.index')
                        ->with('success','Employee added  successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($usersId)
    {
        $user = User:: join('employees', 'users.id', '=', 'employees.users_id')
        ->select('users.*', 'employees.cnic','employees.status')->where('users.id', $usersId)
        ->first();
        // var_dump($user); die;
        // $user = User::with('employee.Designation')->findOrFail($usersId);
        return view('employees.show',compact('user'));
    }

    

//     public function show($id)
// {
//     // Retrieve the employee based on the parent_id
//     $employee = Employee::where('users_id', $id)->first();

//     // Check if the employee is found
//     if (!$employee) {
//         return redirect()->route('employees.index')->with('error', 'Employee not found.');
//     }

//     // You can customize the view file name according to your project structure
//     return view('employees.show', compact('employee'));
// }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     return view('employees.edit',compact('user'));
    // }
    
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Employee  $employee
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, User $user)
    // {
    //      request()->validate([
    //         'name' => 'required',
    //         'Designation' => 'required',
    //     ]);
    
    //     $user->update($request->all());
    
    //     return redirect()->route('employees.index')
    //                     ->with('success','employee updated successfully');
    // }
    



    public function edit($usersId)
    {
        $user = User:: join('employees', 'users.id', '=', 'employees.users_id')
        ->select('users.*',   'employees.cnic')->where('users.id', $usersId)
        ->first();
        return view('employees.edit', compact('user'));
    }


    public function update(Request $request, $usersId)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            // 'Designation' => 'required',
            'cnic' => 'required',
            'status' => 'required',
        ]);

        $user = User:: where('id', $usersId)->first();
        // $user = User::findOrFail($userId);
        $employee = Employee::where('users_id', $user->id)->first();;
        
        $user->name = $request->name;
        $user->save();

    //    $employee->Designation = $request->input('Designation');
    //    $employee->save();

       $employee->cnic = $request->input('cnic');
       $employee->save();

       $employee->status = $request->input('status');
       $employee->save();  

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $userId)
    {
        $user = User::findOrFail($userId);


        $employee = $user->employee;

        if ($employee) {
        
            $employee->delete();

            return redirect()->route('employees.index')
                            ->with('success', 'Employee deleted successfully.');
        } else {
            return redirect()->route('employees.index')
                            ->with('error', 'Employee not found.');
        }

                    }
                }