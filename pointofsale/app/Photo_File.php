<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Photo_File extends Model
{
    protected $table = 'files';
    protected $fillable =['user_id','customer_id','suppliers_id','mime_types','extension',
        'name','created_at','updated_at'];
}