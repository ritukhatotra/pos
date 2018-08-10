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
                <li class="active">
                    <a href="{{url('admin/new-item')}}" class="outbound_link" role="button">Item Info</a>
                </li>
                <li><a href="javascript:void(0)" id="variation" class="outbound_link">Variations</a></li>
                <li><a href="javascript:void(0)" id="pricing" class="outbound_link">Pricing</a></li>
                <li><a href="javascript:void(0)" id="inventory" class="outbound_link">Inventory</a></li>
                <li><a href="javascript:void(0)" id="imgs" class="outbound_link">Images</a></li>
                <li><a href="javascript:void(0)" id="loct" class="outbound_link">Locations</a></li>
            </ul>
        </nav>
        <form id="item_form" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="row manage-table" id="form">
                <div class="col-md-12">
                    <div class="panel panel-piluku">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ion-information-circled"></i> Item Information
                                <small>(Fields in red are required)</small>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label  class="col-sm-3 col-md-3 col-lg-2 control-label required wide">Item Name:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="item_name" value="" id="name" class="form-control form-inps">
                                    <span id="item_msg"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-lg-2 control-label  required wide">Category:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <select name="categories_id" class="form-control form-inps selectized" id="category_id">
                                        <option value="" selected="selected">Select Category</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{$category['id']}}">{{ucfirst($category['name'])}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        <a href="javascript:void(0);" id="add_category" data-toggle="modal" data-target="#category-input-data">Add Category</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="supplier_id" class="col-sm-3 col-md-3 col-lg-2 control-label wide ">Supplier:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <select name="suppliers_id" class="form-control selectized" id="supplier_id">
                                        <option value="" selected="selected">Select Supplier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item_number" class="col-sm-3 col-md-3 col-lg-2 control-label wide">UPC/EAN/ISBN:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="UPC_EAN_ISBN" value="" id="item_number" class="form-control form-inps">
                                    <span id="upc_msg"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_id" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Product ID:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="product_id" value="" id="product_id" class="form-control form-inps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item-no" class="col-sm-3 col-md-3 col-lg-2 control-label">Additional Item Numbers</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <div id="item-no">
                                        <input type="text" name="value[]" value="" class="form-control form-inps">
                                    </div>
                                    <a href="javascript:void(0);" id="add_addtional_item_number">Add item number</a>
                                    <a href="javascript:void(0);" id="remove_addtional_item_number" class="hidden">Remove item number</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tags" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tags:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="item_tags" value="" id="tags" class="form-control form-inps">
                                </div>
                            </div>
                            <input type="hidden" name="size" value="">
                            <div class="form-group">
                                <label for="manufacturer_id" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Manufacturer:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <select name="manufactures_id" class="form-control" id="manufacturer_id">
                                        <option value="">None</option>
                                        @if(isset($manufacturers))
                                            @foreach($manufacturers as $manufacturer)
                                                <option value="{{$manufacturer['id']}}">{{ucfirst($manufacturer['name'])}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#manage_manufacture">Manage Manufacturers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Description:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <textarea name="description" id="description" class="form-control  text-area"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weight" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Weight:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="weight" value="" id="weight" class="form-control form-inps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dimensions" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Dimensions:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="dimension_length" value="" id="length" placeholder="Length" class="form-control form-inps">
                                    <br>
                                    <input type="text" name="dimension_width" value="" id="width" placeholder="Width" class="form-control form-inps">
                                    <br>
                                    <input type="text" name="dimension_height" value="" id="height" placeholder="Height" class="form-control form-inps">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_service" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Is Service:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="checkbox" name="is_service" value="1" id="is_service" class="delete-checkbox">
                                    <label for="is_service"><span></span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_serialized" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Item has Serial Number:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="checkbox" name="items_has_serial_number" value="1" id="is_serialized" class="delete-checkbox">
                                    <label for="is_serialized"><span></span></label>
                                </div>
                            </div>
                            <div id="serial_container" class="form-group serial-input hidden">
                                <label class="col-sm-3 col-md-3 col-lg-2 control-label">Serial Number:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="serial_number" value="" id="serial_container" class="form-control form-inps" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile" class="col-sm-3 col-md-3 col-lg-2 control-label ">Select Image:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <ul class="list-unstyled avatar-list">
                                        <li>
                                            <input type="file" name="item_photo" id="profile" class="filestyle">
                                        </li>
                                        <li>
                                            <div id="avatar">
                                                <img style="width: 20%; margin-top:10px;" src="{{asset('public/images/avatar.jpg')}}" class="img-polaroid" id="avatar-photo" alt="">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{Auth::user()->id}}" name="users_id"/>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Save" id="submitf" class="submit_button floating-button btn btn-lg btn-primary">
                    </div>
                </div>
            </div>
        </form>
        <!--  add category modal -->
        <div class="modal fade category-input-data" id="category-input-data" tabindex="-1" role="dialog" aria-labelledby="categoryData" aria-hidden="true">
            <div class="modal-dialog customer-recent-sales">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" id="categories_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label for="parent_id" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Parent Category:</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select name="parent_category_id" class="form-control form-inps" id="parent_id">
                                        <option value="">Select Category</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{$category['id']}}">{{ucfirst($category['name'])}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Category Name:</label>					<div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="text" name="name" value="" id="category_name" class="form-control form-inps"  />
                                    <span id="cate_msg"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_color" class="col-sm-3 col-md-3 col-lg-2 control-label">Category Color:</label>					<div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="text" name="color" value="" class="form-control form-inps" id="category_color"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_image" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Category Image:</label>					<div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="image-upload">
                                        <input type="file" name="image" value="" id="category_image" class="filestyle form-control form-inps" data-icon="false"  />
                                    </div>
                                </div>
                            </div>
                            <div id="preview-section" class="form-group hidden">
                                <label for="category_image_preview" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Image Preview:</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <img id="image-preview" src="#" alt="preview" style="max-width: 100%;">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="submit-cat" value="Add" id="submit-cat" class="submit_button pull-right btn btn-primary"  />
                                <div class="clearfix">&nbsp;</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end category modal -->
        <!--  manage manage_manufacture modal -->
        <div class="modal fade category-input-data" id="manage_manufacture" tabindex="-1" role="dialog" aria-labelledby="manage_manufactureData" aria-hidden="true">
            <div class="modal-dialog customer-recent-sales">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Manufacturer</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" id="manage_manufacture_form" class="form-horizontal" method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label for="category_name" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Name:</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="text" name="name" value="" class="form-control form-inps"  autocomplete="off"/>
                                    <span id="manufacture_msg"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="submit-manage_manufacture" value="Add" class="submit_button pull-right btn btn-primary"  />
                                <div class="clearfix">&nbsp;</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end manage_manufacture modal -->
    </div>
@stop