<?php
/**
 * Template Name: Contact
 * Description: Page de contact avec formulaire
 *
 * @package OrthoSmile
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">Contactez-nous</h1>
            <p class="page-description">Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans votre parcours orthodontique.</p>
        </header>

        <div class="contact-page">
            <div class="contact-grid">
                <!-- Informations de contact -->
                <div class="contact-info">
                    <h2>Nos Coordonnées</h2>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="contact-details">
                            <h3>Adresse</h3>
                            <p>123 Rue de la Santé<br>75000 Paris</p>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="contact-details">
                            <h3>Téléphone</h3>
                            <p><a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">email</span>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><a href="mailto:contact@orthosmile.fr">contact@orthosmile.fr</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="contact-details">
                            <h3>Horaires d'ouverture</h3>
                            <p>Lundi - Vendredi: 9h00 - 19h00<br>Samedi: 9h00 - 13h00<br>Dimanche: Fermé</p>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de contact -->
                <div class="contact-form">
                    <h2>Formulaire de Contact</h2>
                    <p>Remplissez le formulaire ci-dessous pour nous contacter. Nous vous répondrons dans les plus brefs délais.</p>
                    
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="contact-form">
                        <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>
                        <input type="hidden" name="action" value="orthosmile_contact_form">
                        
                        <div class="form-group">
                            <label for="contact_name">Nom complet <span class="required">*</span></label>
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
                                <option value="devis">Demande de devis</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_message">Message <span class="required">*</span></label>
                            <textarea id="contact_message" name="contact_message" rows="6" placeholder="Décrivez votre demande..." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();