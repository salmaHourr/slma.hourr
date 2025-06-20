<?php
session_start();
require_once 'config/database.php';

// Récupérer tous les membres de l'équipe
$stmt = $pdo->query("SELECT * FROM equipe WHERE statut = 'actif' ORDER BY id");
$equipe = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Équipe | DKM Auto</title>
    <meta name="description" content="Découvrez l'équipe DKM Auto : Mohammed Zwawi, Jean-Pierre Tremblay et Marie-Claude Dubois. Experts en mécanique automobile à Québec.">
    
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
                        url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
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

        /* Team Section */
        .team-section {
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

        .team-card {
            background: var(--netflix-dark-gray);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 3rem;
            border: 1px solid #333;
            text-align: center;
        }

        .team-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.3);
            border-color: var(--netflix-red);
        }

        .team-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .team-card:hover .team-image {
            transform: scale(1.05);
        }

        .team-card-body {
            padding: 2.5rem 2rem;
        }

        .team-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 0.5rem;
        }

        .team-position {
            font-size: 1.1rem;
            color: var(--netflix-red);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .team-description {
            color: var(--netflix-light-gray);
            line-height: 1.8;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .team-contact {
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
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

        .team-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #333;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--netflix-red);
            display: block;
        }

        .stat-label {
            color: var(--netflix-light-gray);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Recrutement Section */
        .recruitment-section {
            background: linear-gradient(135deg, var(--netflix-dark-gray) 0%, var(--netflix-dark) 100%);
            padding: 4rem 0;
        }

        .recruitment-card {
            background: var(--netflix-dark-gray);
            border-radius: 15px;
            padding: 3rem;
            border: 1px solid #333;
            text-align: center;
        }

        .recruitment-icon {
            font-size: 4rem;
            color: var(--netflix-red);
            margin-bottom: 2rem;
        }

        .recruitment-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .recruitment-text {
            color: var(--netflix-light-gray);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .btn-recruitment {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-recruitment:hover {
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
            
            .team-name {
                font-size: 1.5rem;
            }
            
            .team-stats {
                flex-direction: column;
                gap: 1rem;
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
                        <a class="nav-link active" href="equipe.php">Équipe</a>
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
                <h1 class="hero-title">Notre Équipe</h1>
                <p class="hero-subtitle">Découvrez les experts passionnés qui font de DKM Auto votre garage de confiance</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">L'Équipe DKM Auto</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Des professionnels expérimentés dédiés à votre satisfaction
            </p>

            <div class="row">
                <?php foreach ($equipe as $index => $membre): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 200; ?>">
                        <div class="team-card">
                            <img src="<?php echo htmlspecialchars($membre['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($membre['nom']); ?>" 
                                 class="team-image">
                            <div class="team-card-body">
                                <h3 class="team-name"><?php echo htmlspecialchars($membre['nom']); ?></h3>
                                <p class="team-position"><?php echo htmlspecialchars($membre['poste']); ?></p>
                                <p class="team-description"><?php echo htmlspecialchars($membre['description']); ?></p>
                                
                                <div class="team-contact">
                                    <?php if ($membre['email']): ?>
                                        <div class="contact-item">
                                            <i class="fas fa-envelope contact-icon"></i>
                                            <span class="contact-text"><?php echo htmlspecialchars($membre['email']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($membre['telephone']): ?>
                                        <div class="contact-item">
                                            <i class="fas fa-phone contact-icon"></i>
                                            <span class="contact-text"><?php echo htmlspecialchars($membre['telephone']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Team Stats -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="team-stats" data-aos="fade-up" data-aos-delay="800">
                        <div class="stat-item">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Mécaniciens</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <span class="stat-label">Années d'expérience</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">7</span>
                            <span class="stat-label">Lifts disponibles</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recruitment Section -->
    <section class="recruitment-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="recruitment-card" data-aos="fade-up">
                        <i class="fas fa-users recruitment-icon"></i>
                        <h3 class="recruitment-title">Nous Recrutons !</h3>
                        <p class="recruitment-text">
                            DKM Auto est en pleine expansion et nous cherchons des mécaniciens passionnés 
                            pour rejoindre notre équipe. Si vous êtes qualifié et que vous aimez le travail 
                            bien fait, contactez-nous !
                        </p>
                        <a href="index.php#contact" class="btn btn-recruitment">
                            <i class="fas fa-paper-plane"></i> Postuler maintenant
                        </a>
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

        // Team card hover effects
        document.querySelectorAll('.team-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> 