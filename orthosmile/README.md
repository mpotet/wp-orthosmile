# OrthoSmile - Theme WordPress Orthodontiste

Un thème WordPress premium spécialement conçu pour les cabinets d'orthodontie et les cliniques dentaires.

## Fonctionnalités

### Design Moderne et Professionnel
- Design responsive et élégant
- Palette de couleurs personnalisable via le Customizer
- Typographie soignée avec Google Fonts
- Animations fluides et transitions douces

### Sections Premium
- **Hero Section** - Bannière d'accueil impactante avec image de fond
- **Section Confiance** - Affichage de vos certifications et expériences
- **Services** - Présentation de vos différents traitements orthodontiques
- **Galerie Before/After** - Comparaison visuelle des résultats avec slider interactif
- **Équipe** - Présentation de vos praticiens
- **Témoignages** - Retours d'expérience de vos patients
- **FAQ** - Questions fréquemment posées avec système d'accordion
- **Appel à l'action** - Boutons de conversion pour les rendez-vous
- **Contact** - Formulaire de contact et coordonnées

### Fonctionnalités Techniques
- Navigation responsive avec menu mobile
- Comparateur d'images Before/After interactif
- Formulaire de contact intégré
- Compatibilité SEO optimisée
- Intégration des réseaux sociaux
- Personnalisation via le Customizer WordPress
- Support multilingue (Polylang compatible)

## Installation

1. Téléchargez le thème OrthoSmile
2. Connectez-vous à votre tableau de bord WordPress
3. Allez dans Apparence > Thèmes > Ajouter un nouveau
4. Cliquez sur "Uploader un thème" et sélectionnez le fichier zip
5. Activez le thème

## Personnalisation

Accédez à Apparence > Personnaliser pour modifier :

### Informations de Contact
- Numéro de téléphone
- Email
- Adresse
- Horaires d'ouverture
- Code d'intégration Google Maps

### Contenu des Sections
- Textes et titres de chaque section
- Images de fond pour le hero
- Contenu des cartes de confiance
- Services proposés
- Témoignages des patients
- Questions/Réponses FAQ

### Apparence
- Couleur primaire
- Couleur d'accent
- Affichage/masquage des sections

### Réseaux Sociaux
- Liens vers vos profils Facebook, Twitter, Instagram, LinkedIn

## Structure des Fichiers

```
orthosmile/
├── functions.php              # Configuration principale du thème
├── header.php                 # En-tête du site
├── footer.php                 # Pied de page
├── home.php                   # Page d'accueil
├── index.php                  # Page d'articles
├── page.php                   # Pages statiques
├── 404.php                    # Page d'erreur 404
├── style.css                  # En-tête du thème (obligatoire)
├── assets/
│   ├── css/
│   │   ├── main.css          # Styles principaux
│   │   └── editor-style.css  # Styles de l'éditeur
│   ├── js/
│   │   └── main.js           # Scripts JavaScript
│   └── images/               # Images du thème
├── inc/
│   ├── theme-setup.php       # Configuration du thème
│   ├── template-tags.php     # Fonctions de template
│   ├── template-functions.php # Fonctions personnalisées
│   └── customizer.php        # Options de personnalisation
├── template-parts/           # Parties de template réutilisables
│   ├── hero.php             # Section hero
│   ├── trust.php            # Section confiance
│   ├── services.php         # Section services
│   ├── gallery.php          # Galerie before/after
│   ├── doctors.php          # Équipe médicale
│   ├── testimonials.php     # Témoignages
│   ├── faq.php              # FAQ
│   ├── cta.php              # Appel à l'action
│   ├── contact.php          # Contact
│   ├── footer.php           # Footer
│   └── content.php          # Contenu des articles
└── languages/               # Fichiers de traduction
    └── orthosmile.pot       # Fichier de base pour traduction
```

## Dépendances

- WordPress 6.4 ou supérieur
- PHP 8.0 ou supérieur
- Support des menus WordPress
- Support des images mises en avant

## Personnalisation Avancée

Pour des modifications plus poussées, vous pouvez :

1. **Modifier les styles CSS** dans `assets/css/main.css`
2. **Ajouter des fonctionnalités** dans `inc/template-functions.php`
3. **Créer des templates personnalisés** dans `template-parts/`
4. **Ajouter des options** dans `inc/customizer.php`

## Support

Pour toute question ou problème technique, merci de contacter le développeur.

## License

Ce thème est fourni sous license GNU GPL v2 ou ultérieur.