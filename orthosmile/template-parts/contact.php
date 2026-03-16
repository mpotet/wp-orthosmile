<?php
/**
 * Template part for displaying the contact section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

$contact_info = orthosmile_get_contact_info();
$social_links = orthosmile_get_social_links();
?>

<section class="contact-section" id="contact">
    <div class="container">
        <div class="section-header fade-in-up">
            <h2 class="section-title"><?php esc_html_e('Contact & Prendre Rendez-vous', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans votre parcours orthodontique.', 'orthosmile'); ?></p>
        </div>
        
        <div class="contact-container">
            <div class="contact-info fade-in-up">
                <h3><?php esc_html_e('Coordonnées', 'orthosmile'); ?></h3>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Adresse', 'orthosmile'); ?></h4>
                        <p><?php echo esc_html($contact_info['address']); ?></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Téléphone', 'orthosmile'); ?></h4>
                        <p>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_info['phone'])); ?>">
                                <?php echo esc_html($contact_info['phone']); ?>
                            </a>
                        </p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">email</span>
                    </div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Email', 'orthosmile'); ?></h4>
                        <p>
                            <a href="mailto:<?php echo esc_attr($contact_info['email']); ?>">
                                <?php echo esc_html($contact_info['email']); ?>
                            </a>
                        </p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Horaires', 'orthosmile'); ?></h4>
                        <p><?php echo esc_html($contact_info['opening_hours']); ?></p>
                    </div>
                </div>
                
                <?php if (!empty($social_links)) : ?>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">share</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Suivez-nous', 'orthosmile'); ?></h4>
                            <div class="footer-social">
                                <?php foreach ($social_links as $social) : ?>
                                    <a href="<?php echo esc_url($social['url']); ?>" aria-label="<?php echo esc_attr($social['label']); ?>">
                                        <span class="material-symbols-outlined"><?php echo esc_html($social['icon']); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($contact_info['map_embed']) : ?>
                    <div class="contact-item">
                        <div class="contact-details">
                            <h4><?php esc_html_e('Localisation', 'orthosmile'); ?></h4>
                            <div class="map-container">
                                <?php echo $contact_info['map_embed']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="contact-form fade-in-up">
                <h3><?php esc_html_e('Formulaire de Contact', 'orthosmile'); ?></h3>
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="contact-form">
                    <?php wp_nonce_field('orthosmile_contact_form', 'orthosmile_contact_nonce'); ?>
                    <input type="hidden" name="action" value="orthosmile_contact">
                    
                    <div class="form-group">
                        <label for="contact_name"><?php esc_html_e('Nom', 'orthosmile'); ?> <span class="required">*</span></label>
                        <input type="text" id="contact_name" name="contact_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_email"><?php esc_html_e('Email', 'orthosmile'); ?> <span class="required">*</span></label>
                        <input type="email" id="contact_email" name="contact_email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_phone"><?php esc_html_e('Téléphone', 'orthosmile'); ?></label>
                        <input type="tel" id="contact_phone" name="contact_phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_subject"><?php esc_html_e('Sujet', 'orthosmile'); ?> <span class="required">*</span></label>
                        <select id="contact_subject" name="contact_subject" required>
                            <option value=""><?php esc_html_e('Choisissez un sujet', 'orthosmile'); ?></option>
                            <option value="rendez-vous"><?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?></option>
                            <option value="question"><?php esc_html_e('Poser une question', 'orthosmile'); ?></option>
                            <option value="urgence"><?php esc_html_e('Urgence orthodontique', 'orthosmile'); ?></option>
                            <option value="autre"><?php esc_html_e('Autre', 'orthosmile'); ?></option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_message"><?php esc_html_e('Message', 'orthosmile'); ?> <span class="required">*</span></label>
                        <textarea id="contact_message" name="contact_message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php esc_html_e('Envoyer le message', 'orthosmile'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>