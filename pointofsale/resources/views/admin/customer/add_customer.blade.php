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
                <form id="customer_form" class="form-horizontal" method="post" action="{{url('save-customer')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="panel panel-piluku">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ion-edit"></i>
                                Customer Information<small> (Fields in red are required)</small>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-3 col-md-3 col-lg-2 control-label red">First Name:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="first_name" value="" class="form-control" id="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class=" col-sm-3 col-md-3 col-lg-2 control-label ">Last Name:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="last_name" value="" class="form-control" id="last_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 col-md-3 col-lg-2 control-label not_required">E-Mail:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="email" value="" class="form-control" id="email">
                                            <span id="email-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number" class="col-sm-3 col-md-3 col-lg-2 control-label ">Phone Number:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="phone" value="" class="form-control" id="phone_number">
                                            <span id="phone-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile" class="col-sm-3 col-md-3 col-lg-2 control-label ">Select Image:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <ul class="list-unstyled avatar-list">
                                                <li>
                                                    <input type="file" name="profile" id="profile" class="filestyle">
                                                </li>
                                                <li>
                                                    <div id="avatar">
                                                        <img style="width: 20%; margin-top:10px;" src="{{asset('public/images/avatar.png')}}" class="img-polaroid" id="avatar-photo" alt="">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_1" class="col-sm-3 col-md-3 col-lg-2 control-label ">Address 1:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="address_1" value="" class="form-control" id="address_1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_2" class="col-sm-3 col-md-3 col-lg-2 control-label ">Address 2:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="address_2" value="" class="form-control" id="address_2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-sm-3 col-md-3 col-lg-2 control-label ">Country:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="country" class="form-control" id="country">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country['id']}}">{{$country['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="col-sm-3 col-md-3 col-lg-2 control-label ">State/Province:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <select name="state" class="form-control" id="state">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-sm-3 col-md-3 col-lg-2 control-label ">City:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="city" value="" class="form-control " id="city">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip" class="col-sm-3 col-md-3 col-lg-2 control-label ">Zip:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="zip" value="" class="form-control " id="zip">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments" class="col-sm-3 col-md-3 col-lg-2 control-label ">Comments:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <textarea name="comments" cols="17" rows="5" id="comments" class="form-control text-area"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="balance" class="col-sm-3 col-md-3 col-lg-2 control-label ">Store account balance:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="balance" value="0.00" id="balance" class="form-control balance">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="credit_limit" class="col-sm-3 col-md-3 col-lg-2 control-label ">Credit limit:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="credit_limit" value="" id="credit_limit" class="form-control credit_limit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disable_loyalty" class="col-sm-3 col-md-3 col-lg-2 control-label ">Disable Loyalty:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="checkbox" name="disable_loyalty" value="1" id="disable_loyalty">
                                    <label for="disable_loyalty"><span></span></label>
                                </div>
                            </div>
                            <div class="form-group quantity-input">
                                <label class="col-sm-3 col-md-3 col-lg-2 control-label wide">Amount to spend for next point:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="amount_to_spend_for_next_point" value="0.00" id="amount_to_spend_for_next_point" class="form-control amount_to_spend_for_next_point">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="points" class="col-sm-3 col-md-3 col-lg-2 control-label ">Points:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="points" value="0.00" id="points" class="form-control points">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company_name" class="col-sm-3 col-md-3 col-lg-2 control-label ">Company Name:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="company_name" value="" id="company_name" class="company_names form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="account_number" class="col-sm-3 col-md-3 col-lg-2 control-label ">Account #:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="account_number" value="" id="account_number" class="company_names form-control">
                                    <span id="acc_no"></span>
                                </div>
                            </div>
                            <div class="form-group override-taxes-container">
                                <label class="col-sm-3 col-md-3 col-lg-2 control-label wide">Override Default Tax For Sale:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="checkbox" name="override_default_tax" value="1" id="override_default_tax" class="override_default_tax_checkbox delete-checkbox">
                                    <label for="override_default_tax"><span></span></label>
                                </div>
                            </div>
                            <div class="tax-container main hidden" id="override">
                                <div class="form-group">
                                    <label for="tax_class" class="col-sm-3 col-md-3 col-lg-2 control-label">Tax Group: </label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <select name="tax_class" id="tax_class" class="form-control tax_class">
                                            <option value="">Select</option>
                                            <option value="1">tax</option>
                                            <option value="2">State sales</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="text-center">OR</h4>
                                </div>
                                <div class="form-group">
                                    <label for="tax_percent_1" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tax 1:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <input type="text" name="tax1_name" value="" id="tax_percent_1" size="8" class="form-control margin10 form-inps" placeholder="Tax Name">
                                    </div>
                                    <label class="col-sm-3 col-md-3 col-lg-2 control-label wide" for="tax_percent_name_1">&nbsp;</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <input type="text" name="tax1_value" value="" id="tax_percent_name_1" size="3" class="form-control form-inps-tax" placeholder="Tax Percent">
                                        <div class="tax-percent-icon">%</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tax_percent_2" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tax 2:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <input type="text" name="tax2_name" value="" id="tax_percent_2" size="8" class="form-control form-inps margin10" placeholder="Tax Name">
                                    </div>
                                    <label class="col-sm-3 col-md-3 col-lg-2 control-label text-info wide">&nbsp;</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <input type="text" name="tax2_value" value="" id="tax_percent_name_2" size="3" class="form-control form-inps-tax" placeholder="Tax Percent">
                                        <div class="tax-percent-icon">%</div>
                                        <div class="clear"></div>
                                        <input type="checkbox" name="tax_cumulatives" value="1" class="cumulative_checkbox" id="tax_cumulatives">
                                        <label for="tax_cumulatives"><span></span></label>
                                        <span class="cumulative_label"> Cumulative</span>
                                    </div>
                                </div>
                                {{--<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9 col-lg-offset-3" style="visibility: visible">
                                    <a href="javascript:void(0);" class="show_more_taxes">Show More »</a>
                                </div>--}}
                                {{--<div class="more_taxes_container" style="display: none">
                                    <div class="form-group">
                                        <label for="tax_percent_3" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tax 3:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_names[]" value="" id="tax_percent_3" size="8" class="form-control form-inps margin10" placeholder="Tax Name">
                                        </div>
                                        <label class="col-sm-3 col-md-3 col-lg-2 control-label wide">&nbsp;</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_percents[]" value="" id="tax_percent_name_3" size="3" class="form-control form-inps-tax margin10" placeholder="Tax Percent">
                                            <div class="tax-percent-icon">%</div>
                                            <div class="clear"></div>
                                            <input type="hidden" name="tax_cumulatives[]" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_percent_4" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tax 4:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_names[]" value="" id="tax_percent_4" size="8" class="form-control  form-inps margin10" placeholder="Tax Name">
                                        </div>
                                        <label class="col-sm-3 col-md-3 col-lg-2 control-label wide">&nbsp;</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_percents[]" value="" id="tax_percent_name_4" size="3" class="form-control form-inps-tax" placeholder="Tax Percent">
                                            <div class="tax-percent-icon">%</div>
                                            <div class="clear"></div>
                                            <input type="hidden" name="tax_cumulatives[]" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_percent_5" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Tax 5:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_names[]" value="" id="tax_percent_5" size="8" class="form-control  form-inps margin10" placeholder="Tax Name">
                                        </div>
                                        <label class="col-sm-3 col-md-3 col-lg-2 control-label wide">&nbsp;</label>

                                        <div class="col-sm-9 col-md-9 col-lg-10">
                                            <input type="text" name="tax_percents[]" value="" id="tax_percent_name_5" size="3" class="form-control form-inps-tax margin10" placeholder="Tax Percent">
                                            <div class="tax-percent-icon">%</div>
                                            <div class="clear"></div>
                                            <input type="hidden" name="tax_cumulatives[]" value="0">
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="clear"></div>
                            </div>
                            <div class="form-group">
                                <label for="taxable" class="col-sm-3 col-md-3 col-lg-2 control-label ">Taxable:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="checkbox" name="taxable" value="1" checked="checked" id="taxable">
                                    <label for="taxable"><span></span></label>
                                </div>
                            </div>
                            <div class="form-group hidden" id="tax_certificate_holder">
                                <label for="tax_certificate" class="col-sm-3 col-md-3 col-lg-2 control-label ">Non tax certificate number:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input type="text" name="tax_certificate" value="" id="tax_certificate" class="company_names form-control">
                                </div>
                            </div>
                            <div class="panel panel-piluku">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="ion-folder"></i>Files</h3>
                                </div>
                                <h4 style="padding: 20px;">Add Files</h4>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_1" class="col-sm-3 col-md-3 col-lg-2 control-label ">File 1:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="files[]" id="files_1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_2" class="col-sm-3 col-md-3 col-lg-2 control-label ">File 2:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="files[]" id="files_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_3" class="col-sm-3 col-md-3 col-lg-2 control-label ">File 3:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="files[]" id="files_3">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_4" class="col-sm-3 col-md-3 col-lg-2 control-label ">File 4:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="files[]" id="files_4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left: 10px;">
                                    <label for="files_5" class="col-sm-3 col-md-3 col-lg-2 control-label ">File 5:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-10">
                                        <div class="file-upload">
                                            <input type="file" name="files[]" id="files_5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="redirect_code" value="0">
                            <div class="form-actions">
                                <input type="submit" name="submit" value="Save" id="submitf" class=" submit_button floating-button btn btn-lg btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop