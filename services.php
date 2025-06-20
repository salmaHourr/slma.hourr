<?php
session_start();
require_once 'config/database.php';

// Récupérer tous les services
$stmt = $pdo->query("SELECT * FROM services WHERE statut = 'actif' ORDER BY categorie, nom");
$services = $stmt->fetchAll();

// Grouper les services par catégorie
$services_by_category = [];
foreach ($services as $service) {
    $category = $service['categorie'];
    if (!isset($services_by_category[$category])) {
        $services_by_category[$category] = [];
    }
    $services_by_category[$category][] = $service;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services | DKM Auto</title>
    <meta name="description" content="Découvrez tous nos services automobiles à Québec : mécanique générale, carrosserie, alignement, diagnostic et plus.">
    
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
                        url('https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
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

        /* Services Section */
        .services-section {
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

        .category-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--netflix-red);
            margin: 3rem 0 2rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .service-card {
            background: var(--netflix-dark-gray);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            border: 1px solid #333;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(229, 9, 20, 0.3);
            border-color: var(--netflix-red);
        }

        .service-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-card-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .service-description {
            color: var(--netflix-light-gray);
            margin-bottom: 1.5rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .service-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dkm-secondary);
            margin-bottom: 1.5rem;
        }

        .service-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .service-features li {
            color: var(--netflix-light-gray);
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .service-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--netflix-red);
            font-weight: bold;
        }

        .btn-service {
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

        .btn-service:hover {
            background: #f40612;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
            color: var(--netflix-white);
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
            
            .category-title {
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
                        <a class="nav-link active" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipe.php">Équipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="partenaires.php">Partenaires</a>
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
                <h1 class="hero-title">Nos Services</h1>
                <p class="hero-subtitle">Découvrez notre gamme complète de services automobiles professionnels</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Services Disponibles</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Expertise technique et service de qualité pour tous vos besoins automobiles
            </p>

            <?php foreach ($services_by_category as $category => $services): ?>
                <div class="category-section" data-aos="fade-up">
                    <h3 class="category-title">
                        <?php
                        $category_names = [
                            'entretien' => 'Entretien',
                            'mecanique' => 'Mécanique',
                            'carrosserie' => 'Carrosserie',
                            'electronique' => 'Électronique',
                            'pieces' => 'Pièces'
                        ];
                        echo $category_names[$category] ?? ucfirst($category);
                        ?>
                    </h3>
                    
                    <div class="row">
                        <?php foreach ($services as $service): ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="service-card">
                                    <img src="<?php echo htmlspecialchars($service['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($service['nom']); ?>">
                                    <div class="service-card-body">
                                        <h4 class="service-title"><?php echo htmlspecialchars($service['nom']); ?></h4>
                                        <p class="service-description"><?php echo htmlspecialchars($service['description']); ?></p>
                                        
                                        <div class="service-price">
                                            <?php if ($service['prix_min'] > 0 && $service['prix_max'] > 0): ?>
                                                À partir de <?php echo number_format($service['prix_min'], 2); ?>$
                                            <?php elseif ($service['prix_min'] == 0 && $service['prix_max'] == 0): ?>
                                                Devis gratuit
                                            <?php else: ?>
                                                Prix sur demande
                                            <?php endif; ?>
                                        </div>

                                        <ul class="service-features">
                                            <?php
                                            // Caractéristiques basées sur la catégorie
                                            $features = [];
                                            switch ($service['categorie']) {
                                                case 'entretien':
                                                    $features = ['Service rapide', 'Pièces de qualité', 'Garantie incluse'];
                                                    break;
                                                case 'mecanique':
                                                    $features = ['Expertise technique', 'Équipement moderne', 'Diagnostic précis'];
                                                    break;
                                                case 'carrosserie':
                                                    $features = ['Réparations diverses', 'Travail aluminium', 'Devis gratuit'];
                                                    break;
                                                case 'electronique':
                                                    $features = ['Équipement OBD2', 'Diagnostic complet', 'Rapport détaillé'];
                                                    break;
                                                case 'pieces':
                                                    $features = ['Pièces neuves', 'Partenaires certifiés', 'Prix compétitifs'];
                                                    break;
                                            }
                                            ?>
                                            <?php foreach ($features as $feature): ?>
                                                <li><?php echo htmlspecialchars($feature); ?></li>
                                            <?php endforeach; ?>
                                        </ul>

                                        <a href="rdv.php" class="btn btn-service">
                                            <i class="fas fa-calendar"></i> Prendre RDV
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
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

        // Service card hover effects
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> 