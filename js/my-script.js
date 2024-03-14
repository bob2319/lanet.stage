function getAllUrlParams() {
    var queryString = window.location.search.slice(1);
    var obj = {};
    // Проверяем, есть ли параметры в запросе
    if (queryString) {
        queryString = queryString.split('#')[0];
        var arr = queryString.split('&');
        for (var i = 0; i < arr.length; i++) {
            var a = arr[i].split('=');
            var paramName = a[0];
            var paramValue = typeof (a[1]) === 'undefined' ? true : decodeURIComponent(a[1]);
            obj[paramName] = paramValue;
        }

        // Список необходимых UTM-меток
        const utmParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];

        // Установка пустых значений для отсутствующих UTM-меток
        utmParams.forEach(param => {
            if (!obj[param]) {
                obj[param] = ''; // Добавляем метку с пустым значением, если она не найдена
            }
        });

        // Определение utm_source на основе специальных параметров, если utm_source не задан
        if (!obj['utm_source']) {
            // Добавление условий для Telegram и Email
            if (obj['tg_id']) {
                obj['utm_source'] = 'telegram';
            } else if (obj['email']) {
                obj['utm_source'] = 'email';
            } else if (obj['gclid'] || obj['gclsrc'] || obj['wbraid'] || obj['gbraid']) {
                obj['utm_source'] = 'Google Ads';
            } else if (obj['fbclid']) {
                obj['utm_source'] = 'Facebook';
            } else if (obj['dclid']) {
                obj['utm_source'] = 'google_doubleclick';
            } else if (obj['msclkid']) {
                obj['utm_source'] = 'microsoft';
            } else if (obj['twclid']) {
                obj['utm_source'] = 'twitter';
            } else if (obj['yclid']) {
                obj['utm_source'] = 'yahoo';
            }
            // Удаляем специфические параметры после использования
            ['gclid', 'gclsrc', 'wbraid', 'gbraid', 'fbclid', 'dclid', 'msclkid', 'twclid', 'yclid', 'gad_source', 'tg_id', 'email'].forEach(param => delete obj[param]);
        }
        return obj;
    } else {
        // Возвращаем пустой объект, если в URL нет параметров
        console.log('No GET parameters found in the URL.');
        return null;
    }
}


// Получение и обработка параметров URL
var currentUrlParams = getAllUrlParams();

// Проверка и отправка данных, если параметры присутствуют
if (currentUrlParams && Object.keys(currentUrlParams).length > 0) {
    var formData = new FormData();
    formData.append('action', 'handle_utm_ajax');
    formData.append('utm_data', JSON.stringify(currentUrlParams));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-admin/admin-ajax.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log('Server response:', response);
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    xhr.send(formData);
} else {
    console.log('Skipping data send due to no GET parameters.');
}


var swiper = new Swiper(".slaider-media", {
    slidesPerView: 3,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    // Responsive breakpoints
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
        },
        // when window width is >= 480px
        768: {
            slidesPerView: 2,
        },
        // when window width is >= 640px
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        }
    }
});



$('.close-btn').on('click', function () {
    $(this).closest('.popup').removeClass('show');
});

