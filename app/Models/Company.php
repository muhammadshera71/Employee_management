<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // public function history()
    // {
    // return $this->hasMany(Employee::class);
    // }

    protected $table = 'company';

    protected $fillable = [
        'name',
        'email',
        'short_desc',
        'phone',
        'poc',
        'number_of_employees',
        'address',
        'ntn',
        'linkedin_address',
        'website_address',
        'type',
        'users_id',
        // '_token',
        
    ];


}
