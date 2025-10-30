<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Chatbot - Le Grenier du Geek</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --bot-bg: #f0f9ff;
            --user-bg: #eff6ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-primary);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: var(--card-shadow);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo::before {
            content: "📚";
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.active {
            color: var(--primary);
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-greeting {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: #4338ca;
            border-color: #4338ca;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .btn-secondary:hover {
            background: #059669;
            border-color: #059669;
            transform: translateY(-1px);
        }

        .logout-form {
            display: inline;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-weight: 500;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            color: var(--primary);
        }

        /* Contenu Principal */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
            width: 100%;
        }

        /* Section Hero */
        .dashboard-hero {
            text-align: center;
            padding: 2rem 2rem 3rem;
            margin-bottom: 2rem;
        }

        .dashboard-hero h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .dashboard-hero p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Container du Chatbot */
        .chatbot-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 600px;
        }

        .chat-header {
            background: var(--primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .chat-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .chat-header p {
            opacity: 0.9;
            font-size: 0.875rem;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .message {
            max-width: 80%;
            padding: 1rem;
            border-radius: 1rem;
            position: relative;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-message {
            align-self: flex-end;
            background: var(--user-bg);
            border-bottom-right-radius: 0.25rem;
            color: var(--primary);
        }

        .bot-message {
            align-self: flex-start;
            background: var(--bot-bg);
            border-bottom-left-radius: 0.25rem;
            color: var(--text-primary);
        }

        .message-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-message .message-header {
            color: var(--primary);
        }

        .bot-message .message-header {
            color: var(--secondary);
        }

        .message-content {
            line-height: 1.5;
        }

        .source-btn {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            cursor: pointer;
            margin-top: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .source-btn:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .chat-input-container {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            background: white;
        }

        .chat-form {
            display: flex;
            gap: 1rem;
        }

        .chat-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .chat-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .send-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .send-btn:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        .send-btn:disabled {
            background: var(--text-secondary);
            cursor: not-allowed;
            transform: none;
        }

        .typing-indicator {
            display: none;
            align-self: flex-start;
            background: var(--bot-bg);
            padding: 1rem;
            border-radius: 1rem;
            border-bottom-left-radius: 0.25rem;
            color: var(--text-secondary);
            font-style: italic;
        }

        .typing-dots {
            display: inline-block;
        }

        .typing-dots span {
            animation: typing 1.4s infinite;
            opacity: 0;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% { opacity: 0; }
            30% { opacity: 1; }
        }

        /* Suggestions */
        .suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .suggestion-btn {
            background: #f1f5f9;
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .suggestion-btn:hover {
            background: #e2e8f0;
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Footer */
        .footer {
            background: #1e293b;
            color: #cbd5e1;
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer p {
            margin-bottom: 0.5rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .main-content {
                padding: 1rem;
            }

            .dashboard-hero {
                padding: 1rem 1rem 2rem;
            }

            .dashboard-hero h1 {
                font-size: 1.75rem;
            }

            .chatbot-container {
                height: 500px;
            }

            .message {
                max-width: 90%;
            }

            .chat-form {
                flex-direction: column;
            }

            .suggestions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">Le Grenier du Geek</a>
            <div class="nav-links">
                <a href="/books" class="nav-link">
                    <i class="fas fa-book"></i>
                    Catalogue
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="/forum" class="nav-link">
                        <i class="fas fa-comments"></i>
                        Forum
                    </a>
                    <a href="/chat" class="nav-link active">
                        <i class="fas fa-comment-dots"></i>
                        Chat
                    </a>
                    <div class="user-info">
                        <span class="user-greeting">Bonjour, <?php echo e(auth()->user()->full_name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                Déconnexion
                            </button>
                        </form>
                        <a href="/books/create" class="btn btn-secondary">
                            <i class="fas fa-plus"></i>
                            Soumettre
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        Connexion
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire
                    </a>
                    <a href="/books/create" class="btn btn-secondary">
                        <i class="fas fa-plus"></i>
                        Soumettre
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="main-content">
        <!-- Section Hero -->
        <section class="dashboard-hero">
            <h1>Assistant Virtuel</h1>
            <p>Posez vos questions sur nos ressources, la bibliothèque ou tout autre sujet. Notre chatbot vous aidera avec des réponses précises.</p>
        </section>

        <!-- Container du Chatbot -->
        <div class="chatbot-container">
            <div class="chat-header">
                <h2><i class="fas fa-robot"></i> Assistant du Grenier du Geek</h2>
                <p>Je peux vous aider à trouver des informations dans notre bibliothèque et sur le web</p>
            </div>
            
            <div class="messages-container" id="messages">
                <div class="message bot-message">
                    <div class="message-header">
                        <i class="fas fa-robot"></i>
                        Assistant
                    </div>
                    <div class="message-content">
                        Bonjour ! Je suis l'assistant du Grenier du Geek. Comment puis-je vous aider aujourd'hui ? 
                        Vous pouvez me poser des questions sur notre bibliothèque, nos ressources, ou tout autre sujet.
                    </div>
                </div>
            </div>
            
            <div class="typing-indicator" id="typing">
                <div class="message-header">
                    <i class="fas fa-robot"></i>
                    Assistant
                </div>
                <div class="message-content">
                    Réfléchit <span class="typing-dots"><span>.</span><span>.</span><span>.</span></span>
                </div>
            </div>
            
            <div class="chat-input-container">
                <form class="chat-form" id="chat-form">
                    <input type="text" name="question" class="chat-input" placeholder="Tapez votre question ici..." required>
                    <button type="submit" class="send-btn" id="send-btn">
                        <i class="fas fa-paper-plane"></i>
                        Envoyer
                    </button>
                </form>
                
                <div class="suggestions">
                    <button class="suggestion-btn" data-question="Quels livres avez-vous sur l'algèbre ?">Livres d'algèbre</button>
                    <button class="suggestion-btn" data-question="Comment soumettre un document ?">Soumettre un document</button>
                    <button class="suggestion-btn" data-question="Qu'est-ce que le Grenier du Geek ?">À propos</button>
                    <button class="suggestion-btn" data-question="Comment fonctionne le forum ?">Forum</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p>© <?php echo e(date('Y')); ?> Le Grenier du Geek — Tous droits réservés.</p>
            <p>Développé avec ❤️ par la communauté.</p>
            <div class="footer-links">
                <a href="/about">À propos</a>
                <a href="/contact">Contact</a>
                <a href="/privacy">Confidentialité</a>
            </div>
        </div>
    </footer>

    <script>
        const messagesDiv = document.getElementById('messages');
        const form = document.getElementById('chat-form');
        const typingIndicator = document.getElementById('typing');
        const sendBtn = document.getElementById('send-btn');

        // Fonction pour ajouter un message au chat
        function addMessage(text, isUser = false, source = null) {
            const msgDiv = document.createElement('div');
            msgDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
            
            const header = document.createElement('div');
            header.className = 'message-header';
            header.innerHTML = isUser ? 
                '<i class="fas fa-user"></i> Vous' : 
                '<i class="fas fa-robot"></i> Assistant';
            
            const content = document.createElement('div');
            content.className = 'message-content';
            content.textContent = text;
            
            msgDiv.appendChild(header);
            msgDiv.appendChild(content);
            
            if (source && !isUser) {
                const sourceBtn = document.createElement('button');
                sourceBtn.className = 'source-btn';
                sourceBtn.innerHTML = '<i class="fas fa-external-link-alt"></i> Voir la source';
                sourceBtn.onclick = () => window.open(source, '_blank');
                msgDiv.appendChild(sourceBtn);
            }
            
            messagesDiv.appendChild(msgDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        // Gestion de l'envoi du formulaire
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const question = form.elements['question'].value.trim();
            if (!question) return;

            // Ajoute le message utilisateur
            addMessage(question, true);
            form.reset();
            sendBtn.disabled = true;
            
            // Affiche l'indicateur de frappe
            typingIndicator.style.display = 'flex';
            messagesDiv.scrollTop = messagesDiv.scrollHeight;

            try {
                const res = await fetch('<?php echo e(route("chatbot.ask")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ question })
                });

                if (!res.ok) throw new Error(`Erreur: ${res.status}`);

                const data = await res.json();
                addMessage(data.answer || 'Désolé, je n\'ai pas trouvé de réponse à votre question.', false, data.source);
            } catch (error) {
                console.error(error);
                addMessage('Désolé, une erreur s\'est produite. Veuillez réessayer.', false);
            } finally {
                typingIndicator.style.display = 'none';
                sendBtn.disabled = false;
            }
        });

        // Gestion des suggestions
        document.querySelectorAll('.suggestion-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                form.elements['question'].value = btn.getAttribute('data-question');
                form.dispatchEvent(new Event('submit'));
            });
        });

        // Focus sur le champ de saisie au chargement
        document.addEventListener('DOMContentLoaded', () => {
            form.elements['question'].focus();
        });
    </script>
</body>
</html><?php /**PATH C:\Users\pc\Desktop\2G\le-grenier_du_geek\biblo\resources\views/chatbot/index.blade.php ENDPATH**/ ?>