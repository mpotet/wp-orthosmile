<?php
/**
 * Template Name: Contact
 * Description: Page de contact avec formulaire
 *
 * @package OrthoSmile
 */

get_header();

$contact = orthosmile_get_contact_info();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Contactez-nous', 'orthosmile'); ?></h1>
            <p class="page-description"><?php esc_html_e('Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans votre parcours orthodontique.', 'orthosmile'); ?></p>
        </header>

        <div class="contact-page">
            <div class="contact-grid">
                <!-- Informations de contact -->
                <div class="contact-info">
                    <h2><?php esc_html_e('Nos Coordonnées', 'orthosmile'); ?></h2>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="contact-details">
                            <h3><?php esc_html_e('Adresse', 'orthosmile'); ?></h3>
                            <p><?php echo esc_html($contact['address']); ?></p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="contact-details">
                            <h3><?php esc_html_e('Téléphone', 'orthosmile'); ?></h3>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact['phone'])); ?>"><?php echo esc_html($contact['phone']); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">email</span>
                        </div>
                        <div class="contact-details">
                            <h3><?php esc_html_e('Email', 'orthosmile'); ?></h3>
                            <p><a href="mailto:<?php echo esc_attr($contact['email']); ?>"><?php echo esc_html($contact['email']); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="contact-details">
                            <h3><?php esc_html_e("Horaires d'ouverture", 'orthosmile'); ?></h3>
                            <p><?php echo esc_html($contact['opening_hours']); ?></p>
                        </div>
                    </div>

                    <?php if ($contact['map_embed']) : ?>
                    <div class="contact-map">
                        <?php echo wp_kses_post($contact['map_embed']); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Formulaire de contact -->
                <div class="contact-form-wrap">
                    <h2><?php esc_html_e('Formulaire de Contact', 'orthosmile'); ?></h2>
                    <p><?php esc_html_e('Remplissez le formulaire ci-dessous pour nous contacter. Nous vous répondrons dans les plus brefs délais.', 'orthosmile'); ?></p>

                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="contact-form">
                        <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>
                        <input type="hidden" name="action" value="orthosmile_contact_form">

                        <div class="form-group">
                            <label for="contact_name"><?php esc_html_e('Nom complet', 'orthosmile'); ?> <span class="required">*</span></label>
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
                                <option value="devis"><?php esc_html_e('Demande de devis', 'orthosmile'); ?></option>
                                <option value="autre"><?php esc_html_e('Autre', 'orthosmile'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact_message"><?php esc_html_e('Message', 'orthosmile'); ?> <span class="required">*</span></label>
                            <textarea id="contact_message" name="contact_message" rows="6" placeholder="<?php esc_attr_e('Décrivez votre demande...', 'orthosmile'); ?>" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php esc_html_e('Envoyer le message', 'orthosmile'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();