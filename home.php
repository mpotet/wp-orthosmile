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

    <!-- FAQ Section -->
    <?php if (orthosmile_show_section('faq')) : ?>
    <?php get_template_part('template-parts/faq'); ?>
    <?php endif; ?>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e('Contact &amp; Informations', 'orthosmile'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Retrouvez toutes nos coordonnées pour prendre rendez-vous ou nous contacter.', 'orthosmile'); ?></p>
            </div>

            <div class="contact-container contact-container--simple">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Adresse', 'orthosmile'); ?></h4>
                            <p><?php echo esc_html($contact['address'] ?: 'XXXX — adresse à renseigner dans le Customiseur'); ?></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Téléphone', 'orthosmile'); ?></h4>
                            <p>
                                <?php if ($contact['phone']) : ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact['phone'])); ?>"><?php echo esc_html($contact['phone']); ?></a>
                                <?php else : ?>
                                XXXX — téléphone à renseigner dans le Customiseur
                                <?php endif; ?>
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
                                <?php if ($contact['email']) : ?>
                                <a href="mailto:<?php echo esc_attr($contact['email']); ?>"><?php echo esc_html($contact['email']); ?></a>
                                <?php else : ?>
                                XXXX — email à renseigner dans le Customiseur
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="contact-details">
                            <h4><?php esc_html_e('Horaires', 'orthosmile'); ?></h4>
                            <p><?php echo esc_html($contact['opening_hours'] ?: 'XXXX — horaires à renseigner dans le Customiseur'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();