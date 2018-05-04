var News = function() {

    var handleNews = function() {

        var finder_config = {
            baseFloatZIndex:30000,
            filebrowserBrowseUrl : '/public/js/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/public/js/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '/public/js/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        };

        var body = CKEDITOR.replace('n_content', finder_config);

        $('#data-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                
            },

            messages: {
                
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
                var url = '/admin/news/';
                if (parseInt($('[name=n_id]').val()) > 0){
                    url += 'update_news';
                }else {
                    url += 'add_news'
                }
               $('[name=n_content]').val(body.getData());

                var formData = new FormData($('form')[0]);
                Common.ajaxTask("post", true, false, url, formData, formCallback, null, false);
               
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

       $(".date-picker").datepicker({
            format : "yyyy-mm-dd",
           rtl : App.isRTL(),
           orientation : "left",
           autoclose : !0
       });

    }

    return {
        //main function to initiate the module
        init: function() {
            handleNews();
        }
    };
}();

var formCallback = function(response) {
    console.log(response);
    if (response.Status) {
        url = '/admin/news';
        if (typeof(response.Url) != 'undefined' && response.Url) {
            url = response.Url;
        }
        Common.showAlert(true, 'success', '成功', response.Message, 'success', url);
    } else {
        $('#data-form-btn').removeAttr('disabled');
        Common.showAlert(true, 'error', '失敗', response.Message);
    }
};

jQuery(document).ready(function() {
    News.init();        
});