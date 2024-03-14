jQuery( 'form[name="mp-subscribe-form"]' ).on( 'submit', function() {
    var form_data = jQuery( this ).serializeArray();
    form_data.push( { "name" : "security", "value" : ajax_nonce } );
    jQuery.ajax({
        url: ajax_url,
        type: 'post',
        data: form_data,
        dataType: "json",
        beforeSend: function() {
            // jQuery('#submitbtn').attr("disabled", true);
            // jQuery('#submitbtn').css({"background-color": "grey"});
        },
        success: function( response ) {
            // response.result - стан ("success" або "error").
            // response.message - відповідь сторонього сервера (напри., "Subscriber with email m.petrov@lanet.ua already exists").
            if (response.result == 'success') {
                console.log('success');

                jQuery('form[name="mp-subscribe-form"]')[0].reset();
                
                let pageLang = document.documentElement.lang;
                if ( (pageLang === 'ru') || (pageLang === 'ru-RU') || (pageLang === 'ru_RU') ) {
                    jQuery('.mp-subscribe-form__errors').text('Email успешно отправлена').css({"font-size": "14px", "color": "#006400"});
                } else if ( (pageLang === 'en') || (pageLang === 'en-US') || (pageLang === 'en_US') ) {
                    jQuery('.mp-subscribe-form__errors').text('Email sent successfully').css({"font-size": "14px", "color": "#006400"});
                } else if ( (pageLang === 'uk') || (pageLang === 'uk-UA') || (pageLang === 'uk_UA') ) {
                    jQuery('.mp-subscribe-form__errors').text('Email успішно відправлена').css({"font-size": "14px", "color": "#006400"});
                }

                jQuery('.mp-subscribe-form__email').css({"border": "1px solid #ebebeb"});
            }

            if (response.result == 'error') {
                console.log('error');
                // console.log(response.text_error);
                
                jQuery('.mp-subscribe-form__email').val("");
                jQuery('.mp-subscribe-form__errors').empty();

                // response.text_error - масив із описом помилок.
                jQuery(response.text_error).each(function(index, value) {
                    jQuery('<p>' + value + '</p>').appendTo('.mp-subscribe-form__errors').css({"font-size": "14px", "color": "#ff0000"});
                });
                
                jQuery('.mp-subscribe-form__email').css({"border": "2px solid #ff6464"});
            }
        },
        complete: function() {
            jQuery('form[name="mp-subscribe-form"]')[0].reset();
        },
        error: function( response ) {
            console.log("error - " + response);
        },
        fail: function( err ) {
            console.log("fail - " + err);
        }
    });
     
    // This return prevents the submit event to refresh the page.
    return false;
});


