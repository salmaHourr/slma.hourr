<?php
session_start();

// Traitement du formulaire de rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $service = $_POST['service'] ?? '';
    $date = $_POST['date'] ?? '';
    $heure = $_POST['heure'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Ici vous pouvez ajouter la logique pour sauvegarder le rendez-vous
    // Par exemple, envoi d'email, sauvegarde en base de données, etc.
    
    $success_message = "Votre demande de rendez-vous a été envoyée avec succès ! Nous vous contacterons bientôt.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre Rendez-vous | DKM Auto</title>
    <meta name="description" content="Prenez rendez-vous en ligne avec DKM Auto pour vos services automobiles à Québec">
    
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
            max-width: 600px;
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

        /* Form Section */
        .form-section {
            padding: 4rem 0;
            background: var(--netflix-dark);
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--netflix-dark-gray);
            border-radius: 15px;
            padding: 3rem;
            border: 1px solid #333;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--netflix-white);
        }

        .form-subtitle {
            text-align: center;
            color: var(--netflix-light-gray);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            color: var(--netflix-white);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            background: rgba(255,255,255,0.1);
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px 15px;
            color: var(--netflix-white);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: var(--netflix-red);
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25);
            color: var(--netflix-white);
        }

        .form-control::placeholder {
            color: var(--netflix-light-gray);
        }

        .form-select {
            background: rgba(255,255,255,0.1);
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px 15px;
            color: var(--netflix-white);
            font-size: 1rem;
        }

        .form-select:focus {
            background: rgba(255,255,255,0.15);
            border-color: var(--netflix-red);
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25);
        }

        .form-select option {
            background: var(--netflix-dark-gray);
            color: var(--netflix-white);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Netflix-style Button */
        .btn-netflix {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
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

        /* Success Message */
        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #28a745;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .service-option {
            background: rgba(255,255,255,0.05);
            border: 1px solid #333;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .service-option:hover {
            background: rgba(229, 9, 20, 0.1);
            border-color: var(--netflix-red);
            transform: translateY(-5px);
        }

        .service-option.selected {
            background: rgba(229, 9, 20, 0.2);
            border-color: var(--netflix-red);
        }

        .service-icon {
            font-size: 2rem;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .service-name {
            font-weight: 600;
            color: var(--netflix-white);
            margin-bottom: 0.5rem;
        }

        .service-price {
            color: var(--dkm-secondary);
            font-size: 0.9rem;
        }

        /* Info Section */
        .info-section {
            background: linear-gradient(135deg, var(--netflix-dark-gray) 0%, var(--netflix-dark) 100%);
            padding: 4rem 0;
        }

        .info-card {
            background: var(--netflix-dark-gray);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            border: 1px solid #333;
            margin-bottom: 2rem;
        }

        .info-icon {
            font-size: 3rem;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .info-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--netflix-white);
            margin-bottom: 1rem;
        }

        .info-description {
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
            
            .form-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .form-title {
                font-size: 2rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
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
                        <a class="nav-link" href="index.php#accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#a-propos">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Prendre Rendez-vous</h1>
                <p class="hero-subtitle">Réservez votre créneau en ligne pour nos services automobiles</p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section" id="rdv">
        <div class="container">
            <div class="form-container" data-aos="fade-up">
                <h2 class="form-title">Demande de Rendez-vous</h2>
                <p class="form-subtitle">Remplissez le formulaire ci-dessous et nous vous contacterons rapidement</p>

                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="#rdv">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-user"></i> Nom complet *
                                </label>
                                <input type="text" class="form-control" id="nom" name="nom" required 
                                       placeholder="Votre nom complet">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email *
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       placeholder="votre@email.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telephone" class="form-label">
                                    <i class="fas fa-phone"></i> Téléphone *
                                </label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required 
                                       placeholder="(418) XXX-XXXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicule" class="form-label">
                                    <i class="fas fa-car"></i> Véhicule
                                </label>
                                <input type="text" class="form-control" id="vehicule" name="vehicule" 
                                       placeholder="Marque, modèle, année">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tools"></i> Service souhaité *
                        </label>
                        <div class="services-grid">
                            <div class="service-option" data-service="changement-huile">
                                <i class="fas fa-oil-can service-icon"></i>
                                <div class="service-name">Changement d'huile</div>
                                <div class="service-price">À partir de 29.99$</div>
                            </div>
                            <div class="service-option" data-service="alignement">
                                <i class="fas fa-cogs service-icon"></i>
                                <div class="service-name">Alignement</div>
                                <div class="service-price">À partir de 39.99$</div>
                            </div>
                            <div class="service-option" data-service="carrosserie">
                                <i class="fas fa-hammer service-icon"></i>
                                <div class="service-name">Carrosserie</div>
                                <div class="service-price">Devis gratuit</div>
                            </div>
                            <div class="service-option" data-service="diagnostic">
                                <i class="fas fa-laptop service-icon"></i>
                                <div class="service-name">Diagnostic</div>
                                <div class="service-price">À partir de 49.99$</div>
                            </div>
                            <div class="service-option" data-service="moteur">
                                <i class="fas fa-cog service-icon"></i>
                                <div class="service-name">Moteur & Transmission</div>
                                <div class="service-price">Devis sur mesure</div>
                            </div>
                            <div class="service-option" data-service="pieces">
                                <i class="fas fa-box service-icon"></i>
                                <div class="service-name">Vente de pièces</div>
                                <div class="service-price">Prix compétitifs</div>
                            </div>
                        </div>
                        <input type="hidden" name="service" id="selected-service" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date" class="form-label">
                                    <i class="fas fa-calendar"></i> Date préférée *
                                </label>
                                <input type="date" class="form-control" id="date" name="date" required 
                                       min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heure" class="form-label">
                                    <i class="fas fa-clock"></i> Heure préférée *
                                </label>
                                <select class="form-select" id="heure" name="heure" required>
                                    <option value="">Choisir une heure</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">
                            <i class="fas fa-comment"></i> Description du problème / Besoins
                        </label>
                        <textarea class="form-control" id="message" name="message" rows="4" 
                                  placeholder="Décrivez votre problème ou vos besoins spécifiques..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-info-circle"></i> Urgence
                        </label>
                        <select class="form-select" name="urgence">
                            <option value="normale">Normale</option>
                            <option value="urgente">Urgente</option>
                            <option value="tres-urgente">Très urgente</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-netflix">
                        <i class="fas fa-paper-plane"></i> Envoyer ma demande
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <i class="fas fa-clock info-icon"></i>
                        <h3 class="info-title">Service 7j/7</h3>
                        <p class="info-description">Ouvert tous les jours sans rendez-vous pour les urgences</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <i class="fas fa-shield-alt info-icon"></i>
                        <h3 class="info-title">Garantie</h3>
                        <p class="info-description">Tous nos services sont garantis avec des pièces de qualité</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card">
                        <i class="fas fa-phone info-icon"></i>
                        <h3 class="info-title">Contact rapide</h3>
                        <p class="info-description">Nous vous répondons dans les 24h pour confirmer votre RDV</p>
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
                <a href="index.php#accueil">Accueil</a>
                <a href="index.php#services">Services</a>
                <a href="index.php#a-propos">À propos</a>
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

        // Service selection
        document.querySelectorAll('.service-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.service-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Update hidden input
                const serviceName = this.querySelector('.service-name').textContent;
                document.getElementById('selected-service').value = serviceName;
            });
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const selectedService = document.getElementById('selected-service').value;
            if (!selectedService) {
                e.preventDefault();
                alert('Veuillez sélectionner un service.');
                return false;
            }
        });

        // Date validation - disable past dates
        const dateInput = document.getElementById('date');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        // Auto-fill current date
        if (!dateInput.value) {
            dateInput.value = today;
        }
    </script>
</body>
</html>
