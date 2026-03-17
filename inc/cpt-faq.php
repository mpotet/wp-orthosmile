<?php
/**
 * Custom Post Type: FAQ
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

function orthosmile_register_cpt_faq() {
    $labels = [
        'name'          => __('FAQ', 'orthosmile'),
        'singular_name' => __('Question FAQ', 'orthosmile'),
        'add_new'       => __('Ajouter une question', 'orthosmile'),
        'add_new_item'  => __('Ajouter une question FAQ', 'orthosmile'),
        'edit_item'     => __('Modifier la question', 'orthosmile'),
        'not_found'     => __('Aucune question trouvée', 'orthosmile'),
        'menu_name'     => __('FAQ', 'orthosmile'),
    ];

    register_post_type('faq_item', [
        'labels'          => $labels,
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'capability_type' => 'post',
        'has_archive'     => false,
        'hierarchical'    => false,
        'menu_position'   => 22,
        'menu_icon'       => 'dashicons-editor-help',
        'supports'        => ['title', 'editor', 'page-attributes'],
        'show_in_rest'    => true,
    ]);
}
add_action('init', 'orthosmile_register_cpt_faq');

/**
 * Rename "Extrait" (excerpt) column to "Réponse" hint in admin.
 */
function orthosmile_faq_admin_columns($columns) {
    $columns['title'] = __('Question', 'orthosmile');
    $columns['order'] = __('Ordre', 'orthosmile');
    unset($columns['date']);
    $columns['date'] = __('Date', 'orthosmile');
    return $columns;
}
add_filter('manage_faq_item_posts_columns', 'orthosmile_faq_admin_columns');

function orthosmile_faq_admin_column_content($column, $post_id) {
    if ($column === 'order') {
        echo (int) get_post_field('menu_order', $post_id);
    }
}
add_action('manage_faq_item_posts_custom_column', 'orthosmile_faq_admin_column_content', 10, 2);
