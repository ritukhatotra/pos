@if($current_url == env('APP_URL').'admin/new-customer')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/customers')}}">Customers</a>
        <a href="{{url('admin/new-custmer')}}">New Customer</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/customers')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/customers')}}">Customers</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/customer/edit/'.Request::segment(4))
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/customers')}}">Customers</a>
        <a href="{{url('admin/customer/edit').'/'.Request::segment(4)}}">Edit Customer</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/new-employee')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/employees')}}">Employees</a>
        <a href="#">New Employee</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/employees')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="#">Employees</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/employee/edit/'.Request::segment(4))
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/employees')}}">Employees</a>
        <a href="#">Edit</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/items')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/items')}}">Items</a>
    </div>
@elseif($current_url == env('APP_URL').'admin/new-item')
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
        <a href="{{url('admin/items')}}">Items</a>
        <a href="#">New Item</a>
    </div>
@else
    <div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
        <a href="{{url('admin/dashboard')}}">Dashboard</a>
    </div>
@endif
