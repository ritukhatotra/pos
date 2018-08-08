<?php
namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\Permission;
use App\Photo_File;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    ** Employee list
    */
    public function employeeList() {
        $data['page_title'] = "POS | Admin | Employee";
        $data['current_url'] = url()->current();
        $data['users_count'] =  DB::table('users')->count();
        $data['users'] = User::where('user_roles_id', env('EMPLOYEE_ROLE'))->orderBy('id','desc')->paginate(10);

        return view('admin.employee.employees', $data);
    }

    /*
    ** new employee
    */
    public function newEmployee() {
        $data['page_title'] = "POS | Admin | Add Employee";
        $data['current_url'] = url()->current();
        $data['countries'] = Country::all();
        return view('admin.employee.add_employee', $data);
    }

    /*
    ** save employee
    */
    public function saveEmployee(Request $request) {
        $user = User::create($request->except(
            [
                'profile_photo','files','customer_pemissions_id',
                'item_kit_permissions_id','item_permissions_id','price_rules_permissions_id',
                'supplier_permissions_id','report_permissions_id','receiving_permissions_id',
                'sale_permissions_id','deliver_permissions_id','employee_permissions_id',
                'gift_card_permissions_id','store_config','location_permissions_id',
                'message_permissions_id'
            ]
        ));

        if ($request->file('profile_photo')) {
            $file = $request->file('profile_photo');
            $name = $user->first_name . '_' . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('./public/uploads/employee', $name);
            $arr = array('profile_photo' => $name);
            User::where('id', $user->id)->update($arr);
        }

        if ($request->file('files')) {
            $files = $request->file('files');
            for ($i = 0; $i < count($files); $i++) {
                $name = rand() . '.' . $files[$i]->getClientOriginalExtension();
                $files[$i]->move('./public/uploads/employee/files', $name);
                $photo_file = new Photo_File();
                $photo_file->user_id = $user->id;
                $photo_file->name = $name;
                $photo_file->save();
            }
        }
        if($request->get('customer_pemissions_id')) {
            $permission = new  Permission();
            $data = $request->get('customer_pemissions_id');
            foreach($data as $value){
                $permission->customer_pemissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('item_kit_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('item_kit_permissions_id');
            foreach($data as $value){
                $permission->item_kit_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('item_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('item_permissions_id');
            foreach($data as $value){
                $permission->item_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('price_rules_permissions_id')) {
            $data = $request->get('price_rules_permissions_id');
            foreach($data as $value){
                $permission->price_rules_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('supplier_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('supplier_permissions_id');
            foreach($data as $value){
                $permission->supplier_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('report_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('report_permissions_id');
            foreach($data as $value){
                $permission->report_permissions_id = $value;
            }
        }
        if($request->get('receiving_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('receiving_permissions_id');
            foreach($data as $value){
                $permission->receiving_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('sale_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('sale_permissions_id');
            foreach($data as $value){
                $permission->sale_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('deliver_permissions_id')) {
            $data = $request->get('deliver_permissions_id');
            foreach($data as $value){
                $permission->deliver_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('employee_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('employee_permissions_id');
            foreach($data as $value){
                $permission->employee_permissions_id = $value;
            }
        }
        if($request->get('gift_card_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('gift_card_permissions_id');
            foreach($data as $value){
                $permission->gift_card_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('store_config')) {
            $permission = new  Permission();
            $data = $request->get('store_config');
            foreach($data as $value){
                $permission->store_config = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('location_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('location_permissions_id');
            foreach($data as $value){
                $permission->location_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('message_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('message_permissions_id');
            foreach($data as $value){
                $permission->message_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }

        return redirect('admin/employees');
    }

    /*
    ** edit employee
    */
    public function editEmployee($id=NULL) {
        $data['page_title'] = "POS | Admin | Employee | Edit Employee";
        $data['current_url'] = url()->current();

        if($id == NULL){
            return redirect('admin/employees');
        }

        $data['countries'] = Country::all();
        $data['user'] = User::find($id);
        if($data['user']==''){
            return redirect('admin/new-employee');
        }

        return view('admin.employee.edit_employee', $data);
    }

    /*
    ** update employee
    */
    public function updateEmployee(Request $request) {
        $id = $request->get('id');
        User::where('id', $id)->update(
            $request->except(
                [
                    'submit','_token','id','profile_photo','files','customer_pemissions_id',
                    'item_kit_permissions_id','item_permissions_id','price_rules_permissions_id',
                    'supplier_permissions_id','report_permissions_id','receiving_permissions_id',
                    'sale_permissions_id','deliver_permissions_id','employee_permissions_id',
                    'gift_card_permissions_id','store_config','location_permissions_id',
                    'message_permissions_id'
                ]
            )
        );

        $user =User::find($id);
        if ($request->file('profile_photo')) {
            if($user->profile_photo != '') {
                unlink("./public/uploads/employee/" . $user->profile_photo);
            }
            $file = $request->file('profile_photo');
            $name = $user->first_name . '_' . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('./public/uploads/employee', $name);
            $arr = array('profile_photo' => $name);
            User::where('id', $user->id)->update($arr);
        }

        if ($request->file('files')) {
            $files = $request->file('files');
            for ($i = 0; $i < count($files); $i++) {
                $name = rand() . '.' . $files[$i]->getClientOriginalExtension();
                $files[$i]->move('./public/uploads/employee/files', $name);
                $photo_file = new Photo_File();
                $photo_file->user_id = $user->id;
                $photo_file->name = $name;
                $photo_file->save();
            }
        }
        if($request->get('customer_pemissions_id')) {
            $permission = new  Permission();
            $data = $request->get('customer_pemissions_id');
            foreach($data as $value){
                $permission->customer_pemissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('item_kit_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('item_kit_permissions_id');
            foreach($data as $value){
                $permission->item_kit_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('item_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('item_permissions_id');
            foreach($data as $value){
                $permission->item_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('price_rules_permissions_id')) {
            $data = $request->get('price_rules_permissions_id');
            foreach($data as $value){
                $permission->price_rules_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('supplier_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('supplier_permissions_id');
            foreach($data as $value){
                $permission->supplier_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('report_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('report_permissions_id');
            foreach($data as $value){
                $permission->report_permissions_id = $value;
            }
        }
        if($request->get('receiving_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('receiving_permissions_id');
            foreach($data as $value){
                $permission->receiving_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('sale_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('sale_permissions_id');
            foreach($data as $value){
                $permission->sale_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('deliver_permissions_id')) {
            $data = $request->get('deliver_permissions_id');
            foreach($data as $value){
                $permission->deliver_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('employee_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('employee_permissions_id');
            foreach($data as $value){
                $permission->employee_permissions_id = $value;
            }
        }
        if($request->get('gift_card_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('gift_card_permissions_id');
            foreach($data as $value){
                $permission->gift_card_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('store_config')) {
            $permission = new  Permission();
            $data = $request->get('store_config');
            foreach($data as $value){
                $permission->store_config = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('location_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('location_permissions_id');
            foreach($data as $value){
                $permission->location_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }
        if($request->get('message_permissions_id')) {
            $permission = new  Permission();
            $data = $request->get('message_permissions_id');
            foreach($data as $value){
                $permission->message_permissions_id = $value;
                $permission->user_id = $user->id;
                $permission->save();
            }
        }

        return redirect('admin/employees');
    }
}