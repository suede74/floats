var Collection = function() {

    var handleCollection = function() {
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
            	var url = '/admin/collection/';
                if (parseInt($('[name=c_id]').val()) > 0){
                    url += 'update_collection';
                }else {
                    url += 'add_collection'
                }
                // $('[name=n_body]').val(body.getData());

                // var formData = new FormData($('form')[0]);
                Common.fromSubmit('post', url, $('#data-form'), formCallback, null);
               
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

        var elt = $('#pm_ids');
        
        elt.tagsinput({
            itemValue: 'value',
            itemText: 'text',
        });

        $('[name=pm]').select2({
            width: "off",
            ajax: {
                url: "/admin/product/ajax_search",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, page) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: (item.pm_name_tw + ' - ' + item.pm_model_no),
                                id: item.pm_id,
                            }
                        })
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            // templateResult: formatState,
        }).on('select2:select', function (e) {
            var data = e.params.data;
            elt.tagsinput('add', { 
                "value": data.id, 
                "text": data.text, 
                // "continent": $('#object_tagsinput_continent').val()    
            });
        });

        if ($('#select_pm').text()) {
            var pm_datas = JSON.parse($('#select_pm').text());
            for (i = 0; i < pm_datas.length; i++) {
                elt.tagsinput('add', { 
                    "value": pm_datas[i].id, 
                    "text": pm_datas[i].text, 
                });
            }
        }
    }
    
    return {
        //main function to initiate the module
        init: function() {
            handleCollection();
        }

    };

}();

var formCallback = function(response) {
        // console.log(response);
        url = '/admin/collection';
        if (typeof(response.Url) != 'undefined' && response.Url) {
            url = response.Url;
        }
        if (response.Status) {
            Common.showAlert(true, 'success', '成功', response.Message, 'success', url);
        } else {
            $("#data-form-btn").removeAttr("disabled");
            Common.showAlert(true, 'error', '失敗', response.Message);
        }
    };

jQuery(document).ready(function() {
    Collection.init();     
});