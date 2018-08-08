<div class="left-bar hidden-print">
    <div class="admin-logo">
        <div class="logo-holder pull-left">
            <img src="{{asset('public/images/header_logo.png')}}" class="hidden-print logo" id="header-logo" alt="">
        </div>
    </div>
    <ul class="list-unstyled menu-parent" id="mainMenu">
        <li class="active">
            <a href="{{url('admin/dashboard')}}">
                <i class="icon ti-dashboard"></i><span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/customers')}}">
                <i class="icon ti-user"></i> <span class="text">Customers</span>
            </a>
        </li>
        <li><a href="{{url('admin/items')}}"><i class="icon ti-harddrive"></i> <span class="text">Items</span></a> </li>
        <li><a href="#"><i class="icon ti-harddrives"></i><span class="text">Item Kits</span></a></li>
        <li><a href="#"><i class="ion-ios-pricetags-outline"></i><span class="text">Price Rules</span></a></li>
        <li><a href="#"><i class="icon ti-download"></i><span class="text">Suppliers</span></a></li>
        <li><a href="#"><i class="icon ti-bar-chart"></i><span class="text">Reports</span></a></li>
        <li><a href="#"><i class="icon ti-cloud-down"></i><span class="text">Receiving</span></a></li>
        <li><a href="#"><i class="icon ti-shopping-cart"></i><span class="text">Sales</span></a></li>
        <li><a href="#"><i class="ion-android-car"></i><span class="text">Deliveries</span></a></li>
        <li><a href="#"><i class="icon ti-money"></i><span class="text">Expenses</span></a></li>
        <li>
            <a href="{{url('admin/employees')}}">
                <i class="icon ti-id-badge"></i>
                <span class="text">Employees</span>
            </a>
        </li>
        <li><a href="#"><i class="icon ti-credit-card"></i><span class="text">Gift Cards</span></a></li>
        <li><a href="#"><i class="icon ti-settings"></i><span class="text">Store Config</span></a></li>
        <li><a href="#"><i class="icon ti-home"></i><span class="text">Locations</span></a></li>
        <li><a href="#"><i class="icon ti-email"></i><span class="text">Messages</span></a></li>
        <li>
            <a href="{{url('admin/logout')}}">
                <i class="icon ti-power-off"></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</div>