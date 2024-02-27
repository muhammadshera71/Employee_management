<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';


    // public function user(){
    //     return $this->belongsTo(User::class,'id');

    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function employeeHistory()
    {
        return $this->hasMany(EmployeeHistory::class, 'employees_id');
    }
    // public function history()
    // {
    // return $this->hasMany(Employee::class);
    // }

    protected $fillable = [
        'name',
        'email',
        'Designation',
        'users_id',
        'status',
        'cnic',
        // '_token',
        
    ];

}