$('.form-btn').on('click', function (e) {
    e.preventDefault();
    var form = $(this).closest('form'); // Находим ближайшую форму к кнопке

    var need_tnx = $(this).closest('footer');

    var formID = form.data('form-id');
    var formName = form.data('form-name');
    var phoneValue = form.find('input[name=phone]');
    var emailValue = form.find('input[name=email]');
    var nameValue = form.find('input[name=your-name]'); // Для новой формы
    var commentsValue = form.find('textarea[name=comments]'); // Для новой формы
    var siteURL = form.find('input[name=url]'); // Для старой формы
    var title = $('body').find('h1').length !== 0 ? $('body').find('h1').text() : '';
    var helpers_form = $(form).data('form-helpers');

    if (nameValue.length) { // Проверяем, существует ли поле 'name'
        if (nameValue.val().trim() === '') {
            nameValue.parent().addClass('error');
            nameValue.siblings('.error-message').text('Это поле обязательно для заполнения');
            return;
        } else {
            nameValue.parent().removeClass('error');
        }
    }


    $(form).find('.error').removeClass('error');
    // Валидация телефона
    if (!isValidPhone(phoneValue.val())) {
        phoneValue.parent().addClass('error');
        return;
    }

    // Валидация электронной почты
    if (!isValidEmail(emailValue.val())) {
        emailValue.parent().addClass('error');
        return;
    }

    // Дополнительная валидация для новой формы
    if (nameValue.length && nameValue.val().length == 0) {
        nameValue.parent().addClass('error');
        return;
    }
    // Дополнительная валидация для старой формы
    if (form.closest('#popup-formm').length && siteURL.val().length == 0) {
        siteURL.parent().addClass('error');
        return;
    }

    $('.loading-indicatorb').addClass('show');
    var formData = {
        'phone': phoneValue.val(),
        'email': emailValue.val(),
        'your-name': nameValue.val(), // Для новой формы
        'comments': commentsValue.val(), // Для новой формы
        'url': siteURL.val(),
        'page_title': title,
        'source_id': formID,
        'helpers_form': helpers_form,
    };

    console.log(formData);
    // Для старой формы
    if (form.closest('#popup-formm').length) {
        formData.url = siteURL.val(); // Добавляем URL для старой формы
    }
    var startTime = new Date(); // Записываем время начала запроса
    var ajxUrl = form.attr('action');
    $.ajax({
        type: 'POST',
        url: ajxUrl,
        data: {
            action: 'submit_form_data_ajax_handler',
            form_data: formData
        },
        success: function (response) {
            var endTime = new Date(); // Записываем время завершения запроса
            var responseTime = endTime - startTime; // Вычисляем время ответа
            console.log("Время ответа: " + responseTime + " мс"); // Выв
            dataLayer.push({
                'event': 'form_submit',
                'form_id': formID,
                'form_name': formName,
                'phone': phoneValue.val(),
                'email': emailValue.val(),
                'name': nameValue.val(), // Для новой формы
                'comments': commentsValue.val(), // Для новой формы
            });

            $('.loading-indicatorb').removeClass('show');

            // Показываем сообщение об успехе
            if (form.closest('#popup-form').length) {
                $('.popup-content-tnx').show();
                // Скрываем основное содержимое формы
                form.closest('.popup-content').hide();
            }
            else if (form.closest('#popup-formm').length) {
                $('.popup-content-tnxm').show();
                // Скрываем основное содержимое формы
                form.closest('.popup-contentm').hide();
            }

            if($(need_tnx).length !== 0 ){
                $('#popup-formf').addClass('show-tnx');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error: " + textStatus, errorThrown);
        }
    });
});



$(document).ready(function () {
    $('.phone-input').inputmask('+380 (99) 999-99-99', { placeholder: '00000000' });
});

function isValidPhone(phone) {
    return /^[\d\s\-()+]+$/.test(phone);
}
// Функция для валидации электронной почты
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

let before_send = function (classNameString) {
    $(document).on('click', classNameString, function (event) {
        event.preventDefault(); // Prevent the default action of the event
        $form_event = $(this).hasClass('cta-b') ? true : false;
        
        var selectedOptions = [];
        if( $('.select-list').length !== 0 ){

            $(".dynamic-select option:selected").each(function() {
                selectedOptions.push($(this).val());
            });
    

        }


        let ID = $(this).attr('data-form-id');
        let form_name = $(this).attr('data-form-name');

        if( ID == undefined && $form_event){
            let lang = $('body').data('lang');
            ID = 10;
            if('en' == lang){
                ID = 11;
            }
            else if('ru' == lang){
                ID = 12;
            }


        }

        dataLayer.push({
            'event': 'form_start',
            'form_id': ID,
            'form_name': form_name,
        });

        if ($form_event) {
            $('.formpp form').attr('data-form-id', ID);
            $('.formpp form').attr('data-form-name', form_name);
            $('.formpp form').attr('data-form-helpers', selectedOptions);
        }
        else {
            $('.formppm form').attr('data-form-id', ID);
            $('.formppm form').attr('data-form-name', form_name);
            $('.formpp form').attr('data-form-helpers', selectedOptions);
        }

        $form_event ? $('#popup-form').addClass('show') : $('#popup-formm').addClass('show');

        // Проверка ширины окна только для первого вызова обработчика
        if (window.innerWidth <= 768 && !$(this).data('mobile-focus-set')) {
            $(this).data('mobile-focus-set', true); // Устанавливаем флаг, чтобы не повторять
            $('#popup-formm input[name=phone]').focus(); // Здесь устанавливайте фокус на нужное поле
        }
    });
}

// Apply the event handler to multiple classes
before_send('.header-btn, .btn-mfirst, .cta-b');

$('.close-btn').on('click', function(){
    $(this).closest('#popup-formf').removeClass('show-tnx');
});
