<?php
/**
 * Template part for displaying the FAQ section.
 *
 * @package OrthoSmile
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get FAQ items from theme options or fallback to default
$faq_items = get_theme_mod('faq_items', [
    [
        'question' => __('À quel âge peut-on commencer un traitement orthodontique ?', 'orthosmile'),
        'answer' => __('Le traitement peut commencer dès 7-8 ans pour une prise en charge précoce, ou à tout âge pour les adultes. Chaque cas est évalué individuellement lors de la consultation initiale.', 'orthosmile')
    ],
    [
        'question' => __('Combien de temps dure un traitement orthodontique ?', 'orthosmile'),
        'answer' => __('La durée moyenne est de 18 à 24 mois, mais cela varie selon la complexité du cas, l\'âge du patient et le type d\'appareil choisi.', 'orthosmile')
    ],
    [
        'question' => __('Les appareils dentaires sont-ils douloureux ?', 'orthosmile'),
        'answer' => __('Les premiers jours peuvent être inconfortables, mais la douleur est généralement légère et disparaît rapidement. Des solutions existent pour soulager tout inconfort.', 'orthosmile')
    ],
    [
        'question' => __('Puis-je porter un appareil si je joue d\'un instrument de musique ?', 'orthosmile'),
        'answer' => __('Oui, la plupart des patients s\'adaptent rapidement. Des protections spéciales sont disponibles pour les instruments à vent.', 'orthosmile')
    ],
    [
        'question' => __('Que se passe-t-il après la fin du traitement ?', 'orthosmile'),
        'answer' => __('Une phase de contention est nécessaire pour stabiliser les dents dans leur nouvelle position. Cette phase dure généralement 1 à 2 ans.', 'orthosmile')
    ],
    [
        'question' => __('L\'orthodontie est-elle remboursée par la sécurité sociale ?', 'orthosmile'),
        'answer' => __('Le remboursement dépend de l\'âge et de la pathologie. Les enfants de moins de 16 ans bénéficient d\'un remboursement partiel. Les mutuelles complémentaires peuvent prendre en charge une partie des frais.', 'orthosmile')
    ]
]);
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header fade-in-up">
            <h2 class="section-title"><?php esc_html_e('Questions Fréquentes', 'orthosmile'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Vous avez des questions ? Nous avons les réponses. Retrouvez ici les informations essentielles sur l\'orthodontie.', 'orthosmile'); ?></p>
        </div>
        
        <div class="faq-container fade-in-up">
            <?php foreach ($faq_items as $index => $faq) : ?>
                <div class="faq-item" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="faq-question">
                        <?php echo esc_html($faq['question']); ?>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo esc_html($faq['answer']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>