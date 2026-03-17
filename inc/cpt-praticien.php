<?php
/**
 * Custom Post Type: Praticien (Practitioners)
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) exit;

function orthosmile_register_cpt_praticien() {
    $labels = [
        'name'               => __('Praticiens', 'orthosmile'),
        'singular_name'      => __('Praticien', 'orthosmile'),
        'add_new'            => __('Ajouter un praticien', 'orthosmile'),
        'add_new_item'       => __('Ajouter un praticien', 'orthosmile'),
        'edit_item'          => __('Modifier le praticien', 'orthosmile'),
        'new_item'           => __('Nouveau praticien', 'orthosmile'),
        'view_item'          => __('Voir le praticien', 'orthosmile'),
        'search_items'       => __('Rechercher un praticien', 'orthosmile'),
        'not_found'          => __('Aucun praticien trouvé', 'orthosmile'),
        'not_found_in_trash' => __('Aucun praticien dans la corbeille', 'orthosmile'),
        'menu_name'          => __('Praticiens', 'orthosmile'),
    ];

    register_post_type('praticien', [
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'orthosmile_register_cpt_praticien');

/**
 * Add meta boxes for Praticien CPT.
 */
function orthosmile_praticien_meta_boxes() {
    add_meta_box(
        'praticien_details',
        __('Informations du praticien', 'orthosmile'),
        'orthosmile_praticien_meta_box_cb',
        'praticien',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'orthosmile_praticien_meta_boxes');

function orthosmile_praticien_meta_box_cb($post) {
    wp_nonce_field('orthosmile_praticien_meta', 'praticien_meta_nonce');

    $poste         = get_post_meta($post->ID, '_praticien_poste', true);
    $specialites   = get_post_meta($post->ID, '_praticien_specialites', true) ?: [];
    $linkedin      = get_post_meta($post->ID, '_praticien_linkedin', true);

    $specialites_options = ['Invisalign', 'Brackets', 'Pédiatrie', 'Chirurgie Orthognathique', 'Contention', 'Orthodontie Adulte'];
    ?>
    <table class="form-table">
        <tr>
            <th><label for="praticien_poste"><?php _e('Titre / Spécialité', 'orthosmile'); ?></label></th>
            <td>
                <input type="text" id="praticien_poste" name="praticien_poste"
                       value="<?php echo esc_attr($poste); ?>" class="regular-text"
                       placeholder="<?php esc_attr_e('ex: Orthodontiste Diplômée', 'orthosmile'); ?>">
                <p class="description"><?php _e('Titre affiché sous le nom du praticien.', 'orthosmile'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label><?php _e('Spécialités', 'orthosmile'); ?></label></th>
            <td>
                <?php foreach ($specialites_options as $option) : ?>
                    <label style="display:inline-block;margin-right:12px;margin-bottom:6px;">
                        <input type="checkbox" name="praticien_specialites[]"
                               value="<?php echo esc_attr($option); ?>"
                               <?php checked(in_array($option, (array)$specialites)); ?>>
                        <?php echo esc_html($option); ?>
                    </label>
                <?php endforeach; ?>
                <p class="description"><?php _e('Sélectionnez les spécialités du praticien.', 'orthosmile'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="praticien_linkedin"><?php _e('Profil LinkedIn (URL)', 'orthosmile'); ?></label></th>
            <td>
                <input type="url" id="praticien_linkedin" name="praticien_linkedin"
                       value="<?php echo esc_url($linkedin); ?>" class="regular-text"
                       placeholder="https://linkedin.com/in/...">
            </td>
        </tr>
    </table>
    <p class="description" style="margin-top:12px;padding:10px;background:#f0fdf4;border-left:3px solid #0f766e;">
        <?php _e('💡 La <strong>photo</strong> du praticien se définit via "Image mise en avant" dans le panneau de droite. La <strong>biographie</strong> s\'écrit dans la zone de texte principale.', 'orthosmile'); ?>
    </p>
    <?php
}

function orthosmile_praticien_save_meta($post_id) {
    if (!isset($_POST['praticien_meta_nonce']) || !wp_verify_nonce($_POST['praticien_meta_nonce'], 'orthosmile_praticien_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['praticien_poste'])) {
        update_post_meta($post_id, '_praticien_poste', sanitize_text_field($_POST['praticien_poste']));
    }
    if (isset($_POST['praticien_specialites'])) {
        update_post_meta($post_id, '_praticien_specialites', array_map('sanitize_text_field', (array)$_POST['praticien_specialites']));
    } else {
        update_post_meta($post_id, '_praticien_specialites', []);
    }
    if (isset($_POST['praticien_linkedin'])) {
        update_post_meta($post_id, '_praticien_linkedin', esc_url_raw($_POST['praticien_linkedin']));
    }
}
add_action('save_post_praticien', 'orthosmile_praticien_save_meta');
