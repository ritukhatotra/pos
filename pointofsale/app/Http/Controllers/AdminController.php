<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' =>
            ['getSignin', 'postSignin','logout']
        ]);
    }

    /*
    ** sign in
    */
    public function getSignin() {
        $data['page_title'] = "POS | Admin Signin";
        $data['current_url'] = url()->current();
        return view('admin.auth.signin', $data);
    }

    public function postSignin(Request $request) {
        $input = $request->all();
        $rules = array('email' => 'required', 'password' => 'required');
        $v = Validator::make($input, $rules);
        if ($v->passes()) {
            $credentials = array('email' => $input['email'], 'password' => $input['password'], 'status' => 'active', 'user_roles_id' => env('ADMIN_ROLE'));

            if (Auth::attempt($credentials, true)) {
                return redirect("admin/dashboard");
            } else {
                $request->session()->flash('err_msg', 'Wrong email / password.');
                return redirect('login');
            }
        } else {
            $request->session()->flash('err_msg', 'Empty Fields.');
            return redirect('login');
        }
    }

    /*
    ** dashboard
    */
    public function dashboard() {
        $data['page_title'] = "POS | Admin Dashboard";
        $data['current_url'] = url()->current();
        $data['customers_count'] =  DB::table('customers')->count();;
        return view('admin.dashboard', $data);
    }

    /*
    ** logout
    */
    public function logout() {
        Auth::logout();
        return redirect( 'login' );
    }
}