<?php
namespace App\Http\Controllers;
use App\Country;
use App\Customer;
use App\Item;
use App\Item_Number;
use App\Manufacturer;
use App\State;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /*
    ** get state by country id
    */
    public function getState(Request $request){
        $country_id =  $request->get('country_id');
        if(isset($country_id)) {
            $states = State::where('country_id', $country_id)->get();
            foreach($states as $state) {
                echo '<option value='.$state['id'].'>'.$state['name'].'</option>';
            }
        }
    }

    /*
    ** Check duplicate email
    */
    public function checkCustomerEmail(Request $request) {
        $email = $request->get('email');
        $customer = Customer::where('email', $email)->first();
        if(isset($customer)) {
            return "exist";
        }
        return "success";
    }

    /*
    ** Check duplicate phone no.
    */
    public function checkCustomerPhone(Request $request) {
        $phone = $request->get('phone');
        $customer = Customer::where('phone', $phone)->first();
        if(isset($customer)) {
            return "exist";
        }
        return "success";
    }

    /*
    ** Check duplicate account no.
    */
    public function checkCustomerAccount(Request $request) {
        $acc = $request->get('acc');
        $customer = Customer::where('account', $acc)->first();
        if(isset($customer)) {
            return "exist";
        }
        return "success";
    }

    /* search customer */
    public function searchData(Request $request){
        $name = $request->get('name');
        $type = $request->get('type');
        if($type == 'customer'){
            $customers =Customer::where(function($query) use ($name){
                $query->orWhere('first_name', 'like', '%'.$name.'%');
                $query->orWhere('last_name', 'like', '%'.$name.'%');
            })
                ->get();
            $lastname = NULL;
            if(isset($customers)) {
                foreach($customers as $customer) {
                    if(isset($customer['last_name'])){
                        $lastname = $customer['last_name'];
                    }
                    $html = '<li onclick="getData('.$customer['id'].',\''.$type.'\')">';
                    $html .= '<div class="search-img">';
                    if (isset($customer['profile_photo'])) {
                        $html .= '<img src="' . env('APP_URL') . 'public/uploads/customer/' . $customer['profile_photo'] . '" alt="">';
                    } else {
                        $html .= '<img src="' . env('APP_URL') . 'public/images/avatar-default.jpg'.'" alt="">';
                    }
                    $html .= '</div>';
                    $html .= '<p>';
                    $html .= '<span class="srch-name">' . ucfirst($customer['first_name']) . ' ' . ucfirst($lastname).' '.'('.$customer['id'].')'.'</span>';
                    if(isset($customer['email'])) {
                        $html .= '<span class="srch-email">' . $customer['email'] . '</span>';
                    }
                    if(isset($customer['phone'])) {
                        $html .= '<span class="srch-email">' . $customer['phone'] . '</span>';
                    }
                    $html .= '</p></li>';
                    echo $html;
                }
            } else {
                $html = '<li>Search result empty</li>';
                echo $html;
            }
        } elseif($type == 'employee') {
            $users =User::where(function($query) use ($name){
                $query->orWhere('first_name', 'like', '%'.$name.'%');
                $query->orWhere('last_name', 'like', '%'.$name.'%');
                $query->orWhere('email', 'like', '%'.$name.'%');
            })
            ->where('user_roles_id', 2)
            ->get();
            $lastname = NULL;
            if(isset($users)) {
                foreach($users as $user) {
                    if(isset($user['last_name'])){
                        $lastname = $user['last_name'];
                    }
                    $html = '<li onclick="getData('.$user['id'].',\''.$type.'\')">';
                    $html .= '<div class="search-img">';
                        if (isset($user['profile_photo'])) {
                            $html .= '<img src="' . env('APP_URL') . 'public/uploads/employee/' . $user['profile_photo'] . '" alt="">';
                        } else {
                            $html .= '<img src="' . env('APP_URL') . 'public/images/avatar-default.jpg'.'" alt="">';
                        }
                    $html .= '</div>';
                    $html .= '<p>';
                        $html .= '<span class="srch-name">' . ucfirst($user['first_name']) . ' ' . ucfirst($lastname).' '.'('.$user['id'].')'.'</span>';
                        if(isset($user['email'])) {
                            $html .= '<span class="srch-email">' . $user['email'] . '</span>';
                        }
                        if(isset($user['phone'])) {
                            $html .= '<span class="srch-email">' . $user['phone'] . '</span>';
                        }
                    $html .= '</p></li>';
                    echo $html;
                }
            } else {
                $html = '<li>Search result empty</li>';
                echo $html;
            }
        }

    }

    /* display search customer */
    public function displayData(Request $request){
        $id = $request->get('id');
        $type = $request->get('type');
        if($type == 'customer') {
            $customer = Customer::find($id);
            $country_name = '';
            if(isset($customer->countries_id)){
                $country = Country::find($customer->countries_id);
                $country_name = $country->name;
            }
            $html = '<tr>
                <td>
                    <input type="checkbox" value="" />
                    <label><span></span></label>
                </td>
                <td>
                    <div class="piluku-dropdown dropdown btn-group table_buttons upordown">
                        <a href="'.env('APP_URL').'admin/customer/edit/'.$customer->id.'" class="btn btn-more edit_action" title="Update">
                            Edit
                        </a>
                    </div>
                </td>
                <td>'.$customer->id.'</td>
                <td class="first_name hidden">'.ucfirst($customer->first_name).'</td>
                <td class="last_name hidden">';
                    if(isset($customer->last_name)) {
                        $html .= ucfirst($customer->last_name);
                    }
                $html .= '</td>
                <td>
                    <a href="#">';
                        if(isset($customer->last_name)) {
                            $html .= ucfirst($customer->first_name) . ' ' . ucfirst($customer->last_name);
                        } else {
                            $html .= ucfirst($customer->first_name);
                        }
                    $html .= '</a>
                </td>
                <td>';
                    if(isset($customer->email)) {
                        $html .= $customer->email;
                    }
                $html .= '</td>
                <td>';
                    if(isset($customer->phone)) {
                        $html .= $customer->phone;
                    }
                $html .= '</td>
                <td class="address1 hidden">';
                    if(isset($customer->address1)) {
                        $html .= $customer->address1;
                    }
                $html .= '</td>
                <td class="address2 hidden">';
                    if(isset($customer->address2)) {
                        $html .= $customer->address2;
                    }
                $html .= '</td>
                <td class="zip hidden">';
                    if(isset($customer->zip)) {
                        $html .= $customer->zip;
                    }
                $html .= '</td>
                <td class="company hidden">';
                    if(isset($customer->company_name)) {
                        $html .= $customer->company_name;
                    }
                $html .= '</td>
                <td class="account hidden">';
                    if(isset($customer->account)) {
                        $html .= $customer->account;
                    }
                $html .= '</td>
                <td class="country hidden">';
                    if($country_name != '') {
                        $html .= $country_name;
                    }
                $html .= '</td>
                <td>';
                    if(isset($customer->profile_photo)){
                        $html .= '<a href="'. env('APP_URL') .'public/uploads/customer/'. $customer->profile_photo.'">';
                            $html .= '<img src="'. env('APP_URL') .'public/uploads/customer/'. $customer->profile_photo.'" class="img-polaroid" width="45">';
                        $html .= '</a>';
                    } else {
                        $html .= '<a href="'. env('APP_URL') .'public/images/avatar-default.jpg">';
                            $html .= '<img src="'. env('APP_URL') .'public/images/avatar-default.jpg" class="img-polaroid" width="45">';
                        $html .= '</a>';
                    }
                $html .= '</td>
            </tr>';
        } elseif($type == 'employee') {
            $user = User::find($id);
            $country_name = '';
            if(isset($customer->countries_id)){
                $country = Country::find($user->countries_id);
                $country_name = $country->name;
            }
            $html = '<tr>
                <td>
                    <input type="checkbox" value="" />
                    <label><span></span></label>
                </td>
                <td>
                    <div class="piluku-dropdown dropdown btn-group table_buttons upordown">
                        <a href="'.env('APP_URL').'admin/employee/edit/'.$user->id.'" class="btn btn-more edit_action" title="Update">
                            Edit
                        </a>
                    </div>
                </td>
                <td>'.$user->id.'</td>
                <td class="first_name hidden">'.ucfirst($user->first_name).'</td>
                <td class="last_name hidden">';
                if(isset($user->last_name)) {
                    $html .= ucfirst($user->last_name);
                }
                $html .= '</td>
                <td>
                    <a href="#">';
                        if(isset($customer->last_name)) {
                            $html .= ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                        } else {
                            $html .= ucfirst($user->first_name);
                        }
                    $html .= '</a>
                </td>
                <td>';
                    if(isset($user->email)) {
                        $html .= $user->email;
                    }
                $html .= '</td>
                <td>';
                    if(isset($user->phone)) {
                        $html .= $user->phone;
                    }
                $html .= '</td>
                <td class="address1 hidden">';
                    if(isset($user->address1)) {
                        $html .= $user->address1;
                    }
                $html .= '</td>
                <td class="address2 hidden">';
                    if(isset($user->address2)) {
                        $html .= $user->address2;
                    }
                $html .= '</td>
                <td class="zip hidden">';
                    if(isset($user->zip)) {
                        $html .= $user->zip;
                    }
                $html .= '</td>
                <td class="company hidden">';
                    if(isset($user->company_name)) {
                        $html .= $user->company_name;
                    }
                $html .= '</td>
                <td class="account hidden">';
                    if(isset($user->account)) {
                        $html .= $user->account;
                    }
                $html .= '</td>
                <td class="country hidden">';
                    if($country_name != '') {
                        $html .= $country_name;
                    }
                $html .= '</td>
                <td>';
                    if(isset($user->profile_photo)){
                        $html .= '<a href="'. env('APP_URL') .'public/uploads/employee/'. $user->profile_photo.'">';
                            $html .= '<img src="'. env('APP_URL') .'public/uploads/employee/'. $user->profile_photo.'" class="img-polaroid" width="45">';
                        $html .= '</a>';
                    } else {
                        $html .= '<a href="'. env('APP_URL') .'public/images/avatar-default.jpg">';
                            $html .= '<img src="'. env('APP_URL') .'public/images/avatar-default.jpg" class="img-polaroid" width="45">';
                        $html .= '</a>';
                    }
                $html .= '</td>
            </tr>';
        }
        echo $html;
    }

    /*
    ** Check duplicate user email
    */
    public function checkEmployeeEmail(Request $request) {
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if(isset($user)) {
            return "exist";
        }
        return "success";
    }

    /*
    ** Check duplicate phone no.
    */
    public function checkEmployeePhone(Request $request) {
        $phone = $request->get('phone');
        $user = User::where('phone', $phone)->first();
        if(isset($user)) {
            return "exist";
        }
        return "success";
    }

    /*
    ** Check duplicate account no.
    */
    public function checkUsername(Request $request) {
        $acc = $request->get('acc');
        $user = User::where('username', $acc)->first();
        if(isset($user)) {
            return "exist";
        }
        return "success";
    }

    /*
    ** save item
    */
    public function saveItem (Request $request) {
        $name = Item::where('item_name', $request->get('item_name'))->first();
        if(isset($name)) {
            return 'exist';
        }

        if($request->get('UPC_EAN_ISBN')) {
            $upc = Item::where('UPC_EAN_ISBN', $request->get('UPC_EAN_ISBN'))->first();
            if (isset($upc)) {
                return 'exist_upc';
            }
        }

        $item = Item::create($request->except(['item_numbers_id','item_photo']));
        if ($request->file('image')) {
            $file = $request->file('image');
            $name = $item->item_name.'_'.rand().'.'.$file->getClientOriginalExtension();
            $file->move('./public/uploads/item', $name);
            $arr = array('item_photo' => $name);
            Item::where('id', $item->id)->update($arr);
        }

        if($request->get('value')) {
            $item_numbers = $request->get('value');
            foreach ($item_numbers as $val) {
                $model = new Item_Number();
                $model->items_id = $item->id;
                $model->value = $val;
                $model->save();
            }
        }
        echo $item->id;
    }

    /*
    ** add category
    */
    public function addCategory(Request $request){
        $name = Category::where('name', $request->get('name'))->first();
        if(isset($name)) {
            return 'exist';
        }

        $category = Category::create($request->except(['image']));
        if ($request->file('image')) {
            $file = $request->file('image');
            $name = $category->name.'_'.rand().'.'.$file->getClientOriginalExtension();
            $file->move('./public/uploads/item/category', $name);
            $arr = array('image' => $name);
            Category::where('id', $category->id)->update($arr);
        }

        $html = '';
        $html .= '<option value="'.$category->id.'" selected="selected">'.ucfirst($category->name).'</option>';
        echo $html;
    }

    /*
    ** add manufacturer
    */
    public function addManufacturer(Request $request){
        $manufacturer = new Manufacturer();
        $model = $manufacturer->addManufacturer($request->all());
        if($model == 'exist') {
            return $model;
        }

        $html = '';
        $html .= '<option value="'.$model->id.'" selected="selected">'.ucfirst($model->name).'</option>';
        echo $html;
    }
}

