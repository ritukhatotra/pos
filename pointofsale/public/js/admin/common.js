var BASE_URL = "http://localhost/ritu/pointofsale/";

jQuery(function() {
    jQuery("#login-form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

/* get state by country id */
jQuery("#country").change('on', function(){
    let country = $("#country option:selected").val();

    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/getState',
        data : {country_id : country},
        success: function(res) {
            $("#state").append(res);
        }
    });
});

/* show dropdown column configuration */
jQuery("#dd_toggle").click('on', function(){
    if($('#sortable').hasClass('show_window')){
        $("#sortable").removeClass('show_window');
    } else {
        $("#sortable").addClass('show_window');
    }
});

/* add columns */
jQuery("#add_first_name").change('on', function() {
    if($(this).prop("checked") == true){
        $('.first_name').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.first_name').addClass('hidden');
    }
});

jQuery("#add_last_name").change('on', function() {
    if($(this).prop("checked") == true){
        $('.last_name').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.last_name').addClass('hidden');
    }
});

jQuery("#add_company_name").change('on', function() {
    if($(this).prop("checked") == true){
        $('.company').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.company').addClass('hidden');
    }
});

jQuery("#add_account").change('on', function() {
    if($(this).prop("checked") == true){
        $('.account').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.account').addClass('hidden');
    }
});

jQuery("#add_address1").change('on', function() {
    if($(this).prop("checked") == true){
        $('.address1').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.address1').addClass('hidden');
    }
});

jQuery("#add_address2").change('on', function() {
    if($(this).prop("checked") == true){
        $('.address2').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.address2').addClass('hidden');
    }
});

jQuery("#add_zip").change('on', function() {
    if($(this).prop("checked") == true){
        $('.zip').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.zip').addClass('hidden');
    }
});

jQuery("#add_country").change('on', function() {
    if($(this).prop("checked") == true){
        $('.country').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.country').addClass('hidden');
    }
});

jQuery("#add_product_id").change('on', function() {
    if($(this).prop("checked") == true){
        $('.product_id').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.product_id').addClass('hidden');
    }
});

jQuery("#add_category").change('on', function() {
    if($(this).prop("checked") == true){
        $('.category').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.category').addClass('hidden');
    }
});

jQuery("#add_supplier").change('on', function() {
    if($(this).prop("checked") == true){
        $('.supplier').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.supplier').addClass('hidden');
    }
});

jQuery("#add_taxgroup").change('on', function() {
    if($(this).prop("checked") == true){
        $('.taxgroup').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.taxgroup').addClass('hidden');
    }
});

jQuery("#add_tags").change('on', function() {
    if($(this).prop("checked") == true){
        $('.tags').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.tags').addClass('hidden');
    }
});

jQuery("#add_price_include_tax").change('on', function() {
    if($(this).prop("checked") == true){
        $('.price_include_tax').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.price_include_tax').addClass('hidden');
    }
});

jQuery("#add_promo_price").change('on', function() {
    if($(this).prop("checked") == true){
        $('.promo_price').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.promo_price').addClass('hidden');
    }
});

jQuery("#add_promo_start_date").change('on', function() {
    if($(this).prop("checked") == true){
        $('.promo_start_date').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.promo_start_date').addClass('hidden');
    }
});

jQuery("#add_promo_end_date").change('on', function() {
    if($(this).prop("checked") == true){
        $('.promo_end_date').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.promo_end_date').addClass('hidden');
    }
});

jQuery("#add_item_serial_number").change('on', function() {
    if($(this).prop("checked") == true){
        $('.item_serial_no').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.item_serial_no').addClass('hidden');
    }
});

jQuery("#add_last_modified").change('on', function() {
    if($(this).prop("checked") == true){
        $('.last_modified').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.last_modified').addClass('hidden');
    }
});

jQuery("#add_weight").change('on', function() {
    if($(this).prop("checked") == true){
        $('.weight').removeClass('hidden');
    } else if($(this).prop("checked") == false){
        $('.weight').addClass('hidden');
    }
});
/* end add column*/
/*search */
jQuery("#search").on('keyup',function() {
    var input = $(this).val();
    var type = $("#search-type").val();
    if(input.length > 0) {
        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url  : BASE_URL+'ajax/search',
            data : {name : input, type: type},
            success: function(res) {
                $("#srch-result").removeClass('hidden');
                $("#srch-result").html(res);
            }
        });
    } else {
        $("#srch-result").addClass('hidden');
    }
});
/* btn click */
jQuery("#srch-btn").on('click',function() {
    var input = $(this).val();
    var type = $("#search-type").val();
    if(input.length > 0) {
        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url  : BASE_URL+'ajax/search',
            data : {name : input, type: type},
            success: function(res) {
                $("#srch-result").removeClass('hidden');
                $("#srch-result").html(res);
            }
        });
    } else {
        $("#srch-result").addClass('hidden');
    }
});
/* press enter */
$('#search').keypress(function (e) {
    var key = e.which;
    if(key == 13) {
        var input = $(this).val();
        var type = $("#search-type").val();
        if(input.length > 0) {
            $.ajax({
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url  : BASE_URL+'ajax/search',
                data : {name : input, type: type},
                success: function(res) {
                    $("#srch-result").removeClass('hidden');
                    $("#srch-result").html(res);
                }
            });
        } else {
            $("#srch-result").addClass('hidden');
        }
    }
});
/*end search */

function getData(id, type) {
    $("#srch-result").addClass('hidden');
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/show-search-data',
        data : {id : id, type: type},
        success: function(res) {
            $("table#sortable_table tbody").html(res);
        }
    });
}

jQuery("#profile").on('change', function(event){
    var output = document.getElementById('avatar-photo');
    output.src = URL.createObjectURL(event.target.files[0]);
});