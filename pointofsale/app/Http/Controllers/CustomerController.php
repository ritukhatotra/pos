<?php
namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\Photo_File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    ** Customers list
    */
    public function cusotmerList() {
        $data['page_title'] = "POS | Admin | Customers";
        $data['current_url'] = url()->current();
        $data['customers_count'] =  DB::table('customers')->count();;
        $data['customers'] = Customer::orderBy('id','desc')->paginate(10);

        return view('admin.customer.customers', $data);
    }

    /*
    ** new customer
    */
    public function newCusotmer() {
        $data['page_title'] = "POS | Admin | Add Customer";
        $data['current_url'] = url()->current();
        $data['countries'] = Country::all();
        return view('admin.customer.add_customer', $data);
    }

    /*
   ** save customer
   */
    public function saveCusotmer(Request $request) {
        $input = $request->all();
        $v = Validator::make($input, Customer::$rules);
        if ($v->passes()) {
            $customer = new Customer();
            $customer->first_name = $input['first_name'];
            if(isset($input['last_name'])) {
               $customer->last_name = $input['last_name'];
            }
            if(isset($input['email'])) {
               $customer->email = $input['email'];
            }
            if(isset($input['phone'])) {
               $customer->phone = $input['phone'];
            }
            if ($request->file('profile')) {
                $file = $request->file('profile');
                $name = $input['first_name'].'_'.rand() . '.' . $file->getClientOriginalExtension();
                $file->move('./public/uploads/customer', $name);
                $customer->profile_photo = $name;
            }

            if(isset($input['address_1'])) {
                $customer->address1 = $input['address_1'];
            }
            if(isset($input['address_2'])) {
                $customer->address2 = $input['address_2'];
            }
            if(isset($input['country'])) {
                $customer->countries_id = $input['country'];
            }
            if(isset($input['state'])) {
                $customer->states_id = $input['state'];
            }
            if(isset($input['city'])) {
                $customer->city = $input['city'];
            }
            if(isset($input['zip'])) {
                $customer->zip = $input['zip'];
            }
            if(isset($input['comments'])) {
                $customer->comments = $input['comments'];
            }
            if(isset($input['disable_loyalty'])) {
                $customer->disable_loyality = $input['disable_loyalty'];
            }
            if(isset($input['balance'])) {
                $customer->store_account_balance = $input['balance'];
            }
            if(isset($input['credit_limit'])) {
                $customer->credit_limit = $input['credit_limit'];
            }
            if(isset($input['points'])) {
                $customer->points = $input['points'];
            }
            if(isset($input['amount_to_spend_for_next_point'])) {
                $customer->amount_to_spend_for_next_pt = $input['amount_to_spend_for_next_point'];
            }
            if(isset($input['company_name'])) {
                $customer->company_name = $input['company_name'];
            }
            if(isset($input['account_number'])) {
                $customer->account = $input['account_number'];
            }
            if(isset($input['override_default_tax'])) {
                $customer->override_default_sale = 1;
            }
            if(isset($input['tax_class'])) {
                if($input['tax_class'] == '1') {
                    $customer->tax_group = 'tax';
                } else {
                    $customer->tax_group = 'State sales';
                }
            }
            if(isset($input['tax1_name'])) {
                $customer->tax1_name = $input['tax1_name'];
            }
            if(isset($input['tax1_value'])) {
                $customer->tax1_value = $input['tax1_value'];
            }
            if(isset($input['tax2_name'])) {
                $customer->tax2_name = $input['tax2_name'];
            }
            if(isset($input['tax2_value'])) {
                $customer->tax2_value = $input['tax2_value'];
            }
            if(isset($input['tax_cumulatives'])) {
                $customer->commulative = 1;
            }
            if(isset($input['taxable'])) {
                if($input['taxable'] == 1) {
                    $customer->texable = 1;
                } else {
                    $customer->texable = 0;
                }
            }
            if(isset($input['tax_certificate'])) {
                $customer->non_tax_certificate_number = $input['tax_certificate'];
            }

            if($customer->save()){
                $id = $customer->id;
                if ($request->file('files')) {
                    $files = $request->file('files');
                    for ($i = 0; $i < count($files); $i++) {
                        $name = rand() . '.' . $files[$i]->getClientOriginalExtension();
                        $files[$i]->move('./public/uploads/customer/files', $name);
                        $photo_file = new Photo_File();
                        $photo_file->customer_id = $id;
                        $photo_file->name = $name;
                        $photo_file->save();
                    }
                }
                return redirect('admin/customers');
            } else {
                $request->session()->flash('err_msg', 'Customer not saved!');
                return redirect('admin/new-customer');
            }
        }
    }

    /*
    ** edit customer
    */
    public function editCustomer($id=NULL) {
        $data['page_title'] = "POS | Admin | Customer | Edit Customer";
        $data['current_url'] = url()->current();

        if($id == NULL){
            return redirect('admin/customers');
        }

        $data['countries'] = Country::all();
        $data['customer'] = Customer::find($id);
        if($data['customer']==''){
            return redirect('admin/new-customer');
        }

        return view('admin.customer.edit_customer', $data);
    }

    /*
    ** Update Customer
    */
    public function updateCusotmer(Request $request) {
        $input = $request->all();
        if(isset($input)) {
            $id = Crypt::decrypt($input['id']);
            global $tx, $email, $last_name, $phone, $address1, $address2, $country, $state, $city, $zip,
            $comments, $dl, $blnc, $credit, $amount, $comp, $pt, $override, $tx1, $tv1, $tx2, $tv2, $comm,
            $account,$taxable, $cert;

            $getProfilePhoto = Customer::find($id);
            $photo = $getProfilePhoto->profile_photo;

            if(isset($input['last_name'])) {
                $last_name = $input['last_name'];
            }
            if(isset($input['email'])) {
                $email = $input['email'];
            }
            if(isset($input['phone'])) {
                $phone = $input['phone'];
            }
            if(isset($input['address_1'])) {
                $address1 = $input['address_1'];
            }
            if ($request->file('profile')) {
                $file = $request->file('profile');
                $name = $input['first_name'].'_'.rand() . '.' . $file->getClientOriginalExtension();
                $file->move('./public/uploads/customer', $name);
                $photo = $name;
            }
            if(isset($input['address_2'])) {
                $address2 = $input['address_2'];
            }
            if(isset($input['country'])) {
                $country = $input['country'];
            }
            if(isset($input['state'])) {
                $state = $input['state'];
            }
            if(isset($input['city'])) {
                $city = $input['city'];
            }
            if(isset($input['zip'])) {
                $zip = $input['zip'];
            }
            if(isset($input['comments'])) {
                $comments = $input['comments'];
            }
            if(isset($input['disable_loyalty'])) {
                $dl = $input['disable_loyalty'];
            }
            if(isset($input['balance'])) {
                $blnc = $input['balance'];
            }
            if(isset($input['credit_limit'])) {
                $credit = $input['credit_limit'];
            }
            if(isset($input['points'])) {
                $pt = $input['points'];
            }
            if(isset($input['amount_to_spend_for_next_point'])) {
                $amount = $input['amount_to_spend_for_next_point'];
            }
            if(isset($input['company_name'])) {
                $comp = $input['company_name'];
            }
            if(isset($input['account_number'])) {
                $account = $input['account_number'];
            }
            if(isset($input['override_default_tax'])) {
                $override = 1;
            }
            if(isset($input['tax_class'])) {
                if($input['tax_class'] == '1') {
                    $tx= 'tax';
                } else {
                    $tx= 'tax';
                }
            }
            if(isset($input['tax1_name'])) {
                $tx1 = $input['tax1_name'];
            }
            if(isset($input['tax1_value'])) {
                $tv1 = $input['tax1_value'];
            }
            if(isset($input['tax2_name'])) {
                $tx2 = $input['tax2_name'];
            }
            if(isset($input['tax2_value'])) {
                $tv2 = $input['tax2_value'];
            }
            if(isset($input['tax_cumulatives'])) {
                $comm = 1;
            }
            if(isset($input['taxable'])) {
                if($input['taxable'] == 1) {
                    $taxable = 1;
                } else {
                    $taxable = 0;
                }
            }
            if(isset($input['tax_certificate'])) {
                $cert = $input['tax_certificate'];
            }

            $update = array('first_name' => $input['first_name'],
                        'last_name' => $last_name,
                        'email' => $email,
                        'phone' => $phone,
                        'address1' => $address1,
                        'address2' => $address2,
                        'countries_id' => $country,
                        'states_id' => $state,
                        'city' => $city,
                        'zip' => $zip,
                        'comments' => $comments,
                        'disable_loyality' => $dl,
                        'store_account_balance' => $blnc,
                        'credit_limit' => $credit,
                        'points' => $pt,
                        'amount_to_spend_for_next_pt' => $amount,
                        'company_name' => $comp,
                        'account' => $account,
                        'override_default_sale' => $override,
                        'tax_group' => $tx,
                        'tax1_name' => $tx1,
                        'tax1_value' => $tv1,
                        'tax2_name' => $tx2,
                        'tax2_value' => $tv2,
                        'profile_photo' => $photo,
                        'commulative' => $comm,
                        'non_tax_certificate_number' => $cert,
            );

            Customer::where('id', $id)->update($update);
            if ($request->file('files')) {
                $files = $request->file('files');
                for ($i = 0; $i < count($files); $i++) {
                    $name = rand() . '.' . $files[$i]->getClientOriginalExtension();
                    $files[$i]->move('./public/uploads/customer/files', $name);
                    $photo_file = new Photo_File();
                    $photo_file->customer_id = $id;
                    $photo_file->name = $name;
                    $photo_file->save();
                }
            }
            return redirect('admin/customers');
        }
    }

    /*
    ** delete profile photo
    */
    public function deleteProfilePhoto(Request $request) {
        $id = Crypt::decrypt($request->get('id'));
        $customer = Customer::find($id);
        $img_name = $customer->profile_photo;
        unlink("./public/uploads/customer/".$img_name);
        $photo = NULL;
        $update = array("profile_photo" => $photo);
        $delete = Customer::where('id', $id)->update($update);
        echo $delete;
    }
}