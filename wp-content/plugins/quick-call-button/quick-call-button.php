<?php
/*
Plugin Name: Quick Call Button
Description: Hiển thị nút gọi nhanh qua số điện thoại ngoài trang web.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Ngăn truy cập trực tiếp
}

// Đăng ký shortcode
add_shortcode('quick_call', 'qcb_display_call_button');

// Hàm hiển thị nút gọi nhanh
function qcb_display_call_button($atts) {
    $atts = shortcode_atts([
        'phone' => '0123456789',  // Số điện thoại mặc định
        'label' => 'Gọi ngay',   // Nội dung nút mặc định
        'bg_color' => '#28a745', // Màu nền mặc định
        'text_color' => '#ffffff' // Màu chữ mặc định
    ], $atts);

    $phone = esc_attr($atts['phone']);
    $label = esc_html($atts['label']);
    $bg_color = esc_attr($atts['bg_color']);
    $text_color = esc_attr($atts['text_color']);

    $html = '<div class="quick-call-button">';
    $html .= '<a href="tel:' . $phone . '" class="quick-call-link" style="background-color: ' . $bg_color . '; color: ' . $text_color . '; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; display: inline-flex; align-items: center; gap: 10px;">';
    $html .= '<i class="fas fa-phone-alt"></i>'; // Icon điện thoại
    $html .= $label;
    $html .= '</a>';
    $html .= '</div>';

    return $html;
}



// Đăng ký Font Awesome
add_action('wp_enqueue_scripts', 'qcb_enqueue_font_awesome');
function qcb_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}

// Đăng ký CSS cho nút gọi nhanh
add_action('wp_enqueue_scripts', 'qcb_enqueue_styles');
function qcb_enqueue_styles() {
    wp_enqueue_style('qcb-styles', plugin_dir_url(__FILE__) . 'assets/style.css');
}


// Thêm nút gọi nhanh vào footer
add_action('wp_footer', 'qcb_display_call_button_on_all_pages');
function qcb_display_call_button_on_all_pages() {
    $phone = get_option('qcb_phone', '0987654321'); // Số điện thoại
    $label = get_option('qcb_label', 'Gọi ngay');   // Nội dung nút
    $bg_color = get_option('qcb_bg_color', '#28a745'); // Màu nền
    $text_color = get_option('qcb_text_color', '#ffffff'); // Màu chữ

    echo '<div class="quick-call-button">';
    echo '<a href="tel:' . esc_attr($phone) . '" class="quick-call-link" style="background-color: ' . esc_attr($bg_color) . '; color: ' . esc_attr($text_color) . '; padding: 15px 20px; text-decoration: none; border-radius: 50px; font-size: 16px; display: inline-flex; align-items: center; gap: 10px; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">';
    echo '<i class="fas fa-phone-alt"></i>';
    echo esc_html($label);
    echo '</a>';
    echo '</div>';
}


// Thêm menu cài đặt vào WordPress Admin
add_action('admin_menu', 'qcb_add_settings_menu');
function qcb_add_settings_menu() {
    add_menu_page(
        'Quick Call Settings',        // Tiêu đề trang
        'Quick Call',                 // Tên menu
        'manage_options',             // Quyền truy cập
        'quick-call-settings',        // Slug trang
        'qcb_settings_page',          // Hàm hiển thị nội dung
        'dashicons-phone',            // Icon menu
        100                           // Vị trí menu
    );
}

// Hàm hiển thị nội dung trang cài đặt
function qcb_settings_page() {
    ?>
    <div class="wrap">
        <h1>Cài đặt Nút Gọi Nhanh</h1>
        <form method="post" action="options.php">
            <?php
            // Hiển thị các trường cài đặt
            settings_fields('qcb_settings_group');
            do_settings_sections('quick-call-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Đăng ký cài đặt
add_action('admin_init', 'qcb_register_settings');
function qcb_register_settings() {
    // Đăng ký nhóm cài đặt
    register_setting('qcb_settings_group', 'qcb_phone');
    register_setting('qcb_settings_group', 'qcb_label');
    register_setting('qcb_settings_group', 'qcb_bg_color');
    register_setting('qcb_settings_group', 'qcb_text_color');

    // Thêm phần cài đặt
    add_settings_section(
        'qcb_settings_section',
        'Cấu hình Nút Gọi',
        'qcb_settings_section_callback',
        'quick-call-settings'
    );

    // Thêm trường cài đặt
    add_settings_field(
        'qcb_phone',
        'Số điện thoại',
        'qcb_phone_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_label',
        'Nội dung nút',
        'qcb_label_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_bg_color',
        'Màu nền',
        'qcb_bg_color_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_text_color',
        'Màu chữ',
        'qcb_text_color_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );
}

// Callback cho phần cài đặt
function qcb_settings_section_callback() {
    echo '<p>Cấu hình các tùy chọn cho nút gọi nhanh.</p>';
}

// Callback cho các trường cài đặt
function qcb_phone_callback() {
    $value = get_option('qcb_phone', '0987654321');
    echo '<input type="text" name="qcb_phone" value="' . esc_attr($value) . '" class="regular-text">';
}

function qcb_label_callback() {
    $value = get_option('qcb_label', 'Gọi ngay');
    echo '<input type="text" name="qcb_label" value="' . esc_attr($value) . '" class="regular-text">';
}

function qcb_bg_color_callback() {
    $value = get_option('qcb_bg_color', '#28a745');
    echo '<input type="color" name="qcb_bg_color" value="' . esc_attr($value) . '">';
}

function qcb_text_color_callback() {
    $value = get_option('qcb_text_color', '#ffffff');
    echo '<input type="color" name="qcb_text_color" value="' . esc_attr($value) . '">';
}
