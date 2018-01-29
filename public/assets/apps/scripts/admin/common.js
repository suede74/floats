// 整個網站通用物件
var Common = {
    timerID : 0,
    setting : {},

    /**
     *  取得設定檔
     *
     *  @param {string} settingUrl 設定檔網址
     */
    getConfig : function(settingUrl) {
        // setting 網址
        this.ajaxTask("GET", false, false, settingUrl, "", this.getConfigCallback, "");
    },

    getConfigCallback : function(response)
    {
        // get config
    	/*
        $.each(response, function(key, value) {
            if (key === "js") {
                $.each(value, function(text, msg) {
                    lang[text] = msg;
                });
            } else {
                Common.setting[key] = value;
            }
        });
        */
    },

    /**
     *  取得設定檔資料
     *
     *  @param {string} name 設定參數名稱
     */
    getSetting : function(name) {
        if (typeof this.setting[name] !== "undefined") {
            return this.setting[name];
        } else {
            return null;
        }
    },

    /**
     *  透過 ajax 拿資料做處理
     *
     *  @param {string} type POST or GET
     *  @param {Boolean} loading 是否需要 loading
     *  @param {Boolean} async 是否需要 async
     *  @param {string} url 網址
     *  @param {string} data 送出資料
     *  @param {string} callback 資料取得執行
     *  @param {string} parameter 執行所需參數
     */
    ajaxTask : function(type, loading, async, url, data, callback, parameter, process) {
        if (loading == 'undefined') {
            loading = false;
        }
        if (async == 'undefined') {
            async = true;
        }
        if (process == false) {
        	process = false;
        	content_type = false;
        }else {
        	content_type = 'application/x-www-form-urlencoded';
        }
        
        $.ajax({
            url : url,
            data : data,
            type : type,
            dataType : 'json',
            cache : false,
            global : true,
            async : async,
            contentType: content_type,
            processData: process,
            beforeSend : function() {
                if (loading == true) {
                    $.fancybox.showLoading();
                }
            },
            complete : function() {
                if (loading == true) {
                    $.fancybox.hideLoading();
                }
            },
            success : function(response) {            	
                if (loading == true) {
                    $.fancybox.hideLoading();
                }

                if (response.ToLogin === undefined) {
                    if (typeof (callback) === 'function') {
                        callback(response, parameter);
                    } else {
                        Common.showAlert(true, "error", '錯誤', '所指定的function無法正常運作。');
                    }
                } else if (response.ToLogin === true) {
                    location.href = "/";
                }
            },
            error : function(xhr, ajaxOptions, thrownError) {
                $("#data-form-btn").removeAttr("disabled");
                Common.showAlert(true, "error", '錯誤', '網路可能不夠順暢，請稍後在嘗試。');
            }
        });
    },

    fromSubmit : function (type, url, form, callback, parameter) {
        var options = { 
            // target:        '#output2',   // target element(s) to be updated with server response 
            beforeSubmit:  function(){
                $.fancybox.showLoading();
            },  // pre-submit callback 
            complete : function() {
                $.fancybox.hideLoading();
            },
            success: function(response){
                $.fancybox.hideLoading();
                if (response.ToLogin === undefined) {
                    if (typeof (callback) === 'function') {
                        callback(response, parameter);
                    } else {
                        Common.showAlert(true, "error", '錯誤', '所指定的function無法正常運作。');
                    }
                } else if (response.ToLogin === true) {
                    location.href = "/";
                }
            },  // post-submit callback 
            error: function(xhr, ajaxOptions, thrownError){
                $("#data-form-btn").removeAttr("disabled");
                Common.showAlert(true, "error", '錯誤', '網路可能不夠順暢，請稍後在嘗試。');
            },
            // other available options: 
            url:       url,         // override for form's 'action' attribute 
            type:      type,        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            //clearForm: true        // clear all form fields after successful submit 
            //resetForm: true        // reset the form after successful submit 
     
            // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 

        form.ajaxSubmit(options); 
    },

    /**
     *  取得丟近來參數的格式
     *
     *  @param {any} obj
     *  @returns {string}
     */
    getType : function(obj) {
        return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
    },

    /**
     *  錯誤顯示 fancybox
     *
     *  @param {Boolean} block true：點擊框外可以關閉，false：lock
     *  @param {string} type (success | info | warning | error)
     *  @param {string} title 錯誤標題
     *  @param {string} str 錯誤訊息
     *  @param {obj || string} obj 如果是物件，close 之後 focus，如果是 string，則處理相對應事情
     *  @param {string} url
     */
    showAlert : function(block, type, title, str, obj, url) {

        // console.log("Common : showAlert", arguments);

        // ele = str.split("<br>");
        // maxLength = Math.max.apply(Math, $.map(ele, function(el) {return el.length}));
        // width = maxLength * 14;
        if (type === "warning") {
            color = "#c29d0b";
        } else if (type === "success") {
            color = "#27A4AC";
        } else if (type === "info") {
            color = "#327ad5";
        } else if (type === "error") {
            color = "#e73d4a";
        }

        box = '<div class="modal-dialog" style="margin:0px auto;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" onclick="$.fancybox.close(true);"></button><h4 class="modal-title">' + title + '</h4></div><div class="modal-body" style="color:' + color + ';">' + str + '</div><div class="modal-footer"><button type="button" class="btn dark btn-outline" onclick="$.fancybox.close(true);">關閉</button></div></div></div>';
        // box = '<div class="error_box" style="color:#ff0000;text-align:center;font-size:14px;font-family:微軟正黑體;margin:35px auto;width:' + width + 'px;">' + str + '</div>';
        $.fancybox(box, {
            closeBtn : false,
            beforeShow : function(){
                $(".fancybox-skin").css({
                    "backgroundColor" : "transparent",
                    "box-shadow" : "none"
                });
                $.fancybox.update();
            },
            helpers : {
                overlay : {closeClick : block}
            },
            afterClose : function(){
                // ToDo
                if(Common.getType(obj) === 'object'){
                    obj.focus();
                }else if(Common.getType(obj) === 'string'){
                    if(obj === 'success'){
                        top.location.href = url;
                    }else if(obj === 'reload'){
                        location.reload();
                    }
                }
            }
        });
    },
    init : function(settingUrl) {
//        this.getConfig(settingUrl);
    }
};