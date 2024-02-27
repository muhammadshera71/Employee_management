<?php
  
namespace App\Models;
  

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

  
class User extends Authenticatable
{
    use AuthenticatableTrait;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    // public function employee(){
    //     return $this->belongsTo(Employee::class,'users_id');
    // }
    public function employee()
    {
        return $this->hasOne(Employee::class,'users_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class,'users_id');
    }

    public function jobs()
    {
    return $this->hasMany(Job::class);
    }

    public function employeeHistory()
    {
        return $this->hasMany(EmployeeHistory::class, 'users_id');
    }

//    protected $guard_name = 'web';


  
    // protected $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    // public function employee(){
    //         return $this->hasMany(Employee::class);
    // }

    protected $fillable = [
        'name',
        'email',
        'password',
        'approved',
        'parent_id',

    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $approved;
}

?>
