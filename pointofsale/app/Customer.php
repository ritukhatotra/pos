<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable =['first_name','last_name','email','phone','profile_photo',
        'address1','address2','comments','city','states_id','countries_id','zip',
        'store_account_balance','credit_limit','disable_loyality','amount_to_spend_for_next_pt',
        'points','company_name','account','override_default_sale','texable','tax_group','tax1_name',
        'tax1_value','tax2_name','tax2_value','non_tax_certificate_number','commulative','created_at','updated_at'];

    public static $rules = array(
        'first_name' => 'required'
    );
}