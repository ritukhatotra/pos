<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =['users_id','parent_category_id','name','color','image','created_at','updated_at'];
}