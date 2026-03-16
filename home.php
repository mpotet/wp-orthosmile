<?php
/**
 * The template for displaying the home page.
 *
 * @package OrthoSmile
 */

get_header();

$hero    = orthosmile_get_hero_content();
$trust   = orthosmile_get_trust_content();
$contact = orthosmile_get_contact_info();
?>

<main id="primary" class="site-main" role="main">
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-tagline">
                    <span class="tagline-badge"><?php esc_html_e('Excellence Orthodontique', 'orthosmile'); ?></span>
                </div>
                <h1 class="hero-title"><?php echo esc_html($hero['title']); ?></h1>
                <p class="hero-subtitle"><?php echo esc_html($hero['subtitle']); ?></p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url($hero['cta_url'] ?: '#contact'); ?>" class="btn btn-primary"><?php echo esc_html($hero['cta_text']); ?></a>
                    <a href="#contact" class="btn btn-secondary"><?php esc_html_e('Nous contacter', 'orthosmile'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="trust-section" id="trust">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($trust['title']); ?></h2>
                <p class="section-subtitle"><?php echo esc_html($trust['subtitle']); ?></p>
            </div>

            <div class="trust-grid">
                <?php foreach ($trust['items'] as $item) : ?>
                <div class="trust-card">
                    <span class="material-symbols-outlined trust-icon"><?php echo esc_html($item['icon']); ?></span>
                    <div class="trust-value"><?php echo esc_html($item['value']); ?></div>
                    <div class="trust-label"><?php echo esc_html($item['label']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Specialists Section -->
    <?php get_template_part('template-parts/specialists'); ?>

    <!-- Services Section -->
    <?php if (orthosmile_show_section('services')) : ?>
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e('Nos Services', 'orthosmile'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Une approche personnalisée pour chaque sourire, avec des solutions adaptées à votre âge, votre mode de vie et vos objectifs.', 'orthosmile'); ?></p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge"><?php esc_html_e('Expertise', 'orthosmile'); ?></div>
                        <h3 class="service-title"><?php esc_html_e('Orthodontie Adulte', 'orthosmile'); ?></h3>
                        <p class="service-description"><?php esc_html_e('Des traitements sur mesure pour adultes, discrets et efficaces pour redonner éclat à votre sourire.', 'orthosmile'); ?></p>
                        <a href="#" class="btn btn-secondary"><?php esc_html_e('En savoir plus', 'orthosmile'); ?></a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge"><?php esc_html_e('Prévention', 'orthosmile'); ?></div>
                        <h3 class="service-title"><?php esc_html_e('Orthodontie Enfant', 'orthosmile'); ?></h3>
                        <p class="service-description"><?php esc_html_e('Prise en charge précoce pour guider le développement harmonieux de la dentition et de la mâchoire.', 'orthosmile'); ?></p>
                        <a href="#" class="btn btn-secondary"><?php esc_html_e('En savoir plus', 'orthosmile'); ?></a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge"><?php esc_html_e('Innovation', 'orthosmile'); ?></div>
                        <h3 class="service-title"><?php esc_html_e('Invisalign', 'orthosmile'); ?></h3>
                        <p class="service-description"><?php esc_html_e('Aligneurs transparents pour un traitement invisible et amovible, adapté à votre mode de vie.', 'orthosmile'); ?></p>
                        <a href="#" class="btn btn-secondary"><?php esc_html_e('En savoir plus', 'orthosmile'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e('Contact &amp; Prendre Rendez-vous', 'orthosmile'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans votre parcours orthodontique.', 'orthosmile'); ?></p>
            </div>

            <div class="contact-container">
                <div class="contact-info">
                    <h3><?php esc_html_e('Coordonnées', 'orthosmile'); ?></h3>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Adresse', 'orthosmile'); ?></h4>
                            <p><?php echo esc_html($contact['address']); ?></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Téléphone', 'orthosmile'); ?></h4>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact['phone'])); ?>"><?php echo esc_html($contact['phone']); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">email</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Email', 'orthosmile'); ?></h4>
                            <p><a href="mailto:<?php echo esc_attr($contact['email']); ?>"><?php echo esc_html($contact['email']); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Horaires', 'orthosmile'); ?></h4>
                            <p><?php echo esc_html($contact['opening_hours']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h3><?php esc_html_e('Formulaire de Contact', 'orthosmile'); ?></h3>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>
                        <input type="hidden" name="action" value="orthosmile_contact_form">

                        <div class="form-group">
                            <label for="home_contact_name"><?php esc_html_e('Nom', 'orthosmile'); ?> <span class="required">*</span></label>
                            <input type="text" id="home_contact_name" name="contact_name" required>
                        </div>

                        <div class="form-group">
                            <label for="home_contact_email"><?php esc_html_e('Email', 'orthosmile'); ?> <span class="required">*</span></label>
                            <input type="email" id="home_contact_email" name="contact_email" required>
                        </div>

                        <div class="form-group">
                            <label for="home_contact_phone"><?php esc_html_e('Téléphone', 'orthosmile'); ?></label>
                            <input type="tel" id="home_contact_phone" name="contact_phone">
                        </div>

                        <div class="form-group">
                            <label for="home_contact_subject"><?php esc_html_e('Sujet', 'orthosmile'); ?> <span class="required">*</span></label>
                            <select id="home_contact_subject" name="contact_subject" required>
                                <option value=""><?php esc_html_e('Choisissez un sujet', 'orthosmile'); ?></option>
                                <option value="rendez-vous"><?php esc_html_e('Prendre rendez-vous', 'orthosmile'); ?></option>
                                <option value="question"><?php esc_html_e('Poser une question', 'orthosmile'); ?></option>
                                <option value="urgence"><?php esc_html_e('Urgence orthodontique', 'orthosmile'); ?></option>
                                <option value="autre"><?php esc_html_e('Autre', 'orthosmile'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="home_contact_message"><?php esc_html_e('Message', 'orthosmile'); ?> <span class="required">*</span></label>
                            <textarea id="home_contact_message" name="contact_message" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php esc_html_e('Envoyer le message', 'orthosmile'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();