@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="manage_buttons">
            <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10 margin-top-10">
                    <div class="modal-item-info padding-left-10">
                        <div class="modal-item-details margin-bottom-10">
                            <span class="modal-item-name new">New Item</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default panel-piluku manage-table">
            <ul class="nav nav-justified nav-wizard nav-progression">
                <li>
                    <a href="javascript:void(0)" class="outbound_link" role="button">Item Info</a>
                </li>
                <li  class="active"><a href="{{url('admin/new-item/redirect?type='.$type.'&id='.$item_id)}}" id="variation" class="outbound_link">Variations</a></li>
                <li><a href="javascript:void(0)" id="pricing" class="outbound_link">Pricing</a></li>
                <li><a href="javascript:void(0)" id="inventory" class="outbound_link">Inventory</a></li>
                <li><a href="javascript:void(0)" id="imgs" class="outbound_link">Images</a></li>
                <li><a href="javascript:void(0)" id="loct" class="outbound_link">Locations</a></li>
            </ul>
        </nav>
    </div>
@stop