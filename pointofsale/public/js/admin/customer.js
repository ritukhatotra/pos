var BASE_URL = "http://localhost/ritu/pos/pointofsale/";

/* customer */
jQuery(function() {
    jQuery("#customer_form").validate({
        rules: {
            first_name: {
                required: true
            },
            email: {
                email: true
            },
            phone: {
                number: true
            },
            account_number: {
                number: true
            },
            zip: {
                number: true
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

/* check duplicate email */
$("#email").blur(function(){
    let email = $(this).val();
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/checkCustomerEmail',
        data : {email : email},
        success: function(res) {
            if(res === 'exist') {
                $('#email-msg').html('Email already exist.');
            } else {
                $('#email-msg').html('');
            }
        }
    });
});

/* check duplicate phone */
$("#phone_number").blur(function(){
    let phone = $(this).val();
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/checkCustomerPhone',
        data : {phone : phone},
        success: function(res) {
            if(res === 'exist') {
                $('#phone-msg').html('Phone number already exist.');
            } else {
                $('#phone-msg').html('');
            }
        }
    });
});

/* check duplicate customer account */
$("#account_number").blur(function(){
    let acc = $(this).val();
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/checkCustomerAccount',
        data : {acc : acc},
        success: function(res) {
            if(res === 'exist') {
                $('#acc_no').html('Account number already exist.');
            } else {
                $('#acc_no').html('');
            }
        }
    });
});

/* show override input*/
jQuery("#override_default_tax").on('change', function() {
    if($(this).prop("checked") == true){
       $("#override").removeClass('hidden');
    }else if($(this).prop("checked") == false){
        $("#override").addClass('hidden');
    }
});

/* show taxable certifcate */
/* show override input*/
jQuery("#taxable").on('change', function() {
    if($(this).prop("checked") == true){
        $("#tax_certificate_holder").addClass('hidden');
    }else if($(this).prop("checked") == false){
        $("#tax_certificate_holder").removeClass('hidden');
    }
});

jQuery(document).ready(function () {
    if($("#taxable").prop("checked") == true){
        $("#tax_certificate_holder").addClass('hidden');
    }else if($("#taxable").prop("checked") == false){
        $("#tax_certificate_holder").removeClass('hidden');
    }

    if($("#override_default_tax").prop("checked") == true){
        $("#override").removeClass('hidden');
    }else if($("#override").prop("checked") == false){
        $("#override").addClass('hidden');
    }
});

/* edit customer */
jQuery(function() {
    jQuery("#edit_customer_form").validate({
        rules: {
            first_name: {
                required: true
            },
            email: {
                email: true
            },
            phone: {
                number: true
            },
            account_number: {
                number: true
            },
            zip: {
                number: true
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

/* dlt image */
jQuery("#dlt-profile").on('change', function() {
    if($(this).prop("checked") == true){
        let id = $("#token").val();
        $.ajax({
            type: "GET",
            url: BASE_URL+"admin/customer/deleteProfilePhoto",
            data: "id="+id,
            success: function (response) {
                let img = BASE_URL+'public/images/avatar.png';
                $('.imgloc_'+id).remove('.imgloc_'+id);
                $("#avatar").html('<img style="width: 20%; margin-top:10px;" src="'+img+'" class="img-polaroid" id="avatar-photo" alt="">');
                $(".dlt-profile-check").hide();
            }
        });
    }
});

