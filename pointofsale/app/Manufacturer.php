<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufactures';
    protected $fillable =['name','created_at','updated_at'];

    public static $rules = array(
        'name' => 'required',
    );

    public function addManufacturer($data) {
        $name = Manufacturer::where('name', $data['name'])->first();
        if(isset($name)) {
            return 'exist';
        }

        $model = Manufacturer::create($data);
        return $model;
    }
}