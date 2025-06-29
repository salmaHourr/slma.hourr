<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DKM Auto | Mécanique générale et services automobiles à Québec</title>
    <meta name="description" content="DKM Auto - Votre garage de confiance à Québec. Mécanique générale, vente de pièces, carrosserie, alignement. Service 7j/7 sans rendez-vous.">
    <meta name="keywords" content="garage Québec, mécanique générale, pièces auto, carrosserie, alignement, DKM Auto">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    
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
            --dkm-dark: #0a0a0a;
            --dkm-light: #f8f9fa;
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
            overflow-x: hidden;
        }

        /* Netflix-style Navbar */
        .navbar {
            background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, transparent 100%);
            transition: all 0.3s ease;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar.scrolled {
            background: var(--netflix-dark);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
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
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: var(--netflix-red) !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--netflix-red);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .nav-icon {
            color: var(--netflix-white);
            margin: 0 0.75rem;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-icon:hover {
            color: var(--netflix-red);
            transform: scale(1.1);
        }
        
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-auth {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-login {
            background: transparent;
            color: var(--netflix-white);
            border: 2px solid var(--netflix-white);
        }

        .btn-login:hover {
            background: var(--netflix-white);
            color: var(--netflix-dark);
            transform: translateY(-2px);
        }

        .btn-signup {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: 2px solid var(--netflix-red);
        }

        .btn-signup:hover {
            background: #f40612;
            color: var(--netflix-white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.4);
        }

        .btn-rdv {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-rdv:hover {
            background: #f40612;
            color: var(--netflix-white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.4);
        }

        /* Hero Section - Netflix Style */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--netflix-red), var(--dkm-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--netflix-white);
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--netflix-light-gray);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Netflix-style Buttons */
        .btn-netflix {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-netflix:hover {
            background: #f40612;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
            color: var(--netflix-white);
        }

        .btn-netflix::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-netflix:hover::before {
            left: 100%;
        }

        .btn-secondary-netflix {
            background: transparent;
            color: var(--netflix-white);
            border: 2px solid var(--netflix-white);
            padding: 13px 38px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .btn-secondary-netflix:hover {
            background: var(--netflix-white);
            color: var(--netflix-dark);
            transform: translateY(-2px);
        }

        /* Services Section - Netflix Grid Style */
        .services-section {
            padding: 6rem 0;
            background: var(--netflix-dark);
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--netflix-white);
        }

        .section-subtitle {
            font-size: 1.2rem;
            text-align: center;
            color: var(--netflix-light-gray);
            margin-bottom: 4rem;
        }

        .service-card {
            background: var(--netflix-dark-gray);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            position: relative;
            border: 1px solid #333;
        }

        .service-card:hover {
            transform: translateY(-10px) scale(1.02);
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
        }

        .service-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dkm-secondary);
            margin-bottom: 1rem;
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

        /* Features Section */
        .features-section {
            background: linear-gradient(135deg, var(--netflix-dark-gray) 0%, var(--netflix-dark) 100%);
            padding: 6rem 0;
        }

        .feature-item {
            text-align: center;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 4rem;
            color: var(--netflix-red);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--netflix-light-gray);
            line-height: 1.6;
        }

        /* About Section */
        .about-section {
            padding: 6rem 0;
            background: var(--netflix-dark);
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .about-text {
            flex: 1;
        }

        .about-image {
            flex: 1;
            text-align: center;
        }

        .about-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, var(--netflix-dark-gray) 0%, var(--netflix-dark) 100%);
            padding: 6rem 0;
        }

        .contact-info {
            background: var(--netflix-dark-gray);
            padding: 2rem;
            border-radius: 10px;
            border: 1px solid #333;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(229, 9, 20, 0.1);
            transform: translateX(10px);
        }

        .contact-icon {
            font-size: 1.5rem;
            color: var(--netflix-red);
            margin-right: 1rem;
            width: 40px;
            text-align: center;
        }

        .contact-text {
            color: var(--netflix-white);
        }

        /* Footer */
        .footer {
            background: var(--netflix-dark);
            padding: 3rem 0 1rem;
            border-top: 1px solid #333;
        }

        .footer-content {
            text-align: center;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 800;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .footer-links {
            margin-bottom: 2rem;
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

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 2rem;
            color: var(--netflix-light-gray);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2.5rem;
            }
            
            .about-content {
                flex-direction: column;
                gap: 2rem;
            }
            
            .btn-secondary-netflix {
                margin-left: 0;
                margin-top: 1rem;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--netflix-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #333;
            border-top: 3px solid var(--netflix-red);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <!-- Loading Screen -->
    <div class="loading" id="loading">
        <div class="spinner"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-car"></i> DKM Auto
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#a-propos">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                
                <div class="auth-buttons">
                    <a href="login.php" class="btn-auth btn-login">Se connecter</a>
                    <a href="register.php" class="btn-auth btn-signup">S'inscrire</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="accueil">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">DKM Auto</h1>
                <p class="hero-subtitle">Votre garage de confiance à Québec</p>
                <p class="hero-description">
                    Mécanique générale, vente de pièces, carrosserie et alignement. 
                    Service 7j/7 sans rendez-vous avec 7 lifts disponibles.
                </p>
                <div class="hero-buttons">
                    <a href="#services" class="btn btn-netflix">
                        <i class="fas fa-tools"></i> Nos Services
                    </a>
                    <a href="rdv.php" class="btn btn-secondary-netflix">
                        <i class="fas fa-calendar"></i> Prendre RDV
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-item">
                        <i class="fas fa-tools feature-icon"></i>
                        <h4 class="feature-title">Mécanique Générale</h4>
                        <p class="feature-description">Service complet pour tous types de véhicules avec expertise technique</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-item">
                        <i class="fas fa-cogs feature-icon"></i>
                        <h4 class="feature-title">7 Lifts Disponibles</h4>
                        <p class="feature-description">Équipement moderne pour un service rapide et efficace</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-item">
                        <i class="fas fa-clock feature-icon"></i>
                        <h4 class="feature-title">Service 7j/7</h4>
                        <p class="feature-description">Sans rendez-vous, quand vous en avez besoin</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h4 class="feature-title">Garantie</h4>
                        <p class="feature-description">Travail garanti avec pièces de qualité</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Nos Services</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Découvrez notre gamme complète de services automobiles
            </p>
            
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Changement d'huile">
                        <div class="service-card-body">
                            <h3 class="service-title">Changement d'huile</h3>
                            <div class="service-price">À partir de 29.99$</div>
                            <p class="service-description">Service rapide et professionnel pour maintenir votre moteur en parfait état.</p>
                            <ul class="service-features">
                                <li>Huile de qualité</li>
                                <li>Filtre inclus</li>
                                <li>Service express</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Prendre RDV</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Alignement">
                        <div class="service-card-body">
                            <h3 class="service-title">Alignement</h3>
                            <div class="service-price">À partir de 39.99$</div>
                            <p class="service-description">Alignement précis pour une conduite sécuritaire et confortable.</p>
                            <ul class="service-features">
                                <li>Équipement moderne</li>
                                <li>Réglage précis</li>
                                <li>Garantie incluse</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Prendre RDV</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Carrosserie">
                        <div class="service-card-body">
                            <h3 class="service-title">Carrosserie & Aluminium</h3>
                            <div class="service-price">Devis gratuit</div>
                            <p class="service-description">Réparations et transformations de carrosserie professionnelles.</p>
                            <ul class="service-features">
                                <li>Réparations diverses</li>
                                <li>Travail aluminium</li>
                                <li>Devis gratuit</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Devis gratuit</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Diagnostic électronique">
                        <div class="service-card-body">
                            <h3 class="service-title">Diagnostic Électronique</h3>
                            <div class="service-price">À partir de 49.99$</div>
                            <p class="service-description">Diagnostic précis des problèmes électroniques de votre véhicule.</p>
                            <ul class="service-features">
                                <li>Équipement OBD2</li>
                                <li>Diagnostic complet</li>
                                <li>Rapport détaillé</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Prendre RDV</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Moteurs & Transmissions">
                        <div class="service-card-body">
                            <h3 class="service-title">Moteurs & Transmissions</h3>
                            <div class="service-price">Devis sur mesure</div>
                            <p class="service-description">Réparation et entretien des moteurs et transmissions.</p>
                            <ul class="service-features">
                                <li>Expertise technique</li>
                                <li>Pièces de qualité</li>
                                <li>Garantie étendue</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Devis gratuit</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="service-card">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Vente de pièces">
                        <div class="service-card-body">
                            <h3 class="service-title">Vente de Pièces</h3>
                            <div class="service-price">Prix compétitifs</div>
                            <p class="service-description">Large gamme de pièces automobiles de qualité.</p>
                            <ul class="service-features">
                                <li>Pièces neuves</li>
                                <li>Partenaires NextPart</li>
                                <li>Pièces Économiques</li>
                            </ul>
                            <a href="rdv.php" class="btn btn-netflix w-100">Consulter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="a-propos">
        <div class="container">
            <div class="about-content">
                <div class="about-text" data-aos="fade-right">
                    <h2 class="section-title">À propos de DKM Auto</h2>
                    <p style="font-size: 1.2rem; color: var(--netflix-light-gray); margin-bottom: 2rem;">
                        Fondé par Mohammed Zwawi, DKM Auto est votre partenaire de confiance pour tous vos besoins automobiles à Québec.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt contact-icon"></i>
                                <div class="contact-text">
                                    <strong>Localisation</strong><br>
                                    Québec, QC
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-calendar-alt contact-icon"></i>
                                <div class="contact-text">
                                    <strong>Ouvert depuis</strong><br>
                                    2 mois
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-users contact-icon"></i>
                                <div class="contact-text">
                                    <strong>Équipe</strong><br>
                                    3 employés (en recrutement)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-handshake contact-icon"></i>
                                <div class="contact-text">
                                    <strong>Partenaires</strong><br>
                                    NextPart & Pièces Économiques
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="DKM Auto Garage">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Contactez-nous</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Prêt à donner une nouvelle vie à votre véhicule ?
            </p>
            
            <div class="row">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info">
                        <h3 style="color: var(--netflix-red); margin-bottom: 2rem;">Informations de contact</h3>
                        
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <div class="contact-text">
                                <strong>Adresse</strong><br>
                                Québec, QC, Canada
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <div class="contact-text">
                                <strong>Téléphone</strong><br>
                                (418) XXX-XXXX
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <div class="contact-text">
                                <strong>Email</strong><br>
                                info@dkmauto.com
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-clock contact-icon"></i>
                            <div class="contact-text">
                                <strong>Horaires</strong><br>
                                Ouvert 7 jours sur 7
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info">
                        <h3 style="color: var(--netflix-red); margin-bottom: 2rem;">Nos partenaires</h3>
                        
                        <div class="contact-item">
                            <i class="fas fa-handshake contact-icon"></i>
                            <div class="contact-text">
                                <strong>NextPart</strong><br>
                                Partenaire officiel pour pièces automobiles
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-handshake contact-icon"></i>
                            <div class="contact-text">
                                <strong>Pièces Économiques</strong><br>
                                Franchise acquise - image de marque propre
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-certificate contact-icon"></i>
                            <div class="contact-text">
                                <strong>Service certifié</strong><br>
                                Travail garanti et professionnel
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-tools contact-icon"></i>
                            <div class="contact-text">
                                <strong>7 Lifts disponibles</strong><br>
                                Équipement moderne pour service rapide
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-car"></i> DKM Auto
                </div>
                <div class="footer-links">
                    <a href="#accueil">Accueil</a>
                    <a href="#services">Services</a>
                    <a href="#a-propos">À propos</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2024 DKM Auto. Tous droits réservés. | Créé avec passion à Québec</p>
                    <p>Site web optimisé pour le référencement local et les campagnes Google/Facebook Ads</p>
                </div>
            </div>
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

        // Loading screen
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading').classList.add('hidden');
            }, 1000);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Service card hover effects
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
