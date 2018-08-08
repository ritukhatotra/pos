@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="text-center">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="dashboard-stats">
                            <div class="left">
                                <h3 class="flatBluec">3</h3>
                                <h4>Total Sales</h4>
                            </div>
                            <div class="right flatBlue"> <i class="ion ion-ios-cart-outline"></i> </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{url('admin/customers')}}">
                        <div class="dashboard-stats" id="totalCustomers">
                            <div class="left">
                                <h3 class="flatGreenc">{{$customers_count}}</h3>
                                <h4>Total Customers</h4>
                            </div>
                            <div class="right flatGreen"> <i class="ion ion-ios-people-outline"></i> </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="dashboard-stats">
                            <div class="left">
                                <h3 class="flatRedc">3</h3>
                                <h4>Total Items</h4>
                            </div>
                            <div class="right flatRed"> <i class="icon ti-harddrive"></i> </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="dashboard-stats">
                            <div class="left">
                                <h3 class="flatOrangec">0</h3>
                                <h4>Total Item Kits</h4>
                            </div>
                            <div class="right flatOrange"> <i class="ion ion-filing"></i> </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <h5 class="text-center">Welcome to PHP Point Of Sale, choose a common task below to get started!</h5>
        <div class="row quick-actions">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list-group">
                    <a class="list-group-item" href="#"> <i class="icon ti-shopping-cart"></i> Start a New Sale</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list-group">
                    <a class="list-group-item" href="#"><i class="icon ti-cloud-down"></i> Start a New Receiving</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list-group">
                    <a class="list-group-item" href="#"> <i class="ion-clock"></i> Today's closeout report</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list-group">
                    <a class="list-group-item" href="#"> <i class="ion-clock"></i> Today's detailed sales report</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list-group">
                    <a class="list-group-item" href="#"> <i class="ion-stats-bars"></i> Today's summary items report</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="panel-heading">
                            <h4 class="text-center">Sales Information</h4>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs piluku-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#month" data-type="monthly" aria-controls="month" role="tab">Month</a></li>
                            <li role="presentation"><a href="#week" data-type="weekly" aria-controls="week" role="tab">Week</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content piluku-tab-content">
                            <div role="tabpanel" class="tab-pane active" id="month">
                                <div class="chart">
                                    <canvas id="charts" width="1306" height="326" style="width: 1306px; height: 326px;"></canvas>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="week"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop