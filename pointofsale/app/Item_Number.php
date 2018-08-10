<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Item_Number extends Model
{
    protected $table = 'item_numbers';
    protected $fillable =['value','items_id','created_at','updated_at'];
}