<!doctype html>
<html>
@include('common.head')
<body>
    <div class="wrapper sales-bar mini-bar">
        @include('common.sidebar')
        <div class="content" id="content">
            @include('common.top_navigation')
            @yield('content')
            {{--<div id="footers" class="col-md-12 hidden-print text-center"> Please visit our <a href="#">Website</a> to learn the latest information about the project.
                <span class="text-info">
                    You are using PHP Point Of Sale Version
                    <span class="badge bg-primary"> 16.2</span>
                </span>
                Built on 07/15/2018 12:23 pm EST
            </div>--}}
        </div>
    </div>
<script src="{{asset('public/js/all.js')}}"></script>
<script src="{{asset('public/js/admin/common.js')}}"></script>
@if($current_url == env('APP_URL').'admin/new-employee' || $current_url == env('APP_URL').'admin/employees' || $current_url == env('APP_URL').'admin/employee/edit/'.Request::segment(4))
    <script src="{{asset('public/js/datepicker.js')}}"></script>
    <script src="{{asset('public/js/admin/employee.js')}}"></script>
@endif
@if($current_url == env('APP_URL').'admin/new-customer' || $current_url == env('APP_URL').'admin/customers' || $current_url == env('APP_URL').'admin/customer/edit/'.Request::segment(4))
    <script src="{{asset('public/js/admin/customer.js')}}"></script>
@endif
@if($current_url == env('APP_URL').'admin/items' || $current_url == env('APP_URL').'admin/new-item' || $current_url == env('APP_URL').'admin/new-item/redirect')
    <script src="{{asset('public/js/admin/item.js')}}"></script>
@endif
</body>
</html>

