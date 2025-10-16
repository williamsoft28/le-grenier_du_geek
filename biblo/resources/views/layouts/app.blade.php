<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Grenier du Geek - Bibliothèque Numérique</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #7C3AED;
            --primary-light: #8B5CF6;
            --primary-dark: #6D28D9;
            --secondary: #06D6A0;
            --dark: #1E1B2E;
            --dark-light: #2A2540;
            --light: #F8FAFC;
            --gray: #E2E8F0;
            --text: #1E293B;
            --text-light: #64748B;
            --success: #10B981;
            --error: #EF4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--light);
            color: var(--text);
            min-height: 100vh;
        }

        /* Navigation Styles */
        .navbar {
            background: var(--dark);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .logo-icon {
            margin-right: 0.5rem;
            font-size: 1.75rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background: #05BF91;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 214, 160, 0.3);
        }

        /* Main Content Styles */
        .main-content {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            display: flex;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(123, 97, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 107, 132, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 255, 0.2) 0%, transparent 50%);
        }

        .left-panel h1 {
            font-size: 36px;
            margin-bottom: 20px;
            line-height: 1.2;
            z-index: 1;
            position: relative;
            font-weight: 700;
            color: white;
        }

        .left-panel p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 30px;
            z-index: 1;
            position: relative;
            color: white;
        }

        .features {
            list-style: none;
            margin-top: 40px;
            z-index: 1;
            position: relative;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 15px;
            color: white;
        }

        .features li::before {
            content: "";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            margin-right: 12px;
            font-size: 12px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }

        .right-panel {
            flex: 1.2;
            padding: 60px 50px;
            background: white;
            color: var(--text);
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 32px;
            color: var(--dark);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 16px;
        }

        .form-header a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .form-header a:hover {
            color: var(--primary-dark);
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: var(--text);
        }

        .input-container {
            position: relative;
        }

        input {
            width: 100%;
            padding: 16px 18px;
            border: 1.5px solid var(--gray);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: white;
            color: var(--text);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
        }

        .error-message::before {
            content: "!";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            background: var(--error);
            color: white;
            border-radius: 50%;
            margin-right: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
            color: var(--text-light);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: var(--primary-dark);
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
            }
            
            .left-panel {
                padding: 40px 30px;
            }
            
            .right-panel {
                padding: 40px 30px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .nav-links {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        /* Animation subtile pour les inputs */
        input:focus ~ .input-icon {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <span class="logo-icon">📚</span>
                Le Grenier du Geek
            </div>
            <div class="nav-links">
                <a href="/books" class="nav-link">Livres</a>
                <a href="/forum" class="nav-link">Forum</a>
                <a href="/chat" class="nav-link">Chat</a>
                <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                <a href="{{ route('books.create') }}" class="btn btn-secondary">Soumettre Document</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="left-panel">
                <h1>Rejoignez la bibliothèque numérique des passionnés</h1>
                <p>Accédez à une collection unique de ressources, livres et documents spécialisés pour les geeks et les technophiles.</p>
                
                <ul class="features">
                    <li>Collection étendue de livres techniques et de fiction</li>
                    <li>Ressources spécialisées en informatique et nouvelles technologies</li>
                    <li>Communauté active de passionnés partageant vos centres d'intérêt</li>
                    <li>Recommandations personnalisées basées sur vos préférences</li>
                </ul>
            </div>
            
            <div class="right-panel">
                <div class="form-header">
                    <h2>Créer un compte</h2>
                    <p>Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous ici</a></p>
                </div>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">Prénom</label>
                            <div class="input-container">
                                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" placeholder="Votre prénom">
                                <span class="input-icon">👤</span>
                            </div>
                            @if($errors->has('first_name'))
                                <div class="error-message">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Nom</label>
                            <div class="input-container">
                                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" placeholder="Votre nom">
                                <span class="input-icon">👤</span>
                            </div>
                            @if($errors->has('last_name'))
                                <div class="error-message">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="votre@email.com">
                            <span class="input-icon">✉️</span>
                        </div>
                        @if($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="filiere">Filière</label>
                        <div class="input-container">
                            <input id="filiere" type="text" name="filiere" value="{{ old('filiere') }}" autocomplete="filiere" placeholder="Votre domaine d'études">
                            <span class="input-icon">🎓</span>
                        </div>
                        @if($errors->has('filiere'))
                            <div class="error-message">{{ $errors->first('filiere') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="niveau_etude">Niveau d'étude</label>
                        <div class="input-container">
                            <input id="niveau_etude" type="text" name="niveau_etude" value="{{ old('niveau_etude') }}" required autocomplete="niveau-etude" placeholder="Votre niveau d'étude">
                            <span class="input-icon">📊</span>
                        </div>
                        @if($errors->has('niveau_etude'))
                            <div class="error-message">{{ $errors->first('niveau_etude') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="universite">Université</label>
                        <div class="input-container">
                            <input id="universite" type="text" name="universite" value="{{ old('universite') }}" autocomplete="universite" placeholder="Votre établissement">
                            <span class="input-icon">🏛️</span>
                        </div>
                        @if($errors->has('universite'))
                            <div class="error-message">{{ $errors->first('universite') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-container">
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Créez un mot de passe sécurisé">
                            <span class="input-icon">🔒</span>
                        </div>
                        @if($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <div class="input-container">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                            <span class="input-icon">🔒</span>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>
                    
                    <button type="submit" class="submit-btn">S'inscrire</button>
                </form>
                
                <div class="login-link">
                    Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous ici</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>