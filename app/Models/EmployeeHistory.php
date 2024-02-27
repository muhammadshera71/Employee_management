<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    use HasFactory;

    protected $table = 'employee_history';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employees_id');
    }

    // public function averageRating($employeeId)
    // {
    //     $totalRatings = DB::table('employee_history')
    //         ->where('employee_id', $employeeId)
    //         ->whereNotNull('reviews') 
    //         ->count();

    //     if ($totalRatings > 0) {
    //         $sumOfRatings = DB::table('employee_history')
    //             ->where('employee_id', $employeeId)
    //             ->whereNotNull('reviews')
    //             ->sum('reviews');

    //         $averageRating = $sumOfRatings / $totalRatings;


    //         return $averageRating;
    //     } else {
    //         return 0; 
    //     }
    // }


    protected $fillable = [
        'users_id',
        'employees_id',
        'position',
        'start_date',
        'end_date',
        'remarks',
        'reviews',
        'job_desc',
        'salary',
        'location',
    ];

}
