@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="manage_buttons">
            <div class="manage-row-options hidden">
                <div class="email_buttons people">
                    <a class="btn btn-primary btn-lg email" title="" id="" href="#">
                        <span class="ion-email"> E-Mail</span>
                    </a>
                    <a class="btn btn-primary btn-lg labels" title="" id="" href="#">
                        <span class="ion-android-list"></span>
                        <span class="hidden-xs">Mailing Labels</span>
                    </a>
                    <a href="#" id="generate_barcode_labels" class="btn btn-primary btn-lg" title="">
                        <span class="ion-ios-barcode"></span>
                        <span class="hidden-xs">Barcode Labels</span>
                    </a>
                    <a href="#" id="" class="btn btn-primary btn-lg" target="_blank">
                        <span class="ion-document"></span>
                        <span class="hidden-xs">Barcode Sheet</span>
                    </a>
                    <a href="#" id="" class="btn btn-red btn-lg" title="">
                        <span class="ion-trash-a"></span>
                        <span class="hidden-xs">Delete</span>
                    </a>
                    <a href="#" class="btn btn-lg btn-clear-selection btn-warning">
                        <span class="ion-close-circled"></span>
                        <span class="hidden-xs">Clear Selection</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <div class="search no-left-border">
                        <input type="hidden" id="search-type" value="employee">
                        <input type="text" class="form-control ui-autocomplete-input" name="search" id="search" value="" placeholder="Search Employee by name, email" autocomplete="off">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <span class="ion-ios-search-strong"></span>
                        </button>
                        <ul id="srch-result" class="hidden"></ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="buttons-list">
                        <div class="pull-right-btn">
                            <a href="{{url('admin/new-employee')}}" id="new-person-btn" class="btn btn-primary btn-lg hidden-sm hidden-xs" title="New Employee">
                                <span class="ion-plus"> New Employee</span></a>
                            <div class="piluku-dropdown btn-group">
                                <button type="button" class="btn btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="hidden-xs ion-android-more-horizontal"> </span>
                                    <i class="visible-xs ion-android-more-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="visible-sm visible-xs">
                                        <a href="#" class="" title="New Employee">
                                            <span class="ion-plus-round"> Add New Employee</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="hidden-xs" title="Excel Import">
                                            <span class="ion-ios-download-outline"> Excel Import</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="hidden-xs import" title="Excel Export">
                                            <span class="ion-ios-upload-outline"> Excel Export</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" id="cleanup" class="" title="Cleanup old Employees">
                                            <span class="ion-loop"> Cleanup old Employees</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" id="custom_fields" class="" title="Custom Field Configuration">
                                            <span class="ion-wrench"> Custom Field Configuration</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="toggle_deleted" title="Manage Deleted Employees">
                                            <span class="ion-trash-a"> Manage Deleted Employees</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row manage-table">
                <div class="panel panel-piluku">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Employees
                            <span class="badge bg-primary tip-left" id="manage_total_items">
                                 @if(isset($users))
                                    {{$users_count}}
                                @endif
                            </span>
                            <form id="config_columns">
                                <div class="piluku-dropdown btn-group table_buttons pull-right m-left-20">
                                    <button type="button" class="btn btn-more dropdown-toggle" id="dd_toggle">
                                        <i class="ion-gear-a"></i>
                                    </button>
                                    <ul id="sortable" class="dropdown-menu dropdown-menu-left col-config-dropdown ui-sortable" role="menu" style="">
                                        <li class="dropdown-header">
                                            <a id="reset_to_default" class="pull-right">
                                                <span class="ion-refresh"></span> Reset
                                            </a>
                                            Column Configuration
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="company_name" name="colName[]" id="add_company_name"/>
                                                <label class="sortable_column_name" for="add_company_name"><span></span>Company Name</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="account" name="colName[]" id="add_account"/>
                                                <label class="sortable_column_name" for="add_account"><span></span>Account</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="address1" name="colName[]" id="add_address1"/>
                                                <label class="sortable_column_name" for="add_address1"><span></span>Address1</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="address2" name="colName[]" id="add_address2"/>
                                                <label class="sortable_column_name" for="add_address2"><span></span>Address2</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="zip" name="colName[]" id="add_zip"/>
                                                <label class="sortable_column_name" for="add_zip"><span></span>Zip</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="country" name="colName[]" id="add_country"/>
                                                <label class="sortable_column_name" for="add_country"><span></span>Country</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </h3>
                    </div>
                    <div class="panel-body nopadding table_holder table-responsive" id="table_holder">
                        <table class="table tablesorter table-hover" id="sortable_table">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" value="" id="select_all">
                                    <label for="select_all"><span></span></label>
                                </th>
                                <th>Action</th>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="address1 hidden">Address1</th>
                                <th class="address2 hidden">Address2</th>
                                <th class="zip hidden">Zip</th>
                                <th class="company hidden">Company</th>
                                <th class="account hidden">Account</th>
                                <th class="country hidden">Country</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <?php
                                    $country_name = '';
                                    if(isset($user['countries_id'])){
                                        $country = \App\Country::find($user['countries_id']);
                                        $country_name = $country->name;
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="" />
                                            <label><span></span></label>
                                        </td>
                                        <td>
                                            <div class="piluku-dropdown dropdown btn-group table_buttons upordown">
                                                <a href="{{url('admin/employee/edit/'.$user['id'])}}" class="btn btn-more edit_action" title="Update">
                                                    Edit
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{$user['id']}}</td>
                                        <td>
                                            {{ucfirst($user['first_name'])}}
                                        </td>
                                        <td>
                                            @if(isset($user['last_name']))
                                                {{ucfirst($user['last_name'])}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$user['email']}}
                                        </td>
                                        <td>
                                            @if(isset($user['phone']))
                                                {{$user['phone']}}
                                            @endif
                                        </td>
                                        <td class="address1 hidden">
                                            @if(isset($user['address1']))
                                                {{$user['address1']}}
                                            @endif
                                        </td>
                                        <td class="address2 hidden">
                                            @if(isset($user['address2']))
                                                {{$user['address2']}}
                                            @endif
                                        </td>
                                        <td class="zip hidden">
                                            @if(isset($user['zip']))
                                                {{$user['zip']}}
                                            @endif
                                        </td>
                                        <td class="company hidden">
                                            @if(isset($user['company_name']))
                                                {{$user['company_name']}}
                                            @endif
                                        </td>
                                        <td class="account hidden">
                                            @if(isset($user['account']))
                                                {{$user['account']}}
                                            @endif
                                        </td>
                                        <td class="country hidden">
                                            @if($country_name != '')
                                                {{ucfirst($country_name)}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($user['profile_photo']))
                                                <a href="{{asset('public/uploads/Employee/'.$user['profile_photo'])}}">
                                                    <img src="{{asset('public/uploads/Employee/'.$user['profile_photo'])}}" alt="" class="img-polaroid" width="45">
                                                </a>
                                            @else
                                                <a href="{{asset('public/images/avatar-default.jpg')}}">
                                                    <img src="{{asset('public/images/avatar-default.jpg')}}" alt="" class="img-polaroid" width="45">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No record found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    @if(isset($users))
                        <div class="paginatio-row">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop