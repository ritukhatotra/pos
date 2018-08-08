@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="row" id="">
            <div class="spinner" id="grid-loader" style="display:none">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
            </div>
            <div class="col-md-12">
                <form id="employee_form" class="form-horizontal" method="post" action="{{url('update-employee')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="panel panel-piluku">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ion-edit"></i>
                                Edit Employee Information<small> (Fields in red are required)</small>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-3 col-md-3 col-lg-2 control-label red">First Name:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control" id="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class=" col-sm-3 col-md-3 col-lg-2 control-label ">Last Name:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control" id="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 col-md-3 col-lg-2 control-label red">E-Mail:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email">
                                            <span id="email-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number" class="col-sm-3 col-md-3 col-lg-2 control-label ">Phone Number:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="phone" value="{{$user->contact_number}}" class="form-control" id="phone_number">
                                            <span id="phone-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_id" class="col-sm-3 col-md-3 col-lg-2 control-label ">Select Image:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <ul class="list-unstyled avatar-list">
                                                <li>
                                                    <input type="file" name="profile_photo" value="{{$user->profile_photo}}" id="profile" class="filestyle">
                                                </li>
                                                <li>
                                                    <div id="avatar">
                                                        @if($user->profile_photo != '')
                                                            <img style="width: 20%; margin-top:10px;" src="{{asset('public/uploads/employee/'.$user->profile_photo)}}" class="img-polaroid" id="avatar-photo" alt="">
                                                        @else
                                                            <img style="width: 20%; margin-top:10px;" src="{{asset('public/images/avatar.png')}}" class="img-polaroid" id="avatar-photo" alt="">
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_1" class="col-sm-3 col-md-3 col-lg-2 control-label ">Address 1:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="address1" value="{{$user->address1}}" class="form-control" id="address_1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_2" class="col-sm-3 col-md-3 col-lg-2 control-label ">Address 2:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="address2" value="{{$user->address2}}" class="form-control" id="address_2">
                                        </div>
                                    </div>
                                    <?php
                                    $country = '';
                                    $state = '';
                                    if($user->countries_id != '') {
                                        $country = \App\Country::find($user->countries_id);
                                    }
                                    if($user->states_id != '') {
                                        $state = \App\State::find($user->states_id);
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="country" class="col-sm-3 col-md-3 col-lg-2 control-label ">Country:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="countries_id" class="form-control" id="country">
                                                @if($country != '')
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @else
                                                    <option value="">Select Country</option>
                                                @endif
                                                @foreach($countries as $country)
                                                    <option value="{{$country['id']}}">{{$country['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="col-sm-3 col-md-3 col-lg-2 control-label ">State/Province:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="states_id" class="form-control" id="state">
                                                @if($state != '')
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @else
                                                    <option value="">Select State</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-sm-3 col-md-3 col-lg-2 control-label ">City:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="city" value="{{$user->city}}" class="form-control " id="city">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip" class="col-sm-3 col-md-3 col-lg-2 control-label ">Zip:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="zip" value="{{$user->zip}}" class="form-control " id="zip">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments" class="col-sm-3 col-md-3 col-lg-2 control-label ">Comments:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <textarea name="comment" cols="17" rows="5" id="comments" class="form-control text-area">{{$user->comment}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="commission_percent" class="col-sm-3 col-md-3 col-lg-2 control-label">Commission Default Rate:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <div class="input-group">
                                                <input type="text" name="commission_percent" value="{{$user->commission_percent}}" id="commission_percent" class="form-control">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="commission_percent_type" class="col-sm-3 col-md-3 col-lg-2 control-label">Commission Percent calculation method: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="commission_percent_type" class="form-control" id="commission_percent_type">
                                                @if($user->commission_percent_type == 'selling_price')
                                                    <option value="selling_price">Selling Price</option>
                                                @else
                                                    <option value="profit">Profit</option>
                                                @endif
                                                <option value="selling_price">Selling Price</option>
                                                <option value="profit">Profit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hourly_pay_rate" class="col-sm-3 col-md-3 col-lg-2 control-label">Hourly pay rate</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" name="hourly_pay_rate" value="{{$user->hourly_pay_rate}}" id="hourly_pay_rate" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group offset1">
                                        <label for="hire_date" class="col-sm-3 col-md-3 col-lg-2 control-label text-info wide">Hire date:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <div class="input-group date">
                                                <span class="input-group-addon bg">
                                                    <i class="ion ion-ios-calendar-outline"></i>
                                                </span>
                                                <input type="text" name="doj" value="{{$user->doj}}" id="hire_date" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group offset1">
                                        <label for="birthday" class="col-sm-3 col-md-3 col-lg-2 control-label text-info wide">Birthday:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <div class="input-group date">
                                                <span class="input-group-addon bg">
                                                    <i class="ion ion-ios-calendar-outline"></i>
                                                </span>
                                                <input type="text" name="dob" value="{{$user->dob}}" id="birthday" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="language" class="col-sm-3 col-md-3 col-lg-2 col-sm-3 col-md-3 col-lg-2 control-label  required">Language:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="language" class="form-control" id="language">
                                                <option value="{{$user->language}}">{{ucfirst($user->language)}}</option>
                                                <option value="english">English</option>
                                                <option value="indonesia">Indonesia</option>
                                                <option value="spanish">Español</option>
                                                <option value="french">Fançais</option>
                                                <option value="italian">Italiano</option>
                                                <option value="german">Deutsch</option>
                                                <option value="dutch">Nederlands</option>
                                                <option value="portugues">Portugues</option>
                                                <option value="arabic">العَرَبِيةُ&lrm;&lrm;</option>
                                                <option value="khmer">Khmer</option>
                                                <option value="vietnamese">Vietnamese</option>
                                                <option value="chinese">中文</option>
                                                <option value="chinese_traditional">繁體中文</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-piluku">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="ion-folder"></i>Files</h3>
                                </div>
                                <h4 style="padding: 20px;">Add Files</h4>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_1" class="col-sm-3 col-md-3 col-lg-2 control-label ">Files:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="name[]" id="files_1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-piluku">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="ion-locked"></i>
                                        Employee Login Info
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="username" class="col-sm-3 col-md-3 col-lg-2 control-label required">Username:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="username" value="{{$user->username}}" id="username" class="form-control">
                                            <span id="uname"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="force_password_change" class="col-sm-3 col-md-3 col-lg-2 control-label">Force password change upon login:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="checkbox" name="force_password_changed" value="1" id="force_password_change">
                                            <label for="force_password_change"><span></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="always_require_password" class="col-sm-3 col-md-3 col-lg-2 control-label">
                                            Always require password when switching user:
                                        </label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="checkbox" name="always_required_password" value="1" id="always_require_password">
                                            <label for="always_require_password"><span></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inactive" class="col-sm-3 col-md-3 col-lg-2 control-label">Inactive:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="checkbox" name="status" value="inactive" id="inactive">
                                            <label for="inactive"><span></span></label>
                                        </div>
                                    </div>
                                    <div id="inactive_info" class="hidden">
                                        <div class="form-group">
                                            <label for="reason_inactive" class="col-sm-3 col-md-3 col-lg-2 control-label ">Reason inactive:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <textarea name="reason_for_status_inactive" cols="17" rows="5" id="reason_inactive" class="form-control text-area">{{$user->reason_for_status_inactive}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group offset1">
                                            <label for="termination_date" class="col-sm-3 col-md-3 col-lg-2 control-label text-info wide">Termination date:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <div class="input-group date">
                                                    <span class="input-group-addon bg">
                                                        <i class="ion ion-ios-calendar-outline"></i>
                                                    </span>
                                                    <input type="text" name="inactive_date" value="{{$user->inactive_date}}" id="termination_date" class="form-control datepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-piluku">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="ion-android-checkbox-outline"></i>
                                        Employee Permissions and Access<br>
                                    </h3>
                                </div>

                                <div class="panel-body">
                                    <div class="alert alert-info text-center" role="alert">
                                        Check the boxes below to grant access to modules
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="customer_pemissions_id[]" value="all" id="permissionscustomers" class="module_checkboxes ">
                                            <label for="permissionscustomers">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Customers:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search customers</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="customer_pemissions_id[]" value="add_update" class="module_action_checkboxes customer_checkbox" id="customer_checkbox_1">
                                                <label for="customer_checkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="customer_pemissions_id[]" value="delete" class="module_action_checkboxes customer_checkbox" id="customer_checkbox_2">
                                                <label for="customer_checkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="customer_pemissions_id[]" value="search" class="module_action_checkboxes customer_checkbox" id="customer_checkbox_3">
                                                <label for="customer_checkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search customers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="customer_pemissions_id[]" value="edit_account_blnc" class="module_action_checkboxes customer_checkbox" id="customer_checkbox_4">
                                                <label for="customer_checkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Store Account Balance</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="customer_pemissions_id[]" value="edit_cust_pts" class="module_action_checkboxes customer_checkbox" id="customer_checkbox_5">
                                                <label for="customer_checkbox_5">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit customer points/Number of sales until discount</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="item_permissions_id[]" value="all" id="item_permission" class="module_checkboxes">
                                            <label for="item_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Items:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search items</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="add_update" class="module_action_checkboxes item_chkbox" id="item_chkbox_1">
                                                <label for="item_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="delete" class="module_action_checkboxes item_chkbox" id="item_chkbox_2">
                                                <label for="item_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="search" class="module_action_checkboxes item_chkbox" id="item_chkbox_3">
                                                <label for="item_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search items</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="cost_price" class="module_action_checkboxes item_chkbox" id="item_chkbox_4">
                                                <label for="item_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">See cost price</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="edit_qunatity" class="module_action_checkboxes item_chkbox" id="item_chkbox_5">
                                                <label for="item_chkbox_5">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit quantity</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="count_inventory" class="module_action_checkboxes item_chkbox" id="item_chkbox_6">
                                                <label for="item_chkbox_6">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Count inventory</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="manage_cat" class="module_action_checkboxes item_chkbox" id="item_chkbox_7">
                                                <label for="item_chkbox_7">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Manage categories</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="manage_tag" class="module_action_checkboxes item_chkbox" id="item_chkbox_8">
                                                <label for="item_chkbox_8">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Manage tags</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_permissions_id[]" value="manage_manufacture" class="module_action_checkboxes item_chkbox" id="item_chkbox_9">
                                                <label for="item_chkbox_9">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Manage Manufacturers</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="item_kit_permissions_id[]" value="all" class="module_action_checkboxes" id="item_kit_permission">
                                            <label for="item_kit_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Item Kits:</span>
                                            <span class="text-warning">Add, Update, Delete and Search Item Kits</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_kit_permissions_id[]" value="add_update" class="module_action_checkboxes item_kit_chkbox" id="item_kit_chkbox_1">
                                                <label for="item_kit_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_kit_permissions_id[]" value="delete" class="module_action_checkboxes item_kit_chkbox" id="item_kit_chkbox_2">
                                                <label for="item_kit_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_kit_permissions_id[]" value="search" class="module_action_checkboxes item_kit_chkbox" id="item_kit_chkbox_3">
                                                <label for="item_kit_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search Item Kits</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="item_kit_permissions_id[]" value="cost_price" class="module_action_checkboxes item_kit_chkbox" id="item_kit_chkbox_4">
                                                <label for="item_kit_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">See cost price</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="price_rules_permissions_id[]" value="all" class="module_action_checkboxes" id="price_rule_permission">
                                            <label for="price_rule_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Price Rules:</span>
                                            <span class="text-warning">Add, Update, Delete and Search Pricing Rules</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="price_rules_permissions_id[]" value="add_update" class="module_action_checkboxes price_rule_checkbox" id="price_rule_checkbox_1">
                                                <label for="price_rule_checkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="price_rules_permissions_id[]" value="delete" class="module_action_checkboxes price_rule_checkbox" id="price_rule_checkbox_2">
                                                <label for="price_rule_checkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="price_rules_permissions_id[]" value="search" class="module_action_checkboxes price_rule_checkbox" id="price_rule_checkbox_3">
                                                <label for="price_rule_checkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search Price Rules</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="supplier_permissions_id[]" value="all" class="module_action_checkboxes" id="supplier_permission">
                                            <label for="supplier_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Suppliers:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search suppliers</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="supplier_permissions_id[]" value="add_update" class="module_action_checkboxes supplier_chkbox" id="supplier_chkbox_1">
                                                <label for="supplier_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="supplier_permissions_id[]" value="delete" class="module_action_checkboxes supplier_chkbox" id="supplier_chkbox_2">
                                                <label for="supplier_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="supplier_permissions_id[]" value="search" class="module_action_checkboxes supplier_chkbox" id="supplier_chkbox_3">
                                                <label for="supplier_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search suppliers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="supplier_permissions_id[]" value="edit_store_balance" class="module_action_checkboxes supplier_chkbox" id="supplier_chkbox_4">
                                                <label for="supplier_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Store Account Balance</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="report_permissions_id[]" value="all" class="module_action_checkboxes" id="report_permission">
                                            <label for="report_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Reports:</span>
                                            <span class="text-warning">View and generate reports</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="category" class="module_action_checkboxes report_chkbox" id="report_chkbox_1">
                                                <label for="report_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Categories</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="closeout" class="module_action_checkboxes report_chkbox" id="report_chkbox_2">
                                                <label for="report_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Closeout</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="commision" class="module_action_checkboxes report_chkbox" id="report_chkbox_3">
                                                <label for="report_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Commission</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="employee_commision" class="module_action_checkboxes report_chkbox" id="report_chkbox_4">
                                                <label for="report_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">View all employee commissions</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="custom_report" class="module_action_checkboxes report_chkbox" id="report_chkbox_5">
                                                <label for="report_chkbox_5">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Custom Report</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="customers" class="module_action_checkboxes report_chkbox" id="report_chkbox_6">
                                                <label for="report_chkbox_6">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Customers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="delete_sale" class="module_action_checkboxes report_chkbox" id="report_chkbox_7">
                                                <label for="report_chkbox_7">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Deleted Sales</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="delivery" class="module_action_checkboxes report_chkbox" id="report_chkbox_8">
                                                <label for="report_chkbox_8">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Deliveries</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="" value="" class="module_action_checkboxes report_chkbox" id="report_chkbox_9">
                                                <label for="report_chkbox_9">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Discounts</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="employee" class="module_action_checkboxes report_chkbox" id="report_chkbox_10">
                                                <label for="report_chkbox_10">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Employees</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="expense" class="module_action_checkboxes report_chkbox" id="report_chkbox_11">
                                                <label for="report_chkbox_11">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Expenses</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="giftcard" class="module_action_checkboxes report_chkbox" id="report_chkbox_12">
                                                <label for="report_chkbox_12">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Giftcards</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="" value="" class="module_action_checkboxes report_chkbox" id="report_chkbox_13">
                                                <label for="report_chkbox_13">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Inventory Reports</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="item_kit" class="module_action_checkboxes report_chkbox" id="report_chkbox_14">
                                                <label for="report_chkbox_14">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Item Kits</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="item" class="module_action_checkboxes report_chkbox" id="report_chkbox_15">
                                                <label for="report_chkbox_15">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Items</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value=manufacture"" class="module_action_checkboxes report_chkbox" id="report_chkbox_16">
                                                <label for="report_chkbox_16">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Manufacturers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="payment" class="module_action_checkboxes report_chkbox" id="report_chkbox_17">
                                                <label for="report_chkbox_17">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Payments</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="price_rules" class="module_action_checkboxes report_chkbox" id="report_chkbox_18">
                                                <label for="report_chkbox_18">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Price Rules</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="profit_loss" class="module_action_checkboxes report_chkbox" id="report_chkbox_19">
                                                <label for="report_chkbox">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Profit and Loss</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="receivings" class="module_action_checkboxes report_chkbox" id="report_chkbox_20">
                                                <label for="report_chkbox">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Receivings</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="register_log" class="module_action_checkboxes report_chkbox" id="report_chkbox_21">
                                                <label for="report_chkbox_21">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Register Logs</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="register" class="module_action_checkboxes report_chkbox" id="report_chkbox_22">
                                                <label for="report_chkbox_22">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Registers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="sales" class="module_action_checkboxes report_chkbox" id="report_chkbox_23">
                                                <label for="report_chkbox_23">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Sales</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="store_account" class="module_action_checkboxes report_chkbox" id="report_chkbox_24">
                                                <label for="report_chkbox_24">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Store Accounts</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="supplier_store_account" class="module_action_checkboxes report_chkbox" id="report_chkbox_25">
                                                <label for="report_chkbox_25">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Supplier Store Accounts</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="supplier" class="module_action_checkboxes report_chkbox" id="report_chkbox_26">
                                                <label for="report_chkbox_26">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Suppliers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="suspended_sale" class="module_action_checkboxes report_chkbox" id="report_chkbox_27">
                                                <label for="report_chkbox_27">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Suspended Sales</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="tags" class="module_action_checkboxes report_chkbox" id="report_chkbox_28">
                                                <label for="report_chkbox_28">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Tags</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="taxes" class="module_action_checkboxes report_chkbox" id="report_chkbox_29">
                                                <label for="report_chkbox_29">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Taxes</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="tiers" class="module_action_checkboxes report_chkbox" id="report_chkbox_30">
                                                <label for="report_chkbox_30">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Tiers</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="time_clock" class="module_action_checkboxes report_chkbox" id="report_chkbox_31">
                                                <label for="report_chkbox_31">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Time clock</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="show_profit_all_reports" class="module_action_checkboxes report_chkbox" id="report_chkbox_32">
                                                <label for="report_chkbox_32">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Show profit in all reports</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="show_cp_all_reports" class="module_action_checkboxes report_chkbox" id="report_chkbox_33">
                                                <label for="report_chkbox_33">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Show cost price in all reports</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="inventory_all_location" class="module_action_checkboxes report_chkbox" id="report_chkbox_34">
                                                <label for="report_chkbox_34">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">View Inventory Reports at ALL locations</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="report_permissions_id[]" value="dashboard_statistics" class="module_action_checkboxes report_chkbox" id="report_chkbox_35">
                                                <label for="report_chkbox_35">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">View Dashboard Statistics</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="receiving_permissions_id[]" value="purchase_order" class="module_action_checkboxes" id="recieve_permission">
                                            <label for="recieve_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Receiving:</span>
                                            <span class="text-warning">Process Purchase orders</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="receiving_permissions_id[]" value="delete_tax" class="module_action_checkboxes receive_chkbox" id="receive_chkbox_1">
                                                <label for="receive_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete Taxes</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="receiving_permissions_id[]" value="edit" class="module_action_checkboxes receive_chkbox" id="receive_chkbox_2">
                                                <label for="receive_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit receiving</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="receiving_permissions_id[]" value="delete" class="module_action_checkboxes receive_chkbox" id="receive_chkbox_3">
                                                <label for="receive_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete receiving</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="sale_permissions_id[]" value="process_Sales_and_returns" class="module_action_checkboxes" id="sale_permission">
                                            <label for="sale_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Sales:</span>
                                            <span class="text-warning">Process sales and returns</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="edit_sale_price" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_1">
                                                <label for="sale_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Sale Price</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="edit_sale_cp" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_2">
                                                <label for="sale_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit sale cost price</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="give_discount" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_3">
                                                <label for="sale_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Give Discount</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="delete_suspended_sale" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_4">
                                                <label for="sale_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete Suspended Sale</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="delete_taxes" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_5">
                                                <label for="sale_chkbox_5">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete Taxes</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="edit_sale" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_6">
                                                <label for="sale_chkbox_6">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Sale</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="delete_sale" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_7">
                                                <label for="sale_chkbox_7">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete Sale</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="sale_permissions_id[]" value="search_sale" class="module_action_checkboxes sale_chkbox" id="sale_chkbox_8">
                                                <label for="sale_chkbox_8">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search Sales</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="deliver_permissions_id[]" value="all" class="module_action_checkboxes" id="delivery_permission">
                                            <label for="delivery_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Deliveries:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search Deliveries</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="deliver_permissions_id[]" value="add" class="module_action_checkboxes delivery_chkbox" id="delivery_chkbox_1">
                                                <label for="delivery_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add Deliveries</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="deliver_permissions_id[]" value="edit" class="module_action_checkboxes delivery_chkbox" id=delivery_chkbox_2"">
                                                <label for="delivery_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Deliveries</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="deliver_permissions_id[]" value="delete" class="module_action_checkboxes delivery_chkbox" id="delivery_chkbox_3">
                                                <label for="delivery_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete Deliveries</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="deliver_permissions_id[]" value="search" class="module_action_checkboxes delivery_chkbox" id="delivery_chkbox_4">
                                                <label for="delivery_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search Deliveries</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="employee_permissions_id[]" value="all" class="module_action_checkboxes" id="emp_permission">
                                            <label for="emp_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Employees:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search employees</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="employee_permissions_id[]" value="add_update" class="module_action_checkboxes emp_chkbox" id="emp_chkbox_1">
                                                <label for="emp_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="employee_permissions_id[]" value="delete" class="module_action_checkboxes emp_chkbox" id="emp_chkbox_2">
                                                <label for="emp_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="employee_permissions_id[]" value="search" class="module_action_checkboxes emp_chkbox" id="emp_chkbox_3">
                                                <label for="emp_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search employees</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="employee_permissions_id[]" value="assign_location" class="module_action_checkboxes emp_chkbox" id="emp_chkbox_4">
                                                <label for="emp_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Assign all locations</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="employee_permissions_id[]" value="edit" class="module_action_checkboxes emp_chkbox" id="emp_chkbox_5">
                                                <label for="emp_chkbox_5">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit profile</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="gift_card_permissions_id[]" value="all" class="module_action_checkboxes" id="gift_card_permisson">
                                            <label for="gift_card_permisson">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Gift Cards:</span>
                                            <span class="text-warning">Add, Update, Delete and Search gift cards</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="gift_card_permissions_id[]" value="add_update" class="module_action_checkboxes gift_chkbox" id="gift_chkbox_1">
                                                <label for="gift_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="gift_card_permissions_id[]" value="edit_value" class="module_action_checkboxes gift_chkbox" id="gift_chkbox_2">
                                                <label for="gift_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Edit Giftcard value</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="gift_card_permissions_id[]" value="delete" class="module_action_checkboxes gift_chkbox" id="gift_chkbox_3">
                                                <label for="gift_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="gift_card_permissions_id[]" value="search" class="module_action_checkboxes gift_chkbox" id="gift_chkbox_4">
                                                <label for="gift_chkbox_4">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search Giftcards</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="store_config[]" value="change_configuration" class="module_action_checkboxes" id="store_config_permission">
                                            <label for="store_config_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Store Config:</span>
                                            <span class="text-warning">Change the store's configuration</span>
                                        </div>
                                        <ul class="list-group"></ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="location_permissions_id[]" value="all" class="module_action_checkboxes" id="loc_permission">
                                            <label for="loc_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Locations:</span>
                                            <span class="text-warning">Add, Update, Delete, and Search locations</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="location_permissions_id[]" value="add_update" class="module_action_checkboxes loc_chkbox" id="loc_chkbox_1">
                                                <label for="loc_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Add, Update</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="location_permissions_id[]" value="delete" class="module_action_checkboxes loc_chkbox" id="loc_chkbox_2">
                                                <label for="loc_chkbox_2">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Delete</span>
                                            </li>

                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="location_permissions_id[]" value="search" class="module_action_checkboxes loc_chkbox" id="loc_chkbox_3">
                                                <label for="loc_chkbox_3">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Search locations</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="panel panel-piluku">
                                        <div class="panel-heading">
                                            <input type="checkbox" name="message_permissions_id[]" value="all" class="module_action_checkboxes" id="msg_permission">
                                            <label for="msg_permission">
                                                <span></span>
                                            </label>
                                            <span class="text-success">Messages:</span>
                                            <span class="text-warning">Send, receive, and view messages</span>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item permission-action-item">
                                                <input type="checkbox" name="message_permissions_id[]" value="send" class="module_action_checkboxes msg_chkbox" id="msg_chkbox_1">
                                                <label for="msg_chkbox_1">
                                                    <span></span>
                                                </label>
                                                <span class="text-info">Send Message</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="submit" value="Save" id="submit" class=" submit_button floating-button btn btn-lg btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop