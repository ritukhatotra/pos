<?php
namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    ** all items
    */
    public function itemList() {
        $data['page_title'] = "POS | Admin | Items";
        $data['current_url'] = url()->current();
        $data['item_count'] =  DB::table('items')->count();
        $data['items'] = DB::table('items')->orderBy('id','desc')->paginate(10);

        return view('admin.item.items', $data);
    }

    /*
    ** new item
    */
    public function newItem() {
        $data['page_title'] = "POS | Admin | Add Item";
        $data['current_url'] = url()->current();
        $data['categories'] = Category::all();
        $data['manufacturers'] = Manufacturer::all();
        return view('admin.item.add_item', $data);
    }

    /*
    ** new Item Variation
    */
    public function redirect(Request $request) {
        $data['page_title'] = "POS | Admin | Add Item";
        $data['current_url'] = env('APP_URL').'admin/new-item/redirect';
        $data['item_id'] = $request->get('id');
        $data['type'] = $request->get('type');
        $data['item'] = Item::find($data['item_id']);
        return view('admin.item.add_item_variation', $data);
    }
}