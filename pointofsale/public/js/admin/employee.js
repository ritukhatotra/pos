var BASE_URL = "http://localhost/ritu/pointofsale/";
/* datepicker */
$(document).on('ready', function (){
    $('#hire_date').datepicker();
    $('#birthday').datepicker();
    $('#termination_date').datepicker();
});

/* inactive box */
/* show override input*/
jQuery("#inactive").on('change', function() {
    if($(this).prop("checked") == true){
        $("#inactive_info").removeClass('hidden');
    }else if($(this).prop("checked") == false){
        $("#inactive_info").addClass('hidden');
    }
});

/* ------ permissions ---------- */
/* customer */
jQuery("#permissionscustomers").on('change', function() {
    if($(this).prop("checked") == true){
        $(".customer_checkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".customer_checkbox").each(function() {
            this.checked=false;
        });
    }
});
/* item */
jQuery("#item_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".item_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".item_chkbox").each(function() {
            this.checked=false;
        });
    }
});
/* item kit */
jQuery("#item_kit_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".item_kit_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".item_kit_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* price rules */
jQuery("#price_rule_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".price_rule_checkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".price_rule_checkbox").each(function() {
            this.checked=false;
        });
    }
});

/* supplier */
jQuery("#supplier_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".supplier_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".supplier_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* report */
jQuery("#report_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".report_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".report_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* recieving */
jQuery("#recieve_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".receive_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".receive_chkbox").each(function() {
            this.checked=false;
        });
    }
});
/* recieving */
jQuery("#sale_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".sale_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".sale_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* delivery */
jQuery("#delivery_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".delivery_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".delivery_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* expense */
jQuery("#expense_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".expense_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".expense_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* employee */
jQuery("#emp_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".emp_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".emp_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* gift card */
jQuery("#gift_card_permisson").on('change', function() {
    if($(this).prop("checked") == true){
        $(".gift_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".gift_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* location */
jQuery("#loc_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".loc_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".loc_chkbox").each(function() {
            this.checked=false;
        });
    }
});

/* message */
jQuery("#msg_permission").on('change', function() {
    if($(this).prop("checked") == true){
        $(".msg_chkbox").each(function() {
            this.checked=true;
        });
    }else if($(this).prop("checked") == false){
        $(".msg_chkbox").each(function() {
            this.checked=false;
        });
    }
});
/* ------ end permissions ---------- */

/* employe validation */
jQuery(function() {
    jQuery("#employee_form").validate({
        rules: {
            first_name: {
                required: true
            },
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                number: true
            },
            zip: {
                number: true
            },
            password: {
                required: true
            },
            repeat_password: {
                required: true,
                equalTo: "#password"
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
        url  : BASE_URL+'ajax/checkEmployeeEmail',
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
        url  : BASE_URL+'ajax/checkEmployeePhone',
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
$("#username").blur(function(){
    let acc = $(this).val();
    $.ajax({
        type : 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url  : BASE_URL+'ajax/checkUsername',
        data : {acc : acc},
        success: function(res) {
            if(res === 'exist') {
                $('#uname').html('Username number already exist.');
            } else {
                $('#uname').html('');
            }
        }
    });
});






