<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Grenier du Geek</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #D2691E;
            --accent: #CD853F;
            --light: #FAEBD7;
            --dark: #2F1B0C;
            --success: #228B22;
            --error: #DC143C;
            --border-radius: 10px;
            --shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(rgba(47, 27, 12, 0.7), rgba(47, 27, 12, 0.7)),
                        url('https://thumbs.dreamstime.com/b/elektroniskt-arkiv-28722028.jpgfit') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--light);
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            background: rgba(255, 253, 250, 0.95);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            color: var(--dark);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .logo h1 {
            font-size: 1.8rem;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: 1px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #d1d5db;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: rgba(250, 235, 215, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.2);
            background-color: white;
        }

        .error-message {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .status-message {
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-success {
            background-color: rgba(34, 139, 34, 0.1);
            color: var(--success);
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .status-error {
            background-color: rgba(220, 20, 60, 0.1);
            color: var(--error);
            border: 1px solid rgba(220, 20, 60, 0.2);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .hidden {
            display: none;
        }

        .additional-options {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.8rem;
            }

            .additional-options {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fas fa-book-open"></i>
                <h1>Grenier du Geek</h1>
            </div>

            <div class="login-header">
                <h2 class="login-title">Connexion à votre compte</h2>
                <p class="login-subtitle">Accédez à votre bibliothèque numérique</p>
            </div>

            {{-- Session status (success messages) --}}
            @if(session('status'))
                <div class="status-message status-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="status-message status-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Erreur :</strong>
                        <ul style="margin-left:10px">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Formulaire de connexion --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="votre@email.com">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe">
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="additional-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Se souvenir de moi</label>
                    </div>

                    {{-- Mot de passe oublié --}}
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
                    @else
                        <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>

            <div class="login-footer">
                <p>Vous n'avez pas de compte ?
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none;">Inscrivez-vous</a>
                    @else
                        <a href="#" style="color: var(--primary); text-decoration: none;">Inscrivez-vous</a>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <script>
        // Simulation d'un message d'erreur (à supprimer en production)
        document.addEventListener('DOMContentLoaded', function() {
            // Pour tester l'affichage des erreurs, décommentez les lignes ci-dessous
            /*
            const emailError = document.querySelector('.form-group:first-child .error-message');
            emailError.textContent = "L'adresse email est invalide";
            emailError.classList.remove('hidden');

            const passwordError = document.querySelector('.form-group:nth-child(2) .error-message');
            passwordError.textContent = "Le mot de passe est incorrect";
            passwordError.classList.remove('hidden');
            */
        });
    </script>
</body>
</html>
