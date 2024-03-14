jQuery(document).ready(function($) {
    // Найти все элементы .menu-item-has-children и добавить класс has-dropdown
    $('.menu-item-has-children').addClass('has-dropdown');
    
    // Создать кнопку меню и добавить ее к .menu-toggle
    $('<button class="menu-toggle"><span class="screen-reader-text">Открыть меню</span></button>').appendTo('.site-header .menu-toggle');
    
    // При нажатии на кнопку меню открыть/закрыть выпадающее меню
    $('.menu-toggle').on('click', function() {
        $('body').toggleClass('menu-open');
    });
    
    // При нажатии на кнопку назад закрыть выпадающее меню
    $('.menu-close').on('click', function() {
        $('body').removeClass('menu-open');
    });
});


// Получение данных из локального хранилища
var utmData = localStorage.getItem('b24_crm_guest_utm');
// Проверка наличия данных
if (utmData) {
    // Парсинг данных из формата JSON
    utmData = JSON.parse(utmData);
    
    console.log(utmData);
    // Создание объекта FormData
    var formData = new FormData();
    formData.append('action', 'handle_utm_ajax');
    formData.append('utm_data', JSON.stringify(utmData));

    // Создание объекта XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // Настройка запроса
    xhr.open('POST', '/wp-admin/admin-ajax.php', true);

    // Определение функции обратного вызова для обработки ответа сервера
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Обработка успешного ответа сервера
                var response = JSON.parse(xhr.responseText);
                console.log(response);
            } else {
                console.error('Request failed');
            }
        }
    };

    // Отправка запроса
    xhr.send(formData);
} else {
    console.error('No UTM data found in local storage');
}