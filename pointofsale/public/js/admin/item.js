var BASE_URL = "http://localhost/ritu/pointofsale/";

jQuery("#category_image").on('change', function(event){
    jQuery("#preview-section").removeClass('hidden');
    var output = document.getElementById('image-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
});

/* add item */
jQuery(function() {
    jQuery("#item_form").validate({
        rules: {
            item_name: {
                required: true
            },
            categories_id: {
                required: true
            }
        },
        submitHandler: function(form) {
            var frm = $("#item_form");
            $.ajax({
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url  : BASE_URL+'ajax/save-item',
                data : frm.serialize(),
                success: function(res) {
                    if(res === 'exist') {
                        $('#item_msg').html('Already exist');
                    } else if(res === 'exist_upc') {
                        $('#upc_msg').html('Already exist');
                    } else {
                       window.location.href = BASE_URL+'admin/new-item/redirect?type=variation&id='+res;
                    }
                }
            });
        }
    });
});

/* show item serial no */
jQuery("#is_serialized").on('change', function() {
    if($(this).prop("checked") == true){
        $("#serial_container").removeClass('hidden');
    }else if($(this).prop("checked") == false){
        $("#serial_container").addClass('hidden');
    }
});

/*  add item numbers */
var flag = 0;
jQuery("#add_addtional_item_number").on('click', function() {
    flag++;
    if(flag<=5) {
        $("#item-no").append('<input type="text" name="value[]" id="item_'+flag+'" value="'+flag+'" class="form-control form-inps dynamic-input"/>');
        if(flag == 5) {
            $("#add_addtional_item_number").addClass('hidden');
            $("#remove_addtional_item_number").removeClass('hidden');
            flag = 0;
        }
    }  else {
        flag = 0;
    }
});

var removeFlag = 6;
jQuery("#remove_addtional_item_number").on('click', function() {
    removeFlag--;
    if(removeFlag>0) {
        $('#item_'+removeFlag+'').remove();
        if(removeFlag == 1) {
            $("#remove_addtional_item_number").addClass('hidden');
            $("#add_addtional_item_number").removeClass('hidden');
            removeFlag = 6;
        }
    } else {
        removeFlag = 6;
    }
});
/* add category */
jQuery(function() {
    jQuery("#categories_form").validate({
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function(form) {
            var frm = $("#categories_form");
            $.ajax({
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url  : BASE_URL+'ajax/add-category',
                data : frm.serialize(),
                success: function(res) {
                    if(res === 'exist') {
                        $('#cate_msg').html('Already exist');
                    } else {
                        $("#category_id").append(res);
                        $("#parent_id").append(res);
                        $('#categories_form')[0].reset();
                        $('#category-input-data').modal('hide');
                    }
                }
            });
        }
    });
});

/* add manufacturer */
jQuery(function() {
    jQuery("#manage_manufacture_form").validate({
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function(form) {
            var frm = $("#manage_manufacture_form");
            $.ajax({
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url  : BASE_URL+'ajax/add-manufacturer',
                data : frm.serialize(),
                success: function(res) {
                    if(res === 'exist') {
                        $('#manufacture_msg').html('Already exist');
                    } else {
                        $('#manufacture_msg').html('');
                        $("#manufacturer_id").append(res);
                        $('#manage_manufacture_form')[0].reset();
                        $('#manage_manufacture').modal('hide');
                    }
                }
            });
        }
    });
});

/* item attribute */
$('#add_attribute').on('click', function() {
    var select = $("#available_attributes option:selected").val();
    if(select == -1) {
        $("#check_attribute").modal('show');
    } else if(select == 0) {
        $("#new_attribute").modal('show');
    } else {
        alert("else");
    }
});

/* ok btn */
$('#ok_btn').on('click', function() {
   var input = $("#att_name").val();
   if(input.length > 0) {
       
   } else {
       $("#att_err_msg").html("Enter attribute name.");
   }
});

