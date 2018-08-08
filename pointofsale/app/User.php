<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $fillable =['first_name','last_name','email','username','password','phone','profile_photo',
        'address1','address2','comment','city','zip','states_id','countries_id','doj','dob','commission_percent',
        'language','user_roles_id','force_password_changed','always_required_password','status',
        'reason_for_status_inactive','inactive_date','remember_token','commission_percent_type','hourly_pay_rate',
        'created_at','updated_at'];

    public static $rules = array(
        'first_name' => 'required',
        'email' => 'required|users:unique',
        'username' => 'required|users:unique',
        'phone' => 'users:unique',
        'address' => 'required',
        'emp_no' => 'users:unique',
        'language' => 'required'
    );

    protected $hidden = [
        'password', 'remember_token'
    ];    
}
