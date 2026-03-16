<?php
/**
 * The template for displaying the home page.
 *
 * @package OrthoSmile
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-tagline">
                    <span class="tagline-badge">Excellence Orthodontique</span>
                </div>
                <h1 class="hero-title">Votre sourire, notre expertise</h1>
                <p class="hero-subtitle">Des traitements orthodontiques sur mesure pour des résultats naturels et durables</p>
                <div class="hero-actions">
                    <a href="#contact" class="btn btn-primary">Prendre rendez-vous</a>
                    <a href="#contact" class="btn btn-secondary">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="trust-section" id="trust">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Une orthodontie fondée sur la précision et la pédagogie</h2>
                <p class="section-subtitle">Chaque traitement est défini selon votre occlusion, vos objectifs esthétiques et fonctionnels, puis expliqué simplement à chaque étape.</p>
            </div>
            
            <div class="trust-grid">
                <div class="trust-card">
                    <span class="material-symbols-outlined trust-icon">workspace_premium</span>
                    <div class="trust-value">18+</div>
                    <div class="trust-label">années d'expérience clinique</div>
                </div>
                <div class="trust-card">
                    <span class="material-symbols-outlined trust-icon">groups</span>
                    <div class="trust-value">8 500+</div>
                    <div class="trust-label">patients traités avec succès</div>
                </div>
                <div class="trust-card">
                    <span class="material-symbols-outlined trust-icon">health_and_safety</span>
                    <div class="trust-value">100%</div>
                    <div class="trust-label">protocoles certifiés et suivi expert</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specialists Section -->
    <?php get_template_part('template-parts/specialists'); ?>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nos Services</h2>
                <p class="section-subtitle">Une approche personnalisée pour chaque sourire, avec des solutions adaptées à votre âge, votre mode de vie et vos objectifs.</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge">Expertise</div>
                        <h3 class="service-title">Orthodontie Adulte</h3>
                        <p class="service-description">Des traitements sur mesure pour adultes, discrets et efficaces pour redonner éclat à votre sourire.</p>
                        <a href="#" class="btn btn-secondary">En savoir plus</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge">Prévention</div>
                        <h3 class="service-title">Orthodontie Enfant</h3>
                        <p class="service-description">Prise en charge précoce pour guider le développement harmonieux de la dentition et de la mâchoire.</p>
                        <a href="#" class="btn btn-secondary">En savoir plus</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-badge">Innovation</div>
                        <h3 class="service-title">Invisalign</h3>
                        <p class="service-description">Aligneurs transparents pour un traitement invisible et amovible, adapté à votre mode de vie.</p>
                        <a href="#" class="btn btn-secondary">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Contact & Prendre Rendez-vous</h2>
                <p class="section-subtitle">Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans votre parcours orthodontique.</p>
            </div>
            
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Coordonnées</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="contact-details">
                            <h4>Adresse</h4>
                            <p>123 Rue de la Santé, 75000 Paris</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="contact-details">
                            <h4>Téléphone</h4>
                            <p><a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">email</span>
                        </div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p><a href="mailto:contact@orthosmile.fr">contact@orthosmile.fr</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="contact-details">
                            <h4>Horaires</h4>
                            <p>Lun-Ven: 9h-19h</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Formulaire de Contact</h3>
                    <form action="#" method="post" class="contact-form">
                        <div class="form-group">
                            <label for="contact_name">Nom <span class="required">*</span></label>
                            <input type="text" id="contact_name" name="contact_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_email">Email <span class="required">*</span></label>
                            <input type="email" id="contact_email" name="contact_email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_phone">Téléphone</label>
                            <input type="tel" id="contact_phone" name="contact_phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_subject">Sujet <span class="required">*</span></label>
                            <select id="contact_subject" name="contact_subject" required>
                                <option value="">Choisissez un sujet</option>
                                <option value="rendez-vous">Prendre rendez-vous</option>
                                <option value="question">Poser une question</option>
                                <option value="urgence">Urgence orthodontique</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_message">Message <span class="required">*</span></label>
                            <textarea id="contact_message" name="contact_message" rows="5" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();