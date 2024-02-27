<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class IndexController extends Controller
{
    public function index($id){
        $user = User::find($id);
        // var_dump($user->name);
        // dd($user->employee);

        foreach ($user->employee as $employee){
            echo $employee->name;
        }
    }

}
