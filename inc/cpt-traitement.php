<?php
/**
 * Custom Post Type: Traitement (Treatments/Services)
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

function orthosmile_register_cpt_traitement() {
    $labels = [
        'name'               => __('Traitements', 'orthosmile'),
        'singular_name'      => __('Traitement', 'orthosmile'),
        'add_new'            => __('Ajouter un traitement', 'orthosmile'),
        'add_new_item'       => __('Ajouter un traitement', 'orthosmile'),
        'edit_item'          => __('Modifier le traitement', 'orthosmile'),
        'new_item'           => __('Nouveau traitement', 'orthosmile'),
        'not_found'          => __('Aucun traitement trouvé', 'orthosmile'),
        'menu_name'          => __('Traitements', 'orthosmile'),
    ];

    register_post_type('traitement', [
        'labels'          => $labels,
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'capability_type' => 'post',
        'has_archive'     => false,
        'hierarchical'    => false,
        'menu_position'   => 21,
        'menu_icon'       => 'dashicons-heart',
        'supports'        => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'    => true,
    ]);
}
add_action('init', 'orthosmile_register_cpt_traitement');

function orthosmile_traitement_meta_boxes() {
    add_meta_box(
        'traitement_details',
        __('Détails du traitement', 'orthosmile'),
        'orthosmile_traitement_meta_box_cb',
        'traitement',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'orthosmile_traitement_meta_boxes');

function orthosmile_traitement_meta_box_cb($post) {
    wp_nonce_field('orthosmile_traitement_meta', 'traitement_meta_nonce');

    $icone     = get_post_meta($post->ID, '_traitement_icone', true) ?: 'dentistry';
    $prix      = get_post_meta($post->ID, '_traitement_prix', true);
    $badge     = get_post_meta($post->ID, '_traitement_badge', true);

    $icones_suggestions = ['dentistry', 'visibility_off', 'child_care', 'workspace_premium', 'health_and_safety', 'favorite', 'star', 'verified', 'medical_services', 'face_retouching_natural'];
    ?>
    <table class="form-table">
        <tr>
            <th><label for="traitement_icone"><?php _e('Icône Material Symbols', 'orthosmile'); ?></label></th>
            <td>
                <input type="text" id="traitement_icone" name="traitement_icone"
                       value="<?php echo esc_attr($icone); ?>" class="regular-text">
                <p class="description">
                    <?php _e('Nom de l\'icône Material Symbols. Suggestions : ', 'orthosmile'); ?>
                    <code><?php echo implode(', ', $icones_suggestions); ?></code><br>
                    <a href="https://fonts.google.com/icons" target="_blank"><?php _e('Voir toutes les icônes →', 'orthosmile'); ?></a>
                </p>
            </td>
        </tr>
        <tr>
            <th><label for="traitement_badge"><?php _e('Badge / Label court', 'orthosmile'); ?></label></th>
            <td>
                <input type="text" id="traitement_badge" name="traitement_badge"
                       value="<?php echo esc_attr($badge); ?>" class="regular-text"
                       placeholder="<?php esc_attr_e('ex: Populaire, Innovation, Dès 7 ans', 'orthosmile'); ?>">
                <p class="description"><?php _e('Badge coloré affiché en haut de la carte (optionnel).', 'orthosmile'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="traitement_prix"><?php _e('Fourchette de prix (optionnel)', 'orthosmile'); ?></label></th>
            <td>
                <input type="text" id="traitement_prix" name="traitement_prix"
                       value="<?php echo esc_attr($prix); ?>" class="regular-text"
                       placeholder="<?php esc_attr_e('ex: À partir de 1 200€', 'orthosmile'); ?>">
            </td>
        </tr>
    </table>
    <p class="description" style="margin-top:12px;padding:10px;background:#f0fdf4;border-left:3px solid #0f766e;">
        <?php _e('💡 La <strong>description</strong> du traitement s\'écrit dans la zone de texte principale. L\'<strong>image illustrative</strong> se définit via "Image mise en avant".', 'orthosmile'); ?>
    </p>
    <?php
}

function orthosmile_traitement_save_meta($post_id) {
    if (!isset($_POST['traitement_meta_nonce']) || !wp_verify_nonce($_POST['traitement_meta_nonce'], 'orthosmile_traitement_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['traitement_icone'])) {
        update_post_meta($post_id, '_traitement_icone', sanitize_text_field($_POST['traitement_icone']));
    }
    if (isset($_POST['traitement_badge'])) {
        update_post_meta($post_id, '_traitement_badge', sanitize_text_field($_POST['traitement_badge']));
    }
    if (isset($_POST['traitement_prix'])) {
        update_post_meta($post_id, '_traitement_prix', sanitize_text_field($_POST['traitement_prix']));
    }
}
add_action('save_post_traitement', 'orthosmile_traitement_save_meta');
