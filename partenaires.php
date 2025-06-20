<?php
session_start();
require_once 'config/database.php';

// Récupérer tous les partenaires
$stmt = $pdo->query("SELECT * FROM partenaires WHERE statut = 'actif' ORDER BY id");
$partenaires = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Partenaires | DKM Auto</title>
    <meta name="description" content="Découvrez nos partenaires de confiance : NextPart, Pièces Économiques, Castrol, Bosch et plus. Qualité garantie pour vos pièces automobiles.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --netflix-red: #e50914;
            --netflix-dark: #141414;
            --netflix-dark-gray: #1f1f1f;
            --netflix-light-gray: #808080;
            --netflix-white: #ffffff;
            --dkm-primary: #e50914;
            --dkm-secondary: #f5c518;
            --dkm-accent: #00d4ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--netflix-dark);
            color: var(--netflix-white);
            line-height: 1.6;
        }

        /* Netflix-style Navbar */
        .navbar {
            background: var(--netflix-dark);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 2rem;
            color: var(--netflix-red) !important;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .navbar-nav .nav-link {
            color: var(--netflix-white) !important;
            font-weight: 500;
            margin: 0 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--netflix-red) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            min-height: 50vh;
            display: flex;
            align-items: center;
            margin-top: 76px;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--netflix-red), var(--dkm-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--netflix-light-gray);
            margin-bottom: 2rem;
        }

        /* Partners Section */
        .partners-section {
            padding: 4rem 0;
            background: var(--netflix-dark);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--netflix-white);
        }

        .section-subtitle {
            text-align: center;
            color: var(--netflix-light-gray);
            margin-bottom: 4rem;
            font-size: 1.1rem;
        }

        .partner-card {
            background: var(--netflix-dark-gray);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 3rem;
            border: 1px solid #333;
            height: 100%;
        }

        .partner-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.3);
            border-color: var(--netflix-red);
        }

        .partner-logo {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .partner-card:hover .partner-logo {
            transform: scale(1.05);
        }

        .partner-card-body {
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .partner-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .partner-description {
            color: var(--netflix-light-gray);
            line-height: 1.8;
            margin-bottom: 2rem;
            font-size: 1rem;
            flex-grow: 1;
        }

        .partner-contact {
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            color: var(--netflix-light-gray);
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            color: var(--netflix-red);
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 20px;
        }

        .contact-text {
            color: var(--netflix-white);
            font-weight: 500;
        }

        .btn-partner {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-partner:hover {
            background: #f40612;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
            color: var(--netflix-white);
        }

        /* Benefits Section */
        .benefits-section {
            background: linear-gradient(135deg, var(--netflix-dark-gray) 0%, var(--netflix-dark) 100%);
            padding: 4rem 0;
        }

        .benefit-card {
            background: var(--netflix-dark-gray);
            border-radius: 15px;
            padding: 2.5rem;
            border: 1px solid #333;
            text-align: center;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            border-color: var(--netflix-red);
        }

        .benefit-icon {
            font-size: 3rem;
            color: var(--netflix-red);
            margin-bottom: 1.5rem;
        }

        .benefit-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .benefit-text {
            color: var(--netflix-light-gray);
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: var(--netflix-dark);
            padding: 2rem 0;
            border-top: 1px solid #333;
            text-align: center;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: var(--netflix-light-gray);
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--netflix-red);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .partner-name {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-car"></i> DKM Auto
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipe.php">Équipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="partenaires.php">Partenaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Nos Partenaires</h1>
                <p class="hero-subtitle">Des partenaires de confiance pour des pièces et services de qualité</p>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Partenaires de Confiance</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Nous travaillons avec les meilleurs fournisseurs pour vous garantir qualité et fiabilité
            </p>

            <div class="row">
                <?php foreach ($partenaires as $index => $partenaire): ?>
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 200; ?>">
                        <div class="partner-card">
                            <img src="<?php echo htmlspecialchars($partenaire['logo_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($partenaire['nom']); ?>" 
                                 class="partner-logo">
                            <div class="partner-card-body">
                                <h3 class="partner-name"><?php echo htmlspecialchars($partenaire['nom']); ?></h3>
                                <p class="partner-description"><?php echo htmlspecialchars($partenaire['description']); ?></p>
                                
                                <div class="partner-contact">
                                    <?php if ($partenaire['email']): ?>
                                        <div class="contact-item">
                                            <i class="fas fa-envelope contact-icon"></i>
                                            <span class="contact-text"><?php echo htmlspecialchars($partenaire['email']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($partenaire['telephone']): ?>
                                        <div class="contact-item">
                                            <i class="fas fa-phone contact-icon"></i>
                                            <span class="contact-text"><?php echo htmlspecialchars($partenaire['telephone']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($partenaire['site_web']): ?>
                                        <div class="contact-item">
                                            <i class="fas fa-globe contact-icon"></i>
                                            <span class="contact-text"><?php echo htmlspecialchars($partenaire['site_web']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($partenaire['site_web']): ?>
                                    <a href="<?php echo htmlspecialchars($partenaire['site_web']); ?>" 
                                       target="_blank" class="btn btn-partner">
                                        <i class="fas fa-external-link-alt"></i> Visiter le site
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Avantages de nos Partenariats</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Pourquoi choisir DKM Auto et ses partenaires
            </p>

            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="benefit-card">
                        <i class="fas fa-shield-alt benefit-icon"></i>
                        <h4 class="benefit-title">Garantie Qualité</h4>
                        <p class="benefit-text">Toutes nos pièces sont garanties et proviennent de partenaires certifiés</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="benefit-card">
                        <i class="fas fa-tags benefit-icon"></i>
                        <h4 class="benefit-title">Prix Compétitifs</h4>
                        <p class="benefit-text">Grâce à nos partenariats, nous vous offrons les meilleurs prix</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="benefit-card">
                        <i class="fas fa-shipping-fast benefit-icon"></i>
                        <h4 class="benefit-title">Livraison Rapide</h4>
                        <p class="benefit-text">Disponibilité immédiate ou livraison express selon vos besoins</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="benefit-card">
                        <i class="fas fa-headset benefit-icon"></i>
                        <h4 class="benefit-title">Support Technique</h4>
                        <p class="benefit-text">Assistance technique complète de nos partenaires</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                <i class="fas fa-car"></i> DKM Auto
            </div>
            <div class="footer-links">
                <a href="index.php">Accueil</a>
                <a href="services.php">Services</a>
                <a href="equipe.php">Équipe</a>
                <a href="partenaires.php">Partenaires</a>
                <a href="index.php#contact">Contact</a>
            </div>
            <p style="color: var(--netflix-light-gray); margin-top: 1rem;">
                &copy; 2024 DKM Auto. Tous droits réservés.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Partner card hover effects
        document.querySelectorAll('.partner-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Benefit card hover effects
        document.querySelectorAll('.benefit-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> 