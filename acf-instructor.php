<?php

/**
 * Plugin Name:   ACF - Instructor
 * Description:   Add acf fields to course page. 
 * Version:       1.0.0
 * Author:        Wisdmlabs
 */

function enqueue_custom_script()
{
    wp_enqueue_script(
        'acf-instruct',
        plugin_dir_url(__FILE__) . 'my_acf.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script('acf-instruct', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'action' => 'my_ajax_action',
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

function my_ajax_callback()
{
    $data = acf_form(array(
        'field_groups' => array('group_649be3e33c1b8'),
        'html_submit_button' => false,
        //'post_id'       => 10,
        //'post_title'    => false,
        //'post_content'  => true,
        //'submit_value'  => __('Update meta')
    ));
    echo $data;
    wp_die();
}
add_action('wp_ajax_my_ajax_action', 'my_ajax_callback');
add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_callback');

function save_acf_form()
{
    acf_form_head();
}
add_action('wp_head', 'save_acf_form');

function add_acf_function()
{
    acf_enqueue_uploader();
}
//add_action('wp_footer', 'add_acf_function');

function my_pre_save_post($post_id)
{
    if ($post_id == 'new_data') {
        $post = array(
            'post_status'  => 'publish',
            'post_type'  => 'saved_data',
        );
        $post_id = wp_insert_post($post);
    }
    return $post_id;
}

function my_acf_save_post($post_id)
{
    acf_form(array(
        'post_id'      => $post_id,
        'field_groups' => array('group_649be3e33c1b8')
    ));
    exit();
}

add_filter('acf/pre_save_post', 'my_pre_save_post');
add_action('wp_ajax_save_app_data', 'acf_form_head');
add_action('wp_ajax_nopriv_save_app_data', 'acf_form_head');
add_action('acf/save_post', 'my_acf_save_post', 20);


?>