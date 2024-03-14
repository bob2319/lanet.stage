<?php
// Прибирання подвійного слешування 
add_action('init', 'redirect_double_slash_to_single');

function redirect_double_slash_to_single()
{
    $request_uri = $_SERVER['REQUEST_URI'];
    $new_uri = preg_replace('#(?<!:)//+#', '/', $request_uri);

    if ($new_uri !== $request_uri) {
        $new_url = 'https://' . $_SERVER['HTTP_HOST'] . $new_uri;
        wp_redirect($new_url, 301);
        exit;
    }
}
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

// виключення з кешу для форм
add_filter('redis_cache_bypass', function ($bypass) {
    if (isset($_POST['_wpnonce'])) {
        return true; // Пропустить кеширование
    }
    return $bypass;
});

//показ адмін панелі для адмінів
add_action('after_setup_theme', 'show_admin_bar_for_admins');

function show_admin_bar_for_admins()
{
    if (current_user_can('administrator')) {
        show_admin_bar(true);
    } else {
        show_admin_bar(false);
    }
}


// 404 редирект на рівень вище
function redirect_to_parent_on_404()
{
    if (is_404()) {
        $current_url = $_SERVER['REQUEST_URI'];
        $url_parts = explode('/', rtrim($current_url, '/'));
        array_pop($url_parts);
        $parent_url = implode('/', $url_parts);
        if (!empty($parent_url)) {
            $redirect_url = home_url($parent_url);
            wp_redirect($redirect_url, 301);
            exit();
        } else {
            // Если достигли корня сайта, перенаправляем на главную страницу
            wp_redirect(home_url(), 301);
            exit();
        }
    }
}
add_action('template_redirect', 'redirect_to_parent_on_404');

add_action('after_setup_theme', 'lanetclick');
function lanetclick()
{
    // Поддержка миниатюр
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
}
function register_mobile_menu()
{
    register_nav_menus(
        array(
            'mobile-menu' => __('Меню мобільне'),
        )
    );
}
add_action('init', 'register_mobile_menu');
//прибирання авто br у  CF7
add_filter('wpcf7_autop_or_not', '__return_false');


// include custom jQuery
function shapeSpace_include_custom_jquery()
{
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

//Вимикаємо Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);
function remove_core_updates()
{
    global $wp_version;
    return (object) array('last_checked' => time(), 'version_checked' => $wp_version,);
}
add_filter('pre_site_transient_update_themes', 'remove_core_updates');
//Дозвіл на Webp
function webp_upload_mimes($existing_mimes)
{
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
//Дозвіл на SVG
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
//Нове меню
add_action('after_setup_theme', function () {
    register_nav_menus([
        'main-menu' => 'Головне меню',
        'footer-menu' => 'Футер меню',


    ]);
});


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Мої налаштування',
        'menu_title'    => 'Мої налаштування',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}

add_action('admin_init', 'admin_area_ID');
function admin_area_ID()
{
    // для таксономий (рубрик, меток и т.д.)
    foreach (get_taxonomies() as $taxonomy) {
        add_action("manage_edit-${taxonomy}_columns",          'tax_add_col');
        add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
        add_filter("manage_${taxonomy}_custom_column",         'tax_show_id', 10, 3);
    }
    add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
    function tax_add_col($columns)
    {
        return $columns + array('tax_id' => 'ID');
    }
    function tax_show_id($v, $name, $id)
    {
        return 'tax_id' === $name ? $id : $v;
    }
    function tax_id_style()
    {
        print '<style>#tax_id{width:4em}</style>';
    }
    // для постов и страниц
    add_filter('manage_posts_columns', 'posts_add_col', 5);
    add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
    add_filter('manage_pages_columns', 'posts_add_col', 5);
    add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
    add_action('admin_print_styles-edit.php', 'posts_id_style');
    function posts_add_col($defaults)
    {
        $defaults['wps_post_id'] = __('ID');
        return $defaults;
    }
    function posts_show_id($column_name, $id)
    {
        if ($column_name === 'wps_post_id') echo $id;
    }
    function posts_id_style()
    {
        print '<style>#wps_post_id{width:4em}</style>';
    }
}

function load_posts_by_ajax()
{
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $cat_id = $_POST['category_id'] == 'all' ? '' : $_POST['category_id'];
    $lang = isset($_POST['lang']) ? sanitize_text_field($_POST['lang']) : 'default';
    do_action('wpml_switch_language', $lang);
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => $cat_id,
        'posts_per_page' => '6',
        'paged' => $paged,
        //'lang' => $lang,
    );
    $my_posts = new WP_Query($args);
    if ($my_posts->have_posts()) :
        while ($my_posts->have_posts()) : $my_posts->the_post();
?>
            <div class="col-md-4 post-item">
                <div class="post" onclick="window.location.href='<?php the_permalink(); ?>';">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>

                    <div class="post-meta">
                        <span class="post-author">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php
                                $user_id = get_the_author_meta('ID');
                                $first_name_key = 'first_name_' . $user_id;
                                $last_name_key = 'last_name_' . $user_id;

                                $first_name = get_the_author_meta('first_name');
                                $last_name = get_the_author_meta('last_name');

                                $first_name_translated = apply_filters('wpml_translate_single_string', $first_name, 'authors', $first_name_key);
                                $last_name_translated = apply_filters('wpml_translate_single_string', $last_name, 'authors', $last_name_key);

                                echo $first_name_translated . ' ' . $last_name_translated;
                                ?>
                            </a>
                        </span>
                        <span class="post-date"><?php the_date(); ?></span>
                    </div>

                    <h2><a href="<?php the_permalink(); ?>"><?php echo highlight_search_term(get_the_title()); ?></a></h2>
                    <div class="p-excerpt"><?php echo highlight_search_term(wp_trim_words(get_the_content(), 55)); ?></div>
                </div>
            </div>
        <?php
        endwhile;
    endif;

    // Добавьте разделитель и пагинацию
    echo '<!-- pagination divide -->';
    echo paginate_links(array(
        'total' => $my_posts->max_num_pages,
        'current' => $paged,
        'prev_text' => __('Prevous', 'lanetclick'),
        'next_text' => __('Next', 'lanetclick'),
    ));

    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax');

function custom_excerpt_length($length)
{
    return 20; // Измените это число на количество символов, которые вы хотите выводить
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function add_ids_to_header_tags($content)
{
    $pattern = '/(<h([23])>)(.*?)(<\/h[23]>)/i';
    $replacement = '$1<span id="toc-$2-$3">$3</span>$4';

    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

add_filter('the_content', 'add_ids_to_header_tags');
function highlight_search_term($text)
{
    // получение термина поиска из запроса
    $term = get_search_query();
    // замена термина поиска в тексте на выделенный терм
    $highlighted = '<span class="highlight-search">' . $term . '</span>';
    $text = str_replace($term, $highlighted, $text);
    return $text;
}
function tags_support_all()
{
    register_taxonomy_for_object_type('post_tag', 'page');
}

// гарантирует, что теги поддерживаются при инициализации
function tags_compatibility_fix()
{
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' && isset($_REQUEST['post'])) {
        $post = get_post($_REQUEST['post']);
        if ($post) {
            $post_type = $post->post_type;
        }
    }
}

add_action('init', 'tags_support_all');
add_action('admin_init', 'tags_compatibility_fix');

function load_pages_by_ajax()
{
    check_ajax_referer('load_more_pages', 'security');
    $paged = $_POST['page'];
    $totalItems = isset($_POST['totalItems']) ? intval($_POST['totalItems']) : 0; // Получите общее количество элементов
    $tag_slug = $_POST['tag'] == 'all' ? '' : $_POST['tag'];
    $default_page_id = 32588;
    $current_page_id = icl_object_id($default_page_id, 'page', true);

    $args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_parent' => $current_page_id, // получаем только страницы верхнего уровня
        'posts_per_page' => '3',
        'paged' => $paged,
    );

    // Добавьте запрос налогов только если $tag_slug не пуст
    if (!empty($tag_slug)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $tag_slug,
            ),
        );
    }

    $my_pages = new WP_Query($args);
    $counter = $totalItems + 1; // Установите начальное значение счетчика, учитывая уже загруженные элементы

    if ($my_pages->have_posts()) :
        while ($my_pages->have_posts()) : $my_pages->the_post();
            $client = get_field('zymovnyk_kejsu'); // Получаем поле клиента
            $zagolovok = get_field('zag_case'); // Получаем поле клиента
            $tags = get_the_tags(); // Получаем теги для страницы
        ?>
            <div class="col-ca-4 <?php echo ($counter % 2 == 0) ? 'reverse-order' : ''; ?>"> <!-- Добавляем класс каждому второму div -->
                <div class="cases-l">
                    <div class="col-ca-1">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>"><img class="case-img" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-ca-2">
                        <?php if ($tags) : ?>
                            <p><a href="#" class="case-cat" data-tag="<?php echo $tags[0]->slug; ?>">#<?php echo $tags[0]->name; ?></a></p>
                        <?php endif; ?>
                        <h3><a class="case-h3" href="<?php the_permalink(); ?>"><?php the_field('zag_case'); ?></a></h3>
                        <?php if ($client) : ?>
                            <p class="klient"><?php _e('Сlient: ', 'lanetclick'); ?> «<?php echo esc_html($client); ?>»</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
            $counter++; // Увеличиваем счетчик
        endwhile;
    else :
        echo '';
    endif;

    wp_die();
}

