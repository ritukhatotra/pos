@extends('admin.main')
@section('content')
    <div class="main-content">
        <div class="manage_buttons">
            <div class="manage-row-options hidden">
                <div class="email_buttons people">
                    <a class="btn btn-primary btn-lg email" title=""  href="#">
                        <span class="ion-email"> E-Mail</span>
                    </a>

                    <a class="btn btn-primary btn-lg labels" title=""  href="#">
                        <span class="ion-android-list"></span> <span class="hidden-xs">Mailing Labels</span>
                    </a>

                    <a href="#" id="generate_barcode_labels" class="btn btn-primary btn-lg" title="">
                        <span class="ion-ios-barcode"></span> <span class="hidden-xs">Barcode Labels</span>
                    </a>

                    <a href="#"  class="btn btn-primary btn-lg" target="_blank">
                        <span class="ion-document"></span>
                        <span class="hidden-xs">Barcode Sheet</span>
                    </a>

                    <a href="#"  class="btn btn-red btn-lg" title="">
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
                <div class="col-md-9 col-sm-10 col-xs-10">
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
                    </div>
                </div>

                <div class="col-md-3 col-sm-2 col-xs-2">
                    <div class="buttons-list items-buttons">
                        <div class="pull-right-btn">
                            <a href="{{url('admin/new-item')}}" id="new-person-btn" class="btn btn-primary btn-lg hidden-sm hidden-xs">
                                <span class="ion-plus"> New Item</span>
                            </a>
                            <div class="piluku-dropdown btn-group">
                                <button type="button" class="btn btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="hidden-xs ion-android-more-horizontal"> </span>
                                    <i class="visible-xs ion-android-more-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="visible-sm visible-xs">
                                        <a href="#"  title="New Item">
                                            <span class="ion-plus-round"> Add New Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="custom_fields"  title="Manage Attributes">
                                            <span class="ion-ios-toggle-outline"> Manage Attributes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  title="Manage categories">
                                            <span class="ion-ios-folder-outline"> Manage categories</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  title="Manage tags">
                                            <span class="ion-ios-pricetag-outline"> Manage tags</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  title="Manage Manufacturers">
                                            <span class="ion-settings"> Manage Manufacturers</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  title="Count inventory">
                                            <span class="ion-ios-paper-outline"> Count inventory</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  title="Excel Import">
                                            <span class="ion-ios-download-outline"> Excel Import</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class=" " title="Excel Export">
                                            <span class="ion-ios-upload-outline"> Excel Export</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="cleanup"  title="Cleanup Old Items">
                                            <span class="ion-loop"> Cleanup Old Items</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="custom_fields"  title="Custom Field Configuration">
                                            <span class="ion-wrench"> Custom Field Configuration</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="toggle_deleted" title="Manage Deleted Items">
                                            <span class="ion-trash-a"> Manage Deleted Items</span>
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
                            Items
                            <span class="badge bg-primary tip-left" id="manage_total_items">
                                 @if(isset($items))
                                    {{$item_count}}
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
                                                <input type="checkbox" class="columns" value="product_id" name="colName[]" id="add_product_id"/>
                                                <label class="sortable_column_name" for="add_product_id"><span></span>Product ID</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="category" name="colName[]" id="add_category"/>
                                                <label class="sortable_column_name" for="add_category"><span></span>Category</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="supplier" name="colName[]" id="add_supplier"/>
                                                <label class="sortable_column_name" for="add_supplier"><span></span>Supplier</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="taxgroup" name="colName[]" id="add_taxgroup"/>
                                                <label class="sortable_column_name" for="add_taxgroup"><span></span>Tax Group</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="tags" name="colName[]" id="add_tags"/>
                                                <label class="sortable_column_name" for="add_tags"><span></span>Tags</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="description" name="colName[]" id="add_description"/>
                                                <label class="sortable_column_name" for="add_description"><span></span>Description</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="price_include_tax" name="colName[]" id="add_price_include_tax"/>
                                                <label class="sortable_column_name" for="add_price_include_tax"><span></span>Price Include Tax</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="promo_price" name="colName[]" id="add_promo_price"/>
                                                <label class="sortable_column_name" for="add_promo_price"><span></span>Promo Price</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="promo_start_date" name="colName[]" id="add_promo_start_date"/>
                                                <label class="sortable_column_name" for="add_promo_start_date"><span></span>Promo Start Date</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="promo_end_date" name="colName[]" id="add_promo_end_date"/>
                                                <label class="sortable_column_name" for="add_promo_end_date"><span></span>Promo End Date</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="item_serial_number" name="colName[]" id="add_item_serial_number"/>
                                                <label class="sortable_column_name" for="add_item_serial_number"><span></span>Item has Serial Number</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="last_modified" name="colName[]" id="add_last_modified"/>
                                                <label class="sortable_column_name" for="add_last_modified"><span></span>Last Modified</label>
                                                <span class="handle ion-drag"></span>
                                            </a>
                                        </li>
                                        <li class="sort">
                                            <a href="javascript:void(0)">
                                                <input type="checkbox" class="columns" value="weight" name="colName[]" id="add_weight"/>
                                                <label class="sortable_column_name" for="add_weight"><span></span>Weight</label>
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
                                <th>Item Id</th>
                                <th>UPC/EAN/ISBN</th>
                                <th>Name</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                                <th>Quantity</th>
                                <th>Is Service</th>
                                <th>Is EBT Item</th>
                                <th class="product_id hidden">Product ID</th>
                                <th class="category hidden">Category</th>
                                <th class="supplier hidden">Supplier</th>
                                <th class="taxgroup hidden">Tax Group</th>
                                <th class="tags hidden">Tags</th>
                                <th class="price_include_tax hidden">Price Include Tax</th>
                                <th class="promo_price hidden">Promo Price</th>
                                <th class="promo_start_date hidden">Promo Start Date</th>
                                <th class="promo_end_date hidden">Promo End Date</th>
                                <th class="item_serial_no hidden">Item has Serial No</th>
                                <th class="last_modified hidden">Last Modified</th>
                                <th class="weight hidden">Weight</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    @if(isset($items))
                        <div class="paginatio-row">
                            {{ $items->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop