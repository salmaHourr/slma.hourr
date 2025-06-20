<?php
session_start();
require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = sanitize($_POST['nom']);
    $email = sanitize($_POST['email']);
    $telephone = sanitize($_POST['telephone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = sanitize($_POST['role']);
    
    // Validation
    if (empty($nom) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Veuillez remplir tous les champs obligatoires';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez entrer une adresse email valide';
    } elseif (strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères';
    } elseif ($password !== $confirm_password) {
        $error = 'Les mots de passe ne correspondent pas';
    } elseif (!in_array($role, ['user', 'admin'])) {
        $error = 'Rôle invalide';
    } else {
        // Vérifier si l'email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = 'Cette adresse email est déjà utilisée';
        } else {
            // Hasher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insérer l'utilisateur
            $stmt = $pdo->prepare("INSERT INTO users (nom, email, telephone, password, role) VALUES (?, ?, ?, ?, ?)");
            
            if ($stmt->execute([$nom, $email, $telephone, $hashed_password, $role])) {
                $success = 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.';
            } else {
                $error = 'Erreur lors de la création du compte';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | DKM Auto</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --netflix-red: #e50914;
            --netflix-dark: #141414;
            --netflix-dark-gray: #1f1f1f;
            --netflix-light-gray: #808080;
            --netflix-white: #ffffff;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .register-container {
            background: var(--netflix-dark-gray);
            border-radius: 15px;
            padding: 3rem;
            border: 1px solid #333;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-logo {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .register-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--netflix-white);
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            color: var(--netflix-light-gray);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--netflix-white);
            font-weight: 500;
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
            width: 100%;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: var(--netflix-red);
            box-shadow: 0 0 0 0.2rem rgba(229, 9, 20, 0.25);
            color: var(--netflix-white);
            outline: none;
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

        .btn-register {
            background: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1rem;
        }

        .btn-register:hover {
            background: #f40612;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
            color: var(--netflix-white);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #dc3545;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #28a745;
        }

        .register-footer {
            text-align: center;
            margin-top: 2rem;
        }

        .register-footer a {
            color: var(--netflix-red);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-footer a:hover {
            color: #f40612;
        }

        .back-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: var(--netflix-white);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-home:hover {
            color: var(--netflix-red);
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .form-control {
            padding-right: 50px;
        }

        .password-toggle-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--netflix-light-gray);
            cursor: pointer;
            font-size: 1.1rem;
        }

        .password-toggle-btn:hover {
            color: var(--netflix-white);
        }

        .role-info {
            background: rgba(255,255,255,0.05);
            border: 1px solid #333;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .role-info h6 {
            color: var(--netflix-red);
            margin-bottom: 0.5rem;
        }

        .role-info p {
            color: var(--netflix-light-gray);
            font-size: 0.9rem;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <a href="index.php" class="back-home">
        <i class="fas fa-arrow-left"></i> Retour à l'accueil
    </a>

    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">
                <i class="fas fa-car"></i> DKM Auto
            </div>
            <h1 class="register-title">Inscription</h1>
            <p class="register-subtitle">Créez votre compte</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nom" class="form-label">
                    <i class="fas fa-user"></i> Nom complet *
                </label>
                <input type="text" class="form-control" id="nom" name="nom" 
                       placeholder="Votre nom complet" required 
                       value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email *
                </label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="votre@email.com" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="telephone" class="form-label">
                    <i class="fas fa-phone"></i> Téléphone
                </label>
                <input type="tel" class="form-control" id="telephone" name="telephone" 
                       placeholder="(418) XXX-XXXX" 
                       value="<?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="role" class="form-label">
                    <i class="fas fa-user-tag"></i> Type de compte *
                </label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Choisir un type de compte</option>
                    <option value="user" <?php echo (isset($_POST['role']) && $_POST['role'] === 'user') ? 'selected' : ''; ?>>Utilisateur</option>
                    <option value="admin" <?php echo (isset($_POST['role']) && $_POST['role'] === 'admin') ? 'selected' : ''; ?>>Administrateur</option>
                </select>
            </div>

            <div class="role-info">
                <h6><i class="fas fa-info-circle"></i> Informations sur les types de compte</h6>
                <p><strong>Utilisateur :</strong> Accès aux services et prise de rendez-vous</p>
                <p><strong>Administrateur :</strong> Accès complet au dashboard et gestion du système</p>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Mot de passe *
                </label>
                <div class="password-toggle">
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Votre mot de passe (min. 6 caractères)" required>
                    <button type="button" class="password-toggle-btn" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password" class="form-label">
                    <i class="fas fa-lock"></i> Confirmer le mot de passe *
                </label>
                <div class="password-toggle">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                           placeholder="Confirmez votre mot de passe" required>
                    <button type="button" class="password-toggle-btn" onclick="togglePassword('confirm_password')">
                        <i class="fas fa-eye" id="confirm-password-icon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus"></i> Créer mon compte
            </button>
        </form>

        <div class="register-footer">
            <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
            <p><a href="index.php">Retour à l'accueil</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(fieldId === 'password' ? 'password-icon' : 'confirm-password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Validation en temps réel
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (confirmPassword && password !== confirmPassword) {
                document.getElementById('confirm_password').style.borderColor = '#dc3545';
            } else {
                document.getElementById('confirm_password').style.borderColor = '#333';
            }
        });

        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#333';
            }
        });

        // Auto-focus sur le premier champ
        document.getElementById('nom').focus();
    </script>
</body>
</html> 