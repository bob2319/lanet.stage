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
