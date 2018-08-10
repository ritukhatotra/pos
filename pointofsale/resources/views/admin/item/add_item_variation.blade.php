@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="manage_buttons">
            <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10 margin-top-10">
                    <div class="modal-item-info padding-left-10">
                        <div class="modal-item-details margin-bottom-10">
                            <span class="modal-item-name new">ITEM: {{ucfirst($item->item_name)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default panel-piluku manage-table">
            <ul class="nav nav-justified nav-wizard nav-progression">
                <li><a href="javascript:void(0)" class="outbound_link" role="button">Item Info</a></li>
                <li class="active">
                    <a href="{{url('admin/new-item/redirect?type='.$type.'&id='.$item_id)}}" id="variation" class="outbound_link">Variations</a>
                </li>
                <li><a href="javascript:void(0)" id="pricing" class="outbound_link">Pricing</a></li>
                <li><a href="javascript:void(0)" id="inventory" class="outbound_link">Inventory</a></li>
                <li><a href="javascript:void(0)" id="imgs" class="outbound_link">Images</a></li>
                <li><a href="javascript:void(0)" id="loct" class="outbound_link">Locations</a></li>
            </ul>
        </nav>
        <form action="#" id="item_variation_form" class="form-horizontal" method="post" accept-charset="utf-8">
            <div class="row manage-table">
                <div class="col-md-12">
                    <div class="panel panel-piluku">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ion-ios-toggle-outline"></i> Variations <small>(Fields in red are required)</small>
                            </h3>
                            <div class="panel-options custom pagination pagination-top hidden-print text-center" id="pagination_top">
                                <a href="#">
                                    <span class="hidden-xs ion-chevron-left"> Previous Item</span>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="available_attributes" class="col-sm-3 col-md-3 col-lg-2 control-label">Item Attributes:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <div class="input-group">
                                        <select class="form-control" id="available_attributes">
                                            <option value="-1">Select an Attribute</option>
                                            <option value="0">New Custom Attribute</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button id="add_attribute" class="btn btn-primary" type="button">Add</button>
						                </span>
                                    </div>
                                    <table id="attributes" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Value</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="p-top-5">
                                        <a href="#" class="outbound_link" title="Manage Global Attributes">Manage Global Attributes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-lg-2 control-label">Item Variations:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <table id="item_variations" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Attributes</th>
                                                <th>Item Number</th>
                                                <th>Variation ID</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <a href="javascript:void(0);" id="add_item_variation">Add Item Variation</a><br/><br/><br/><br/><br/><br/>
                                    <a href="#" id="auto_create_all_cariations" class="btn btn-success">Auto create variations</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="submit" value="Save" id="submitf" class="submit_button floating-button btn btn-lg btn-primary"  />
            </div>
        </form>

        {{-- popup --}}
        <div class="modal fade category-input-data" id="check_attribute" tabindex="-1" role="dialog" aria-labelledby="manage_manufactureData" aria-hidden="true">
            <div class="modal-dialog customer-recent-sales">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h4>Please Select An Attribute.</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade category-input-data" id="new_attribute" tabindex="-1" role="dialog" aria-labelledby="manage_manufactureData" aria-hidden="true">
            <div class="modal-dialog customer-recent-sales">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Please Enter An Attribute Name:</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" value="" id="att_name" class="form-control form-inps"  />
                            <span id="att_err_msg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="ok_btn">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop