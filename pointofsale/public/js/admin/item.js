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
                    window.location.href = BASE_URL+'admin/new-item/redirect?type=variation&id='+res;
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