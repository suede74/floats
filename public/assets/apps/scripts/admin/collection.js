var Collection = function() {

    var handleCollection = function() {
//    	baseHref = '';
//        var body = CKEDITOR.replace('n_body',
//        {
//            baseFloatZIndex:30000,
//            filebrowserBrowseUrl : baseHref+'ckfinder/ckfinder.html',
//            filebrowserImageBrowseUrl: baseHref+'ckfinder/ckfinder.html?type=Images',
//            filebrowserFlashBrowseUrl : baseHref+'ckfinder/ckfinder.html?type=Flash',
//            filebrowserUploadUrl : baseHref+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
//            filebrowserImageUploadUrl : baseHref+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
//            filebrowserFlashUploadUrl : baseHref+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
//        });
    	
        $('#data-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {            	
                c_title: {
                    required: true
                },               
                // c_image: {
                //     required: true
                // },
                c_status: {
                	required: true,
                	number: true
                }
            },

            messages: {
                c_title: {
                    required: '請輸入集合名稱'
                },                
                // c_image: {
                //     required: '請選擇集合圖片'
                // },                
                c_status: {
                	required: '請選擇狀態'             
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                // if (validator.errorList.length > 0){
                //     var error_msg = '';
                //     $.each(validator.errorList, function(index, data){
                //         error_msg += data.message+"<br>";
                //     });
                //     $('#personal_login_form .alert-danger span').html(error_msg);
                // }
                // $('.alert-danger', $('#login_form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                // error.insertAfter(element.closest('.input-icon'));
                error.insertAfter(element);
            },

            submitHandler: function(form) {
                // form.submit(); // form validation success, call ajax form submit
            	var url = '/admin/collection/';
                if (parseInt($('[name=c_id]').val()) > 0){
                    url += 'update_collection';
                }else {
                    url += 'add_collection'
                }
                // $('[name=n_body]').val(body.getData());

                // var formData = new FormData($('form')[0]);
                Common.fromSubmit("post", url, $('#data-form'), formCallback, null);
               
                return false;
            }
        });

        $('#data-form input').keypress(function(e) {
            if (e.which == 13 && $('#data-form #peronsal_login').attr('disabled') !== 'disabled') {
                if ($('#data-form').validate().form()) {
                    $('#data-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });      
    }
    
    return {
        //main function to initiate the module
        init: function() {
            handleCollection();
        }

    };

}();

var formCallback = function(response) {
        console.log(response);
        if (response.Status) {
            Common.showAlert(true, 'success', '成功', response.Message, "success", "/admin/collection");
        } else {
            $("#data-form-btn").removeAttr("disabled");
            Common.showAlert(true, 'error', '失敗', response.Message);
        }
    };

jQuery(document).ready(function() {
    Collection.init();     
});