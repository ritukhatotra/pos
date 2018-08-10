<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable =['users_id','item_name','categories_id','suppliers_id','UPC_EAN_ISBN',
                          'product_id','item_tags','manufactures_id','description',
                          'weight','dimension_length','dimension_height','dimension_width','is_service',
                          'items_has_serial_number','serial_number','item_photo','created_at','updated_at'];
}