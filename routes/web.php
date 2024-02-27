<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EmployeeHistoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
    // return view('welcome');
});

Auth::routes();

Route::get('/employees/{employee}', [UserController::class, 'showEmployee'])->name('employees.show');
Route::get('/users/{user}', [UserController::class, 'showUser'])->name('user.show');

// Route::get('/employees/{employee}/register-employee', [UserController::class, 'registerEmployee'])->name('user.registerEmployee');


// Route::middleware(['checkRole:company'])->group(function () {
//     // Routes accessible only to regular users
//     Route::get('/company/dashboard', 'UserController@dashboard');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/approval', [HomeController::class, 'approval'])->name('approval');
// Route::get('admin/home', [HomeController::class, 'admin'])->name('admin.home');
  
Route::group(['middleware' => ['auth']], function() {


    // Route::prefix('admin')->group(function () {



        Route::get('/get-employee-name/{cnic}', [EmployeeHistoryController::class, 'getEmployeeName']);
        Route::get('/check-number/{cnic}', [EmployeeHistoryController::class, 'checkNumber']);


    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::get('/users/{id}', [UserController::class,'show']);
    Route::get('/user/create', [UserController::class,'create']);

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('users/change-password', [UserController::class,'change_password'])->name('users.change-password');

    Route::resource('/employees', EmployeeController::class);
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employeehistory/detailsindex', [EmployeeHistoryController::class, 'create'])->name('employeeshistory.create');
    Route::get('/employee/detailsindex/{cnic}', [EmployeeController::class, 'detailsindex'])->name('employees.detailsindex');

    // Route::get('employee/show/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/destroy/{id}', [UserController::class, 'destroy'])->name('employee.destroy');
    Route::get('/users/approved/{id}', [UserController::class, 'approved'])->name('users.approve');
    Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/unapprove/{id}', [UserController::class, 'unapprove'])->name('users.unapprove');
    Route::get('add-user',[UserController::class,'add_user'] );

    //history
    Route::resource('/employeehistory', EmployeeHistoryController::class);
    Route::get('/employee/history/create', [EmployeeHistoryController::class, 'create'])->name('employeeshistory.create');
    Route::get('/employee/history/show/{usersid}', [EmployeeHistoryController::class, 'show'])->name('employeeshistory.show');
    Route::get('/employee/history', [EmployeeHistoryController::class, 'index'])->name('employeeshistory.index');
    Route::get('/employeehistory/detailsindex', [EmployeeHistoryController::class, 'create'])->name('employeeshistory.create');

    //job & job Application
    // Route::resource('jobs', JobController);
    // Route::resource('job-applications', JobApplicationController);


    Route::get('/usersnew/{user_id}', [UserController::class, 'show_user'])->name('user.show');

    Route::get('add-employee/{id}',[EmployeeController::class,'add_employee'] );


    Route::get('show-employee/{id}',[EmployeeController::class,'show_employee'] );

    Route::get('{id}/show-employee', [EmployeeController::class,'show_employee']);

        
    // Route::get('show-user/{id}',[UserController::class,'show_user'] );

    Route::get('show-users/{id}',[EmployeeController::class,'show_users'] );

    Route::get('index/{id}',[IndexController::class, 'index']);

    Route::get('show',[EmployeeController::class,'show_new']);

    // Route::get('showcompany',[EmployeeController::class,'show_company']);
    Route::get('/showcompany',[UserController::class,'showCompany'])->name('company.show');

        // Admin routes
        // Route::get('/dashboard', 'AdminController@dashboard');
        // Route::get('/users', 'AdminController@users');
        // Add more admin routes as needed
    // });
    
    Route::prefix('company')->group(function () {
        // User routes
        Route::get('/dashboard', [UserController::class, 'dashboard']);
        // Add more user routes as needed
    });

    // Route::resource('admin/roles', RoleController::class);
    // Route::resource('admin/users', UserController::class);
    // Route::resource('admin/employees', EmployeeController::class);
    // Route::get('admin/employees/destroy/{id}', [UserController::class, 'destroy'])->name('employee.destroy');
    // Route::get('admin/users/approved/{id}', [UserController::class, 'approved'])->name('users.approve');
    // Route::get('admin/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    // Route::get('admin/users/unapprove/{id}', [UserController::class, 'unapprove'])->name('users.unapprove');
    // Route::get('add-user',[UserController::class,'add_user'] );

    // Route::get('admin/usersnew/{user_id}', [UserController::class, 'show_user'])->name('user.show');

    // Route::get('add-employee/{id}',[EmployeeController::class,'add_employee'] );


    // Route::get('show-employee/{id}',[EmployeeController::class,'show_employee'] );

    // Route::get('{id}/show-employee', [EmployeeController::class,'show_employee']);

        
    // // Route::get('show-user/{id}',[UserController::class,'show_user'] );

    // Route::get('show-users/{id}',[EmployeeController::class,'show_users'] );

    // Route::get('index/{id}',[IndexController::class, 'index']);

    // Route::get('show',[EmployeeController::class,'show_new']);

    // Route::get('showcompany',[EmployeeController::class,'show_company']);

    Route::resource('products', ProductController::class);

    Route::get('/user/{id}',[UserController::class,'userdashboard'])->name('user.dashboard');

    Route::get('/dashboard', [UserController::class, 'dashboard']);

    Route::get('employee/search', [EmployeeController::class, 'search']);




});
?>