add_action('wp_ajax_load_pages_by_ajax', 'load_pages_by_ajax');
add_action('wp_ajax_nopriv_load_pages_by_ajax', 'load_pages_by_ajax');




function custom_breadcrumbs()
{
    global $post;

    // Вместо 'blog-page-id' укажите ID страницы блога
    $blog_page_id = apply_filters('wpml_object_id', '1746', 'page', TRUE);
    $blog_page_url = get_permalink($blog_page_id);

    echo '<div class="aioseo-breadcrumbs">';
    if (!is_home()) {
        echo '<span class="aioseo-breadcrumb"><a href="';
        echo get_option('home');
        echo '" title="' . __('Home', 'lanetclick') . '">' . __('Home', 'lanetclick') . '</a></span><span class="aioseo-breadcrumb-separator">/</span>';
        if (is_single()) { // записи
            echo '<span class="aioseo-breadcrumb"><a href="';
            echo $blog_page_url;
            echo '" title="' . __('Blog', 'lanetclick') . '">' . __('Blog', 'lanetclick') . '</a></span><span class="aioseo-breadcrumb-separator">/</span>';
            $category = get_the_category();
            echo '<span class="aioseo-breadcrumb"><a href="' . get_category_link($category[0]->term_id) . '" title="' . $category[0]->cat_name . '">' . $category[0]->cat_name . '</a></span><span class="aioseo-breadcrumb-separator">/</span>';
            echo '<span class="aioseo-breadcrumb">' . get_the_title() . '</span>';
        }
    }
    echo '</div>';
}


function custom_author_rewrite_rule()
{
    global $wp_rewrite;  // Добавьте эту строку
    add_rewrite_rule(
        'author/([^/]+)/page/?([0-9]{1,})/?$',
        'index.php?author_name=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2),
        'top'
    );
}
add_action('init', 'custom_author_rewrite_rule', 10, 0);
add_action('wp_ajax_get_category_name', 'get_category_name');
add_action('wp_ajax_nopriv_get_category_name', 'get_category_name');

function get_category_name()
{
    if (isset($_POST['slug'])) {
        $slug = sanitize_text_field($_POST['slug']);
        $term = get_term_by('slug', $slug, 'category');

        if ($term) {
            echo $term->name;
        } else {
            echo $slug; // Fallback to slug if category name not found
        }
    }

    wp_die();
}

