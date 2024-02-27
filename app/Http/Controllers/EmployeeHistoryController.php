<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;

use App\Models\EmployeeHistory;
use Illuminate\Http\Request;


class EmployeeHistoryController extends Controller
{

    // public function getEmployeeName($cnic)
    // {
    //     $employee = Employee::where('employees.name', $cnic)->first();

        
    //     // echo"<pre>";print_r($employee->name) ;die();
    //     if ($employee) {
    //         return response()->json(['name' => $employee->name]);
    //     } else {
    //         return response()->json(['name' => null]);
    //     }


    // }


    public function checkNumber($cnic)
    {
        
        $exists = Employee::where('cnic', $cnic)->first();
        
        if ($exists !== null) {
    return response()->json(['name' => $exists->name]);
        } 
        else {
            echo"error number exceeded!!";
        }
        

    }



    public function create(Request $request)
    {
        
        $employees = DB::table('employees')->select('employees.id as employee_id','employees.name as employee_name', 'employees.cnic as employee_cnic')->first();
   
        return view('employeehistory.create',compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        
        $validatedData = $request->validate([
            'name' => 'required|string', 
            'cnic' => 'required|digits:4', 
        ]);


        $user =  auth()->user();
        $employee = $user->employee;



        // dd( $request->all());
        $employee_cnic = Employee::where('cnic', $request->input('cnic'))->first();
     
    
        // if ($employee) {
        //     $employee_cnic = Employee::where('cnic', $request->input('cnic'))->first();
        // }
          
            // dd($employee_cnic);
            $employee_id ='';
            if($employee_cnic){
                // dd($employee_cnic);
                $employee_id = $employee_cnic->id;
            }else{
                $employee = $user->employee()->create([
                    'name' => $request->input('name'),
                    // 'Designation' => $request->input('Designation'),
                    'cnic' => $request->input('cnic'),
                    'users_id' => $user->id,
                ]);
                $employee_id = $employee->id;   
            }
    
            $user->employeeHistory()->create([
                'cnic'=> $request->input('cnic'),  
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'remarks' => $request->input('remarks'),
                'reviews' => $request->input('reviews'),
                'job_desc' => $request->input('job_desc'),
                'salary' => $request->input('salary'),
                'location' => $request->input('location'),
                'users_id' => $user->id,
                'employees_id' =>  $employee_id,     
            ]);
    
            return redirect()->route('employeehistory.index')
                            ->with('success','Employee history added  successfully.');

        }
       
  
    

    public function index()
    {
        $listusers = DB::table('employee_history')
    ->join('users', 'users.id','=','employee_history.users_id')
    ->join('employees', 'employees.id','=','employee_history.employees_id')
    ->select(
        'employee_history.id as id',
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
        )
    ->get();



            return view('employeehistory.index', compact('listusers'))->with('i', (request()->input('page', 1) - 1) * 5);
            
            

    }

    public function edit($id)
    {
        $employeeHistory = EmployeeHistory::findOrFail($id);

        return view('employeehistory.edit', compact('employeeHistory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'employees_id' => 'required',
            'position' => 'required',
            'remarks' => 'required',
            'reviews' => 'required',
            'job_desc' => 'required',
            'salary' => 'required|numeric',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $employeeHistory = EmployeeHistory::findOrFail($id);

        $employeeHistory->update($request->all());

        return redirect()->route('employeehistory.index')
            ->with('success', 'Employee history updated successfully');
    }

    // public function edit($id)
    // {
    //     $employees = DB::table('employee_history')
    //     ->join('users', 'users.id', '=', 'employee_history.users_id')
    //     ->join('employees', 'employees.id', '=', 'employee_history.employees_id')
    //     ->select(
    //         'employee_history.id as id',
    //         'users.name as users_id',
    //         'employees.name as employees_id',
    //         'employee_history.company_name',
    //         'employee_history.position',
    //         'employee_history.start_date',
    //         'employee_history.end_date',
    //         'employee_history.remarks',
    //         'employee_history.reviews',
    //         'employee_history.job_desc',
    //         'employee_history.location',
    //         'employee_history.salary',
    //     )
    //     ->where('employee_history.id', $id)
    //     ->first();
    //     // echo '<pre>'; print_r($employeeHistory); die();
    //     // $user = User::findOrFail($id);
    //     // $employeeHistory = EmployeeHistory::where('users_id', $user->id)->first();
            
    
    //     return view('employeehistory.edit', compact('employees'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'company_name' => 'required',
    //         'position' => 'required',
    //         'start_date' => 'required|date',
    //         'end_date' => 'nullable|date',
    //         'remarks' => 'nullable|string',
    //         'reviews' => 'nullable|string',
    //     ]);

    //     // Update the record in the database
    //     DB::table('employee_history')
    //         ->where('id', $id)
    //         ->update([
    //             'company_name' => $request->input('company_name'),
    //             'position' => $request->input('position'),
    //             'start_date' => $request->input('start_date'),
    //             'end_date' => $request->input('end_date'),
    //             'remarks' => $request->input('remarks'),
    //             'reviews' => $request->input('reviews'),
    //             'job_desc' => $request->input('job_desc'),
    //             'salary' => $request->input('salary'),
    //             'location' => $request->input('location'),
    //         ]);
    //     // $request->validate([
    //     //     'name' => 'required',
    //     // ]);
    
    //     // $user = User::findOrFail($id);
    //     // $user->update($request->all());
    
    //     // // Update associated employee history record
    //     // $employeeHistory = EmployeeHistory::where('users_id', $user->id)->first();
    //     // $employeeHistory->update([
    //     //     'company_name' => $request->input('company_name'),
    //     //     'position' => $request->input('position'),
    //     //     'reviews' => $request->input('reviews'),
    //     //     'remarks' => $request->input('remarks'),
    //     //     'start_date' => $request->input('start_date'),
    //     //     'end_date' => $request->input('end_date'),
    //     // ]);

    //     return redirect()->route('employeehistory.index')->with('success', 'History updated successfully.');
    
    // }

    public function show($usersId)
    {

        $employeeHistory = DB::table('employee_history')
        ->join('users', 'users.id', '=', 'employee_history.users_id')
        ->join('employees', 'employees.id', '=', 'employee_history.employees_id')
        ->select(
            // 'employee_history.id as id',
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
        )->where('employee_history.id', $usersId)
        // ->where('employee_history.id', $id)
        ->first();

        // $user = User:: join('employee_history', 'users.id', '=', 'employee_history.users_id')
        // ->select(
        // 'users.*',
        // 'employee_history.company_name', 
        // 'employee_history.position',
        // 'employee_history.start_date',
        // 'employee_history.end_date',
        // 'employee_history.remarks',
        // 'employee_history.reviews',
        // 'employee_history.job_desc',
        // 'employee_history.location',
        // 'employee_history.salary',
        // )->where('users.id', $usersId)
        // ->first();
        // echo '<pre>'; var_dump($user); die; 
        return view('employeehistory.show',compact('employeeHistory'));

        // $listusers['listusers'] = User:: join('employees_history', 'users.id', '=', 'employees_history.users_id')
        // ->select('users.*', 'employee_history.company_name', 'employee_history.position','employee_history.start_date','employee_history.end_date')
        //     ->get();
    }


    public function destroy(Request $request, $userId)
    {
        $user = EmployeeHistory::findOrFail($userId);
       
       $user->delete();
    
        return redirect()->route('employeehistory.index')
                        ->with('success','History deleted successfully');
                    }

                    
}


