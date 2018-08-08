<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions_access';
    protected $fillable =['user_id','customer_pemissions_id',
                        'item_kit_permissions_id','item_permissions_id','price_rules_permissions_id',
                        'supplier_permissions_id','report_permissions_id','receiving_permissions_id',
                        'sale_permissions_id','deliver_permissions_id','employee_permissions_id',
                        'gift_card_permissions_id','store_config','location_permissions_id',
                        'message_permissions_id','created_at','updated_at'];

}
{

}