if (!function_exists('mp_subscribe_form_javascript_variables')) {
    function mp_subscribe_form_javascript_variables()
    { ?>
        <script type="text/javascript">
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var ajax_nonce = '<?php echo wp_create_nonce("secure_nonce_name"); ?>';
        </script><?php
                }
            }
            add_action('wp_head', 'mp_subscribe_form_javascript_variables');

            if (!function_exists('mp_check_rus_domain_validation')) {
                function mp_check_rus_domain_validation($emailAddress)
                {
                    $emailAddress = trim($emailAddress);
                    $ruDomains = array(
                        '.ru',
                        '.ru.com',
                        '.ru.net',
                        '.su',
                        '.рус',
                        '.xn--p1acf',
                        '.ру',
                        '.xn--p1ag',
                        '.рф',
                        '.xn--p1ai',
                        '.сайт',
                        '.xn--80aswg',
                        '.москва',
                        '.xn--80adxhks',
                        '.онлайн',
                        '.xn--80asehdb',
                        '.орг',
                        '.xn--c1avg',
                        '.дети',
                        '.xn--d1acj3b'
                    );

                    $isRuDomain = false;
                    foreach ($ruDomains as $ruDomain) {
                        // Якщо рашистський домен знайдено
                        if (stripos($emailAddress, $ruDomain) !== false) {
                            $isRuDomain = true;
                        }
                    }

                    return $isRuDomain;
                }
            }

            if (!function_exists('mp_email_adress_validation')) {
                function mp_email_adress_validation($emailAddress)
                {
                    $emailAddress = trim($emailAddress);
                    if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            /**
             * Чи має адреса кириличні символи
             * 
             * Конвертор - https://2ip.io/ua/punycode/
             * 
             */
            if (!function_exists('mp_is_email_adress_have_cyr')) {
                function mp_is_email_adress_have_cyr($emailAddress)
                {
                    // $cyrLetters = array(
                    // 	"Є", "є", "І", "і", "Ї", "ї", "А", "Б", "В", "Г", "Д",
                    // 	"Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О",
                    // 	"П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ",
                    // 	"Ъ", "Ы", "Ь", "Э", "Ю", "Я", "а", "б", "в", "г", "д",
                    // 	"е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о",
                    // 	"п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ",
                    // 	"ъ", "ы", "ь", "э", "ю", "я"
                    // );

                    // $isCyrLetter = false;   
                    // foreach( $cyrLetters as $cyrLetter ) {
                    // 	if ( stripos( $emailAddress, $cyrLetter ) !== false ) {
                    // 		$isCyrLetter = true; 
                    // 	}
                    // }

                    // if ( $isCyrLetter == false ) {
                    // 	return false; // Не має
                    // } else {
                    // 	return true; // Має
                    // }


                    if (
                        preg_match("/\p{Cyrillic}/ui", $emailAddress)
                        || (preg_match("/[а-яё]/ui", $emailAddress))
                        || (preg_match("/[А-Яа-яЁё]/u", $emailAddress))
                        // || ( strripos( $emailAddress, '.xn--80a3d' ) !== false ) // .юа
                        // || ( ( strripos( $emailAddress, '.юа' ) !== false ) ) // .юа
                        // || ( ( strripos( $emailAddress, '.укр' ) !== false ) ) // .укр
                        // || ( ( strripos( $emailAddress, '.xn--j1amh' ) !== false ) ) // .укр
                        // || ( ( strripos( $emailAddress, '.рус' ) !== false ) ) // .рус
                        // || ( ( strripos( $emailAddress, '.xn--p1acf' ) !== false ) ) // .рус
                        // || ( ( strripos( $emailAddress, '.ру' ) !== false ) ) // .ру
                        // || ( ( strripos( $emailAddress, '.xn--p1ag' ) !== false ) ) // .ру
                        // || ( ( strripos( $emailAddress, '.рф' ) !== false ) ) // .рф
                        // || ( ( strripos( $emailAddress, '.xn--p1ai' ) !== false ) ) // .рф
                        // || ( ( strripos( $emailAddress, '.сайт' ) !== false ) ) // .сайт
                        // || ( ( strripos( $emailAddress, '.xn--80aswg' ) !== false ) ) // .сайт
                        // || ( ( strripos( $emailAddress, '.москва' ) !== false ) ) // .москва
                        // || ( ( strripos( $emailAddress, '.xn--80adxhks' ) !== false ) ) // .москва
                        // || ( ( strripos( $emailAddress, '.онлайн' ) !== false ) ) // .онлайн
                        // || ( ( strripos( $emailAddress, '.xn--80asehdb' ) !== false ) ) // .онлайн
                        // || ( ( strripos( $emailAddress, '.орг' ) !== false ) ) // .орг
                        // || ( ( strripos( $emailAddress, '.xn--c1avg' ) !== false ) ) // .орг
                        // || ( ( strripos( $emailAddress, '.дети' ) !== false ) ) // .дети
                        // || ( ( strripos( $emailAddress, '.xn--d1acj3b' ) !== false ) ) // .дети
                        // || ( ( strripos( $emailAddress, '.орг' ) !== false ) ) // .орг
                        // || ( ( strripos( $emailAddress, '.xn--c1avg' ) !== false ) ) // .орг
                    ) {
                        return true; // Має
                    } else {
                        return false; // Не має
                    }
                }
            }

            // var_dump(mp_is_email_adress_have_cyr( 'm.petrov@lanet.рус' ));
            // var_dump(mp_is_email_adress_have_cyr( 'm.petrov@lanet.ua' ));

            /**
             * true  - Email валідна
             * false - Email не валідна 
             * 
             * mp_email_adress_validation('m.petrov@lanet.рф') - false
             * mp_email_adress_validation('m.petrov@lanet.ру') - false
             * mp_email_adress_validation('m.petrov@lanet.ру.com') - false
             * mp_email_adress_validation(' m.petrov@lanet.ua ') - true
             *  
             */
            if (!function_exists('mp_is_email_adress_valid')) {
                function mp_is_email_adress_valid($email)
                {
                    if (
                        mp_email_adress_validation($email)
                        && !mp_check_rus_domain_validation($email)
                        && !mp_is_email_adress_have_cyr($email)
                    ) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }



            if (!function_exists('mp_subscribe_form_send_form')) {
                function mp_subscribe_form_send_form()
                {
                    check_ajax_referer('secure_nonce_name', 'security');
                    var_dump('mp_subscribe_form_send_form');
                    $url   = 'https://api.lanet.click/click_api/subscribe';
                    $email = strip_tags($_POST["email"]);
                    $name  = strip_tags('');
                    $pageLocale = strip_tags($_POST["lang"]);

                    $errorContainer = array();

                    if (!empty($email) && !mp_email_adress_validation($email)) {
                        if (($pageLocale === 'ru') || ($pageLocale === 'ru-RU') || ($pageLocale === 'ru_RU')) {
                            $errorContainer[] = 'Введите корректный Email';
                        } elseif (($pageLocale === 'en') || ($pageLocale === 'en-US') || ($pageLocale === 'en_US')) {
                            $errorContainer[] = 'Email is incorrect';
                        } elseif (($pageLocale === 'uk') || ($pageLocale === 'uk-UA') || ($pageLocale === 'uk_UA')) {
                            $errorContainer[] = 'Введіть коректний Email';
                        }
                    }

                    if (empty($email)) {
                        // Тут функція esc_html__() не працює. Переклад не підтягується. Ще раз перевірити назви po-, mo-файлів  
                        // $errorContainer[] = esc_html__( 'Email is empty', 'mp-subscribe-form' );
                        if (($pageLocale === 'ru') || ($pageLocale === 'ru-RU') || ($pageLocale === 'ru_RU')) {
                            $errorContainer[] = 'Email пустой';
                        } elseif (($pageLocale === 'en') || ($pageLocale === 'en-US') || ($pageLocale === 'en_US')) {
                            $errorContainer[] = 'Email is empty';
                        } elseif (($pageLocale === 'uk') || ($pageLocale === 'uk-UA') || ($pageLocale === 'uk_UA')) {
                            $errorContainer[] = 'Email порожній';
                        }
                    }

                    if (mp_check_rus_domain_validation($email)) {
                        // $errorContainer[] = esc_html__( 'Email must not contain rus domain', 'mp-subscribe-form' );
                        if (($pageLocale === 'ru') || ($pageLocale === 'ru-RU') || ($pageLocale === 'ru_RU')) {
                            $errorContainer[] = 'Email не должен содержать рус доменов';
                        } elseif (($pageLocale === 'en') || ($pageLocale === 'en-US') || ($pageLocale === 'en_US')) {
                            $errorContainer[] = 'Email must not contain rus domain';
                        } elseif (($pageLocale === 'uk') || ($pageLocale === 'uk-UA') || ($pageLocale === 'uk_UA')) {
                            $errorContainer[] = 'Email не повинен містити рос доменів';
                        }
                    }

                    if (mp_is_email_adress_have_cyr($email)) {
                        // $errorContainer[] = esc_html__( 'Email must not contain Cyrillic characters', 'mp-subscribe-form' );
                        if (($pageLocale === 'ru') || ($pageLocale === 'ru-RU') || ($pageLocale === 'ru_RU')) {
                            $errorContainer[] = 'Email не должен содержать киррилицу';
                        } elseif (($pageLocale === 'en') || ($pageLocale === 'en-US') || ($pageLocale === 'en_US')) {
                            $errorContainer[] = 'Email must not contain Cyrillic characters';
                        } elseif (($pageLocale === 'uk') || ($pageLocale === 'uk-UA') || ($pageLocale === 'uk_UA')) {
                            $errorContainer[] = 'Email не повинен містити кирилицю';
                        }
                    }

                    if (mp_is_email_adress_valid($email)) {
                        // заголовки нашого запиту
                        $headers = array(
                            'Content-Type: application/json'
                        );

                        // поля нашого запиту
                        $postData = array(
                            'email' => $email,
                            'name'     => $name,
                        );

                        // перетворюємо поля у формат JSON
                        $dataJson = json_encode($postData);

                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataJson);
                        // Якщо потрібна відповідь сервера (true - ні, false - так)
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, $url);
                        // true - відправляється POST запит
                        curl_setopt($curl, CURLOPT_POST, true);

                        // результат POST запиту в JSON
                        $result = curl_exec($curl);

                        if ($result === false) {
                            echo 'CURL Error: ' . curl_error($curl);
                        } else { // echo 'No errors';
                            // результат POST запиту в Array
                            $responseArray = '';
                            $responseArray = json_decode($result, true);
                            // результат POST запиту в Object
                            $responseObject = '';
                            $responseObject = json_decode($result);
                        }
                    } //else {
                    // $errorContainer[] = 'Email is invalid';
                    // }


                    if (empty($errorContainer)) {
                        echo json_encode(array(
                            'result'  => 'success',
                            'message' => $responseArray
                        ));
                    } else {
                        echo json_encode(array(
                            'result' => 'error',
                            'text_error' => $errorContainer
                        ));
                    }

                    wp_die();
                }
            }
            add_action('wp_ajax_send_form', 'mp_subscribe_form_send_form'); // This is for authenticated users
            add_action('wp_ajax_nopriv_send_form', 'mp_subscribe_form_send_form'); // This is for unauthenticated users.

            if (!function_exists('mp_subscribe_form_shortcode')) {
                function mp_subscribe_form_shortcode()
                {
                    ob_start();

                    $output = '';
                    $output = '
			<div class="mp-subscribe-form">
					<form action="" method="post" name="mp-subscribe-form" id="mp-subscribe-form">
					<!-- <input name="email" type="email" akismet:author_email class="mp-subscribe-form__email" placeholder="' . esc_html__('Email', 'mp-subscribe-form') . '" required> -->
					<input name="email" type="text" akismet:author_email class="mp-subscribe-form__email" placeholder="' . esc_html__('Email', 'mp-subscribe-form') . '">
					<input type="hidden" name="action" value="send_form" style="display: none; visibility: hidden; opacity: 0;">
					<input type="hidden" name="lang" value="' . get_locale() . '">
					<button type="submit" name="submitbtn" id="submitbtn" class="mp-subscribe-form__button">' . esc_html__('Subscribe', 'mp-subscribe-form') . '</button>
				</form>

				<div class="mp-subscribe-form__errors"></div>
			</div>
		';

                    ob_end_clean();

                    return $output;
                }
            }
            add_shortcode('mp_subscribe_form_shortcode', 'mp_subscribe_form_shortcode');

            //Кастомная валидация поля Email
            add_action('wp_ajax_validate_email', 'validate_email_function');
            add_action('wp_ajax_nopriv_validate_email', 'validate_email_function');

            function validate_email_function()
            {
                check_ajax_referer('secure_nonce_name', 'nonce');  // Проверка nonce

                $email = sanitize_email($_POST['email']);
                $isValid = mp_is_email_adress_valid($email);  // Ваша функция для валидации email

                echo json_encode(['isValid' => $isValid]);
                wp_die();
            }

            function register_my_custom_fields()
            {
                if (function_exists('icl_register_string')) {
                    $users = get_users();
                    foreach ($users as $user) {
                        $bio_aut = get_field('bio_aut', 'user_' . $user->ID);
                        if ($bio_aut) {
                            icl_register_string('ACF', 'bio_aut_' . $user->ID, $bio_aut);
                        }
                    }
                }
            }
            add_action('init', 'register_my_custom_fields');

            function register_my_custom_fields2()
            {
                if (function_exists('icl_register_string')) {
                    $users = get_users();
                    foreach ($users as $user) {
                        $point_avtora = get_field('point_avtora', 'user_' . $user->ID);
                        if ($point_avtora) {
                            icl_register_string('ACF', 'point_avtora_' . $user->ID, $point_avtora);
                        }
                    }
                }
            }
            add_action('init', 'register_my_custom_fields2');

            //function enqueue_swiper_scripts() {
            //    wp_enqueue_style( 'swiper-styles', 'wp-content/themes/lanetclick/css/swiper-bundle.min.css' );
            //    }
            //add_action( 'wp_enqueue_scripts', 'enqueue_swiper_scripts' );


            add_action('wp_ajax_my_ajax_action', 'my_ajax_action');
            add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_action');

            function my_ajax_action()
            {
                $category_id = $_POST['category_id'];
                $imgcat = get_field('shapka_kategoriyi', 'category_' . $category_id);
                echo json_encode(array('imgcat' => $imgcat));
                wp_die();
            }
            add_action('init', function () {
                if (function_exists('icl_register_string')) {
                    icl_register_string('lanetclick', 'page_lang', 'en-US');
                }
            });
            function add_trailing_slash_to_links($url)
            {
                // Проверяем, находимся ли мы в админ-панели или на странице входа
                if (is_admin() || strpos($url, 'wp-login.php') !== false || strpos($url, 'wp-admin') !== false) {
                    return $url;
                }
                // Проверяем, является ли URL категорией или термином таксономии и уже имеет слеш
                if ((is_category() || is_tax()) && substr($url, -1) === '/') {
                    return $url; // Если это так, то не добавляем слеш
                }

                // Проверяем, есть ли '/' в конце URL
                if (substr($url, -1) !== '/') {
                    // Добавляем '/' в конце URL
                    $url .= '/';
                }
                return $url;
            }

            // Применяем фильтр к различным типам URL в WordPress
            add_filter('home_url', 'add_trailing_slash_to_links');
            add_filter('site_url', 'add_trailing_slash_to_links');
            add_filter('post_link', 'add_trailing_slash_to_links');
            add_filter('page_link', 'add_trailing_slash_to_links');
            add_filter('term_link', 'add_trailing_slash_to_links');
            add_filter('category_link', 'add_trailing_slash_to_links');
            add_filter('tag_link', 'add_trailing_slash_to_links');

            function redirect_to_lowercase()
            {
                // Если мы в админ-панели, то не выполняем перенаправление
                if (is_admin()) {
                    return;
                }

                $url = $_SERVER['REQUEST_URI'];

                // Проверяем наличие UTM-меток в URL
                if (strpos($url, 'utm_') !== false) {
                    return; // Если UTM-метки есть, не делаем перенаправление
                }

                if (preg_match('/[A-Z]/', $url)) {
                    $lowercase_url = strtolower($url);
                    wp_redirect($lowercase_url, 301);
                    exit();
                }
            }
            add_action('init', 'redirect_to_lowercase');


            function register_author_name_for_wpml()
            {
                if (function_exists('wpml_register_single_string')) {
                    $user_id = get_current_user_id();
                    $first_name = get_the_author_meta('first_name', $user_id);
                    $last_name = get_the_author_meta('last_name', $user_id);
                    $full_name = $first_name . ' ' . $last_name;

                    // Регистрация строки для перевода
                    wpml_register_single_string('lanetclick', 'author_full_name', $full_name);
                }
            }
            add_action('init', 'register_author_name_for_wpml');



            add_filter('aioseo_breadcrumbs_trail', 'customize_aioseo_author_breadcrumbs');

            function customize_aioseo_author_breadcrumbs($trail)
            {
                if (is_author()) {
                    $user_id = get_queried_object_id();
                    $first_name_key = 'first_name_' . $user_id;
                    $last_name_key = 'last_name_' . $user_id;

                    $first_name = get_the_author_meta('first_name', $user_id);
                    $last_name = get_the_author_meta('last_name', $user_id);

                    $first_name_translated = apply_filters('wpml_translate_single_string', $first_name, 'authors', $first_name_key);
                    $last_name_translated = apply_filters('wpml_translate_single_string', $last_name, 'authors', $last_name_key);

                    $translated_full_name = $first_name_translated . ' ' . $last_name_translated;

                    // Изменение последнего элемента хлебных крошек
                    $last_key = array_key_last($trail);
                    if (isset($trail[$last_key])) {
                        $trail[$last_key]['label'] = $translated_full_name;
                    }
                }
                return $trail;
            }
            add_filter('the_author', 'translate_author_name');

            function translate_author_name($display_name)
            {
                if (is_author() || is_single()) { // Изменяем имя автора только на странице автора или на странице записи
                    $user_id = get_the_author_meta('ID');
                    $first_name_key = 'first_name_' . $user_id;
                    $last_name_key = 'last_name_' . $user_id;

                    $first_name = get_the_author_meta('first_name', $user_id);
                    $last_name = get_the_author_meta('last_name', $user_id);

                    $first_name_translated = apply_filters('wpml_translate_single_string', $first_name, 'authors', $first_name_key);
                    $last_name_translated = apply_filters('wpml_translate_single_string', $last_name, 'authors', $last_name_key);

                    $translated_full_name = $first_name_translated . ' ' . $last_name_translated;

                    return $translated_full_name;
                }
                return $display_name; // Возвращаем оригинальное имя, если условия не соблюдены
            }


            add_filter('wpcf7_special_mail_tags', 'my_custom_special_mail_tag', 20, 3);
            function my_custom_special_mail_tag($output, $name, $html)
            {
                if ('user_IP' == $name) {
                    return $_SERVER['REMOTE_ADDR'];
                }
                return $output;
            }

            add_filter('wpcf7_posted_data', 'add_utm_params_to_form');
            function add_utm_params_to_form($posted_data)
            {

                $utm_params = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content'];
                foreach ($utm_params as $param) {
                    if (isset($_GET[$param])) {
                        $posted_data[$param] = sanitize_text_field($_GET[$param]);
                    }
                }
                return $posted_data;
            }

            add_filter('wpcf7_form_hidden_fields', 'add_nonce_to_cf7');
            function add_nonce_to_cf7($hidden_fields)
            {
                $hidden_fields['my_nonce'] = wp_create_nonce('my-nonce');
                return $hidden_fields;
            }
            // Валидация текстовых полей
            add_filter('wpcf7_validate_text*', 'custom_validation_for_required_fields1', 10, 2);

            // Валидация email полей
            add_filter('wpcf7_validate_email*', 'custom_validation_for_required_fields1', 10, 2);

            // Валидация полей для телефонов
            add_filter('wpcf7_validate_tel*', 'custom_validation_for_required_fields1', 10, 2);

            // Ваша функция валидации
            function custom_validation_for_required_fields1($result, $tag)
            {
                $tag = new WPCF7_FormTag($tag);

                // Получение значения поля
                $value = isset($_POST[$tag->name]) ? trim(wp_unslash(strtr((string) $_POST[$tag->name], "\n", " "))) : '';

                // Проверка, является ли поле пустым
                if (empty($value)) {
                    $result->invalidate($tag, 'Пожалуйста, заполните это поле.'); // Сообщение об ошибке
                }

                return $result;
            }

            add_action('wp_ajax_validate_phone', 'validate_phone_function');
            add_action('wp_ajax_nopriv_validate_phone', 'validate_phone_function');

            function validate_phone_function()
            {
                $response = array(
                    'message' => 'Function is called',
                    'nonce' => isset($_POST['nonce']) ? $_POST['nonce'] : 'Nonce is not set'
                );
                // Проверка nonce для безопасности
                check_ajax_referer('secure_nonce_name', 'nonce');

                // Получаем номер телефона из POST-запроса
                $phone_number = isset($_POST["phone"]) ? sanitize_text_field($_POST["phone"]) : '';
                if (strlen($phone_number) < 10) {
                    wp_send_json(array(
                        'isValid' => false
                        // Можете опустить 'message' если используете уже существующее сообщение в JS
                    ));
                    return;
                }

                // Инициализация переменных для хранения полного и валидного номера
                $full_number = '';
                $phone_valid = false;

                // Валидация для Украины (или других стран, если нужно)
                if (substr($phone_number, 0, 4) === '+380') {
                    if (strlen($phone_number) === 13) {
                        $full_number = $phone_number;
                        $phone_valid = preg_replace('/[^0-9+]/', '', trim($full_number));
                    }
                }
                // Валидация для других стран (если нужно)
                else {
                    if (strlen($phone_number) >= 9 && strlen($phone_number) <= 15) {
                        $full_number = $phone_number;
                        $phone_valid = preg_replace('/[^0-9+]/', '', trim($full_number));
                    }
                }

                // Если номер не валиден, устанавливаем $phone_valid в false
                if (!$phone_valid) {
                    $phone_valid = false;
                }

                // Возвращаем результат в формате JSON
                wp_send_json(array(
                    'isValid' => $phone_valid ? true : false,
                    'full_number' => $full_number,
                    'debug' => $response  // Добавленная строка
                ));
            }

            add_action('wp_ajax_cf7_ajax_submit', 'cf7_ajax_submit');
            add_action('wp_ajax_nopriv_cf7_ajax_submit', 'cf7_ajax_submit');

            function cf7_ajax_submit()
            {
                session_start();
                // Отладочная информация о сессии
                $session_debug_info = [
                    'session_id' => session_id(),
                    'session_data' => $_SESSION
                ];

                // Проверка nonce
                if (!wp_verify_nonce($_POST['my_nonce'], 'my-nonce')) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nonce verification failed',
                        'session_debug' => $session_debug_info
                    ]);
                    wp_die();
                }

                // Проверяем, не была ли форма отправлена в последние 24 часа
                if (isset($_SESSION['form_submitted_time']) && (time() - $_SESSION['form_submitted_time'] < 24 * 60 * 60)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Форма уже была отправлена. Повторная отправка заблокирована на 24 часа.',
                        'session_debug' => $session_debug_info
                    ]);
                    wp_die();
                }

                $cf7 = WPCF7_ContactForm::get_instance($_POST['id']);
                $submission = WPCF7_Submission::get_instance();
                if ($submission) {
                    $posted_data = $submission->get_posted_data();
                }

                // Отправка формы
                $result = $cf7->submit();
                if (is_object($result) && $result->is('mail_sent')) {
                    // Обновляем время отправки в сессии
                    $_SESSION['form_submitted_time'] = time();
                    echo json_encode([
                        'status' => 'mail_sent',
                        'session_debug' => $session_debug_info
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to send mail',
                        'code' => 'MAIL_FAILED',
                        'session_debug' => $session_debug_info
                    ]);
                }
                wp_die();
            }
            //підтягування назви категоріі при роботі з ajax
            add_action('wp_ajax_get_category_name_by_slug', 'get_category_name_by_slug');
            add_action('wp_ajax_nopriv_get_category_name_by_slug', 'get_category_name_by_slug');

            function get_category_name_by_slug()
            {
                $slug = $_POST['slug'];
                $category = get_category_by_slug($slug);
                if ($category) {
                    echo $category->name;
                } else {
                    echo 'Блог'; // Fallback
                }
                wp_die();
            }



            add_action('init', 'start_session', 1);
            function start_session()
            {
                if (!session_id()) {
                    session_start();
                }
            }

            add_action('wp_ajax_handle_utm_ajax', 'handle_utm_ajax');
            add_action('wp_ajax_nopriv_handle_utm_ajax', 'handle_utm_ajax');


            function handle_utm_ajax()
            {
                if (!session_id()) {
                    session_start();
                }
                // Проверка и очистка полученных данных
                if (isset($_POST['utm_data'])) {
                    // Декодирование JSON-строки в ассоциативный массив
                    $utm_data_raw = json_decode(stripslashes($_POST['utm_data']), true);

                    // Проверка, является ли декодированный массив массивом
                    if (is_array($utm_data_raw)) {
                        // Инициализация массива в сессии, если он еще не существует
                        if (!isset($_SESSION['utm_data'])) {
                            $_SESSION['utm_data'] = array();
                        }

                        // Очистка и сохранение каждого значения UTM-параметров в сессии
                        foreach ($utm_data_raw as $key => $value) {
                            // Здесь используйте функцию для очистки данных. В WordPress это может быть sanitize_text_field,
                            // но вне WordPress вам нужно будет заменить это на соответствующую функцию.
                            $_SESSION['utm_data'][$key] = sanitize_text_field($value);
                        }

                        // Возвращение сохраненных UTM данных
                        wp_send_json_success($_SESSION['utm_data']);
                    } else {
                        wp_send_json_error('UTM data format is incorrect');
                    }
                } else {
                    wp_send_json_error('No UTM data received');
                }

                wp_die();
            }
            function formatPhoneNumber($phoneNumber)
            {
                // Удаляем все символы, кроме цифр и плюса
                $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

                // Убеждаемся, что плюс находится в начале строки, если он там есть
                if (substr($phoneNumber, 0, 1) !== '+') {
                    $phoneNumber = '+' . $phoneNumber;
                }

                return $phoneNumber;
            }
            // Для зарегистрированных пользователей
            add_action('wp_ajax_submit_form_data_ajax_handler', 'submit_form_data_ajax_handler');
            // Для незарегистрированных пользователей
            add_action('wp_ajax_nopriv_submit_form_data_ajax_handler', 'submit_form_data_ajax_handler');

            function submit_form_data_ajax_handler()
            {
                $form_data = $_POST['form_data'];

                $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
                // Получение IP-адреса пользователя
                $user_ip = $_SERVER['REMOTE_ADDR'];

                $session_utm_data = isset($_SESSION['utm_data']) ? $_SESSION['utm_data'] : [];

                $utm_source = isset($session_utm_data['utm_source']) ? $session_utm_data['utm_source'] : '';
                $utm_medium = isset($session_utm_data['utm_medium']) ? $session_utm_data['utm_medium'] : '';
                $utm_campaign = isset($session_utm_data['utm_campaign']) ? $session_utm_data['utm_campaign'] : '';
                $utm_content = isset($session_utm_data['utm_content']) ? $session_utm_data['utm_content'] : '';
                $utm_term = isset($session_utm_data['utm_term']) ? $session_utm_data['utm_term'] : '';

                $source_mappings = [
                    'telegram' => 'Telegram',
                    'google' => 'Google Ads',
                    'facebook' => 'Facebook',
                    'email' => 'Електронна пошта',
                    'linkedin' => 'LinkedIn',
                    'instagram' => 'Іnstagram',
                ];

                $source = isset($source_mappings[$utm_source]) ? $source_mappings[$utm_source] : 'Сайт';
                // Преобразование данных для NetHunt CRM
                $nethunt_data = [
                    'timeZone' => 'Europe/Kiev',
                    'Name' => sanitize_text_field($form_data['your-name']) . ' ' . formatPhoneNumber($form_data['phone']),
                    'FirstName' => sanitize_text_field($form_data['your-name']),
                    'LastName' => sanitize_text_field($form_data['last-name']),
                    'Email' => sanitize_text_field($form_data['email']),
                    'Phone' => $form_data['phone'],
                    'CooperationGoal' =>  (!empty($form_data['comments']) ? sanitize_text_field($form_data['comments']) : '') . ' ' . !empty($form_data['helpers_form']) ? sanitize_text_field($form_data['helpers_form']) : ' ' .  ' User IP: ' . $user_ip,
                    'Source' => $source,
                    'UTMSource' => $utm_source,
                    'UTMMedium' => $utm_medium,
                    'UTMContent' => $utm_content,
                    'UTMCampaign' => $utm_campaign,
                    'UTMTerm' => $utm_term
                ];

                $back_data = [
                    'OPENED' => 'Y',
                    'TITLE' => (isset($form_data['your-name']) ? $form_data['your-name'] : '') . ' ' . (isset($form_data['phone']) ? formatPhoneNumber($form_data['phone']) : ''),
                    'NAME' => isset($form_data['your-name']) ? $form_data['your-name'] : '',
                    'EMAIL' => array(
                        'n0' => array(
                            'VALUE' => isset($form_data['email']) ? $form_data['email'] : '',
                            'VALUE_TYPE' => 'WORK',
                        ),
                    ),
                    'PHONE' => array(
                        'n0' => array(
                            'VALUE' => isset($form_data['phone']) ? formatPhoneNumber($form_data['phone']) : '',
                            'VALUE_TYPE' => 'WORK',
                        ),
                    ),
                    'COMMENTS' => sanitize_text_field($form_data['comments']) . ' ' . sanitize_text_field($form_data['helpers_form']) . ' User IP: ' . $user_ip,
                    'SOURCE_ID' => $form_data['source_id'],
                    'SOURCE' => $source,
                    'USER_IP' => $user_ip,
                    'ASSIGNED_BY_ID' => 99,
                    'SOURCE_DESCRIPTION' => $referrer,
                    'PAGE_TITLE' => $form_data['page_title'],
                    'DESCRIPTION' => $form_data['description'],
                    'UTMSource' => $utm_source,
                    'UTMMedium' => $utm_medium,
                    'UTMContent' => $utm_content,
                    'UTMCampaign' => $utm_campaign,
                    'UTMTerm' => $utm_term
                ];

                // Отправка данных в NetHunt CRM
                $response = wp_remote_post('https://nethunt.com/service/automation/hooks/658e92acebd1340009077610', [
                    'headers' => [
                        'Authorization' => 'Basic Y3JtaXVtLm5ldGh1bnRAZ21haWwuY29tOjM5Mjg4ZjNiLTBkM2EtNGJiNS05Yzk1LWZmMmY0MGMyYTI5Zg==',
                        'Content-Type'  => 'application/json',
                    ],
                    'body' => json_encode($nethunt_data),
                ]);
                if (!is_wp_error($response)) {
                    // Обработка успешной отправки в оба сервиса
                    echo json_encode(['status' => 'success', 'message' => $response]);
                    wp_remote_post('https://api.lanet.click/click_api/newlead', [
                        'headers' => ['Content-Type' => 'application/json; charset=utf-8'],
                        'body' => json_encode($back_data),
                        'method' => 'POST',
                        'data_format' => 'body',
                    ]);
                    exit();
                } else {
                    // Обработка ошибок при отправке данных
                    echo json_encode(['status' => 'error', 'message' => 'Произошла ошибка при отправке данных.', 'error_details' => [
                        'netHunt_error' => is_wp_error($response) ? $response->get_error_message() : null,
                    ]]);
                    exit();
                }
            }
            

            // Добавляем кнопку "Сгенерировать Sitemap" в админ-панель WordPress
            add_action('admin_bar_menu', 'add_sitemap_menu_item', 999);
            function add_sitemap_menu_item($wp_admin_bar)
            {
                $wp_admin_bar->add_menu(array(
                    'id'    => 'generate-sitemap',
                    'title' => 'Generate Sitemap',
                    'href'  => '#',
                    'meta'  => array(
                        'class' => 'generate-sitemap',
                        'title' => 'Generate Sitemap',
                    ),
                ));
            }

            // Общая функция для генерации sitemap
            function generate_sitemap($file, $generate_function)
            {
                require_once ABSPATH . 'wp-load.php';
                if ($file) {
                    if (isset($_SERVER['HTTP_USER_AGENT'])) {
                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (preg_match('/Googlebot/i', $user_agent)) {
                            fwrite($file, '<!DOCTYPE urlset>');
                            fwrite($file, '<urlset>');
                        } elseif (preg_match('/Bingbot/i', $user_agent) || preg_match('/YandexBot/i', $user_agent) || preg_match('/Baiduspider/i', $user_agent) || preg_match('/Yahoo! Slurp/i', $user_agent) || preg_match('/DuckDuckBot/i', $user_agent) || preg_match('/Applebot/i', $user_agent)) {
                            fwrite($file, '<?xml version="1.0" encoding="UTF-8"?>');
                            fwrite($file, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">');
                            fwrite($file, '<?xml-stylesheet type="text/xsl" href="' . $domain . '/sitemap.xsl"?>');
                        } else {
                            fwrite($file, '<?xml version="1.0" encoding="UTF-8"?>');
                            fwrite($file, '<!DOCTYPE urlset PUBLIC "-//Google//DTD Sitemap 0.9//EN" "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.dtd">');
                            fwrite($file, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
                        }
                    } else {
                        fwrite($file, '<!DOCTYPE urlset PUBLIC "-//Google//DTD Sitemap 0.9//EN" "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.dtd">');
                        fwrite($file, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
                    }

                    if ($generate_function === 'generate_images_sitemap') {
                        generate_images_sitemap($file);
                    } elseif ($generate_function === 'generate_posts_sitemap') {
                        generate_posts_sitemap($file);
                    }

                    fwrite($file, '</urlset>');
                    fclose($file);

                    // Отправить HTTP-заголовок Content-Type для указания типа содержимого
                    header('Content-Type: application/xml; charset=UTF-8');

                    // Отправить HTTP-заголовок для запрета индексации sitemap
                    header('X-Robots-Tag: noindex, follow');

                    wp_die();
                }
            }


            // Генерация images_sitemap.xml
            function generate_images_sitemap($file)
            {
                $args = array(
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => -1,
                );
                $attachments = get_posts($args);

                $added_urls = array(); // Массив для хранения уже добавленных ссылок

                foreach ($attachments as $attachment) {
                    $image_url      = wp_get_attachment_url($attachment->ID);
                    $image_modified = get_post_modified_time('Y-m-d', false, $attachment->ID);

                    // Проверка на дубликаты
                    if (!in_array($image_url, $added_urls)) {
                        fwrite($file, '<url>');
                        fwrite($file, '<loc>' . esc_url($image_url) . '</loc>');
                        fwrite($file, '<lastmod>' . $image_modified . '</lastmod>');
                        fwrite($file, '</url>');

                        $added_urls[] = $image_url; // Добавление ссылки в массив уже добавленных ссылок
                    }
                }
            }

            // Генерация sitemap.xml
            function generate_posts_sitemap($file)
            {
                $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');

                if (!empty($languages)) {
                    foreach ($languages as $language) {
                        do_action('wpml_switch_language', $language['code']);

                        $args = array(
                            'post_type'      => array('post', 'page'),
                            'posts_per_page' => -1,
                            'suppress_filters' => false // Это позволяет WPML изменять запрос для получения переводов
                        );
                        $posts = get_posts($args);

                        foreach ($posts as $post) {
                            // Для WPML нет необходимости проверять язык каждого поста отдельно, так как 'suppress_filters' => false
                            // позволяет автоматически получать посты на текущем языке
                            $permalink = get_permalink($post->ID);
                            fwrite($file, '<url>');
                            fwrite($file, '<loc>' . esc_url($permalink) . '</loc>');
                            fwrite($file, '</url>');
                        }
                    }

                    do_action('wpml_switch_language', NULL); // Возвращаемся к языку по умолчанию
                }
            }



            // Обработка AJAX-запроса для генерации sitemap.xml
            add_action('wp_ajax_generate_sitemap_ajax', 'generate_sitemap_ajax');
            add_action('wp_ajax_nopriv_generate_sitemap_ajax', 'generate_sitemap_ajax');
            function generate_sitemap_ajax()
            {
                $file = fopen(ABSPATH . 'sitemap.xml', 'w');
                generate_sitemap($file, 'generate_posts_sitemap');
            }

            add_action('wp_ajax_generate_sitemap_ajax1', 'generate_sitemap_ajax1');
            add_action('wp_ajax_nopriv_generate_sitemap_ajax1', 'generate_sitemap_ajax1');
            function generate_sitemap_ajax1()
            {
                $file = fopen(ABSPATH . 'images_sitemap.xml', 'w');
                generate_sitemap($file, 'generate_images_sitemap');
            }


            // Добавление скрипта генерации sitemap
            add_action('wp_enqueue_scripts', 'add_sitemap_script');
            add_action('admin_enqueue_scripts', 'add_sitemap_script');
            function add_sitemap_script()
            {
                if (current_user_can('administrator')) {
                    wp_enqueue_script('generate_sitemap', get_stylesheet_directory_uri() . '/assets/js/generate-sitemap.js', array('jquery'), '1.0', true);
                    wp_localize_script('generate_sitemap', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
                }
            }

            add_action('init', 'register_generate_sitemap_cron');
            function register_generate_sitemap_cron()
            {
                if (!wp_next_scheduled('generate_sitemap_cron_event')) {
                    wp_schedule_event(strtotime('next Saturday'), 'weekly', 'generate_sitemap_cron_event');
                }
            }

            // Запуск функции generate_sitemap_ajax при выполнении cron задачи
            add_action('generate_sitemap_cron_event', 'run_generate_sitemap_ajax');
            function run_generate_sitemap_ajax()
            {
                ob_start();
                $_REQUEST['action'] = 'generate_sitemap_ajax';
                require_once ABSPATH . 'wp-admin/admin-ajax.php';
                ob_end_clean();
            }
