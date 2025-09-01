<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact | Pharmacol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            blue: '#3C74A8',
                            lightblue: '#3C74A8E8',
                            dark: '#055c6e',
                        },
                        secondary: {
                            green: '#437305',
                            lightgreen: '#6b973d',
                            darkgreen: '#355a04',
                        },
                        neutral: {
                            gray: '#F3F3F3',
                            darkgray: '#6A6A6A',
                            light: '#DBDBDB'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Lexend', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.04)',
                        'button': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                    }
                }
            }
        }
    </script>
    <style>
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        .accordion-content.open {
            padding-bottom: 0.75rem;
        }
        .hero-pattern {
            background-image: url('{{ asset('images/Page contact/medicine-capsules-global-health-with-geometric-pattern-digital-remix.jpg') }}');
        }
        .transition-smooth {
            transition: all 0.3s ease;
        }
        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        input:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(67, 115, 5, 0.2);
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Header (conservé tel quel) -->
    <header>
        <!-- Bandeau top -->
        <div class="bg-gray-100 text-sm border-b border-gray-300 py-2">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row flex-wrap sm:justify-between text-gray-700 gap-2 sm:gap-0">
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-center">
                    <span><i class="fas fa-map-marker-alt text-green-700"></i> 184 rue agnan quartier djidjolé</span>
                    <span><i class="fas fa-envelope text-green-700"></i> {{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</span>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center">
                    <span>
                        <i class="fas fa-clock text-green-700"></i>
                        Lun-Ven: 7h30-12h 14h30-18h
                        <span class="hidden sm:inline"> / </span>
                    </span>
                    <span class="sm:ml-1">
                        Fermé les weekends et jours fériés
                    </span>
                </div>
            </div>
        </div>

        <!-- Header principal -->
        <div class="bg-[#3C74A8] border-b py-4">
            <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center px-6 gap-4">
                <div class="hidden md:block w-1/4"></div>
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 space-x-0 md:space-x-4 text-white w-full md:w-auto">
                    <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                        <i class="fas fa-phone text-[#3C74A8] text-lg font-bold"></i>
                    </div>
                    <div>
                        <p class="text-xs">Appeler à tout moment</p>
                        <strong class="text-sm font-bold">(+228) 22 50 75 10</strong>
                    </div>
                    <div class="hidden md:block w-px h-6 bg-white"></div>
                    <div class="relative flex items-center w-full md:w-60 lg:w-72">
                        <button onclick="toggleSearch()" class="absolute left-3">
                            <i class="fas fa-search text-[#3C74A8]"></i>
                        </button>
                        <input id="searchInput" type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500" oninput="updateSuggestions()" onkeydown="if(event.key === 'Enter') performSearch()">
                        <ul id="suggestions" class="absolute left-0 top-full w-full mt-1 bg-white text-black border border-gray-300 rounded shadow hidden z-50 text-sm max-h-60 overflow-y-auto"></ul>
                    </div>
                </div>
                <div class="flex space-x-5 text-white w-full md:w-1/4 justify-center md:justify-end mt-4 md:mt-0">
                    <a href="{{ $general['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook"></i></a>
                    <a href="{{ $general['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                    <a href="{{ $general['youtube_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

            <!-- Bandeau Prestations & navbar -->
            <div class="relative z-0 qhero-prestations bg-cover bg-center h-40 sm:h-56 md:h-72" style="background-image: url('{{ asset('images/Page contact/medicine-capsules-global-health-with-geometric-pattern-digital-remix.jpg') }}');">
            <div class="absolute inset-0 bg-black/40 z-0"></div>
            <div class="bg-white bg-opacity-100 backdrop-blur-md w-full md:w-[70%] mx-auto relative z-30">
                <nav class="relative z-20">
                    <div class="qcontainer flex justify-around items-center px-4 py-3">
                        <!-- Logo -->
                        <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                            <div class="qlogo">
                                <img src="images/Page prestations 2/logo-350100.png" alt="Logo Pharmacol" class="h-12 md:h-16">
                            </div>
                        </a>
                        <!-- Hamburger bouton mobile -->
                        <button id="menu-toggle" class="md:hidden text-[#3C74A8] text-3xl focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <!-- Menu principal -->
                        <ul id="main-menu" class="hidden md:flex qnav-links md:items-center md:space-x-10 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                            <li class="qdropdown relative group">
                                <a href="#" class="text hover:text-gray-900 flex items-center space-x-2 px-4 py-3 md:p-0">
                                    <span>Nos Implentations</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block md:mt-0 z-50">
                                    <li>
                                        <a href="{{ route('accueil.togo') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto"> Togo
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('accueil.benin') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/bj.png" alt="Benin" class="w-5 h-auto"> Benin
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('accueil.niger') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto"> Niger
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('prestation') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Prestations</a></li>
                            <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Recrutement</a></li>
                            <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                            <li><a href="{{ route('contact') }}" class="text-[#437305] hover:text-green-600 block px-4 py-3 md:p-0 font-bold">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="absolute inset-0 flex flex-col items-center justify-end pb-8 sm:justify-center sm:pb-0 text-white text-center">
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold w-full">Contact</h1>
            </div>
        </div>
        <script>
            // Menu burger responsive
            const menuToggle = document.getElementById('menu-toggle');
            const mainMenu = document.getElementById('main-menu');
            menuToggle.addEventListener('click', () => {
                mainMenu.classList.toggle('hidden');
            });

            // Dropdown mobile (ouvre/ferme au clic, referme si déjà ouvert)
            document.querySelectorAll('.qdropdown > a').forEach(drop => {
                drop.addEventListener('click', function(e) {
                    if(window.innerWidth < 768) {
                        e.preventDefault();
                        const submenu = this.nextElementSibling;
                        // Ferme si déjà ouvert, sinon ouvre et ferme les autres
                        if (!submenu.classList.contains('hidden')) {
                            submenu.classList.add('hidden');
                        } else {
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                            submenu.classList.remove('hidden');
                        }
                    }
                });
            });

            // Fermer le sous-menu si on clique ailleurs sur mobile
            document.addEventListener('click', function(e) {
                if(window.innerWidth < 768) {
                    const isDropdown = e.target.closest('.qdropdown');
                    const isMenuToggle = e.target.closest('#menu-toggle');
                    if(!isDropdown && !isMenuToggle) {
                        document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                            menu.classList.add('hidden');
                        });
                    }
                }
            });

            // Gestion du dropdown "Nos Implentations" sur desktop
            document.querySelectorAll('.qdropdown > a').forEach(drop => {
                drop.addEventListener('click', function(e) {
                    if (window.innerWidth >= 768) {
                        e.preventDefault();
                        const submenu = this.nextElementSibling;
                        submenu.classList.toggle('hidden');
                    }
                });
            });

            // Fermer le sous-menu si on clique ailleurs (desktop uniquement)
            document.addEventListener('click', function(e) {
                if (window.innerWidth >= 768) {
                    const isDropdown = e.target.closest('.qdropdown');
                    if (!isDropdown) {
                        document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                            menu.classList.add('hidden');
                        });
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', function () {
                const menuToggle = document.getElementById('menu-toggle');
                const mainMenu = document.getElementById('main-menu');

                // Burger menu
                if (menuToggle && mainMenu) {
                    menuToggle.addEventListener('click', function (e) {
                        e.stopPropagation();
                        mainMenu.classList.toggle('hidden');
                    });
                    mainMenu.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                    document.body.addEventListener('click', function () {
                        if (window.innerWidth < 768) {
                            mainMenu.classList.add('hidden');
                            // Ferme aussi tous les sous-menus
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                        }
                    });
                }

                // Dropdown mobile
                document.querySelectorAll('.qdropdown > a').forEach(drop => {
                    drop.addEventListener('click', function(e) {
                        if(window.innerWidth < 768) {
                            e.preventDefault();
                            const submenu = this.nextElementSibling;
                            // Toggle le sous-menu
                            submenu.classList.toggle('hidden');
                            // Ferme les autres sous-menus
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                if (menu !== submenu) menu.classList.add('hidden');
                            });
                        }
                    });
                });

                // Fermer le sous-menu mobile si on clique ailleurs
                document.addEventListener('click', function(e) {
                    if(window.innerWidth < 768) {
                        const isDropdown = e.target.closest('.qdropdown');
                        if(!isDropdown) {
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                        }
                    }
                });

                // Dropdown desktop
                document.querySelectorAll('.qdropdown > a').forEach(drop => {
                    drop.addEventListener('click', function(e) {
                        if (window.innerWidth >= 768) {
                            e.preventDefault();
                            const submenu = this.nextElementSibling;
                            submenu.classList.toggle('hidden');
                        }
                    });
                });

                // Fermer le sous-menu si on clique ailleurs (desktop)
                document.addEventListener('click', function(e) {
                    if (window.innerWidth >= 768) {
                        const isDropdown = e.target.closest('.qdropdown');
                        if (!isDropdown) {
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                        }
                    }
                });
            });
        </script>
    </header>

    <!-- Bouton scroll to top -->
    <button id="scrollToTopBtn" onclick="scrollToTop()" 
        class="fixed bottom-6 right-6 w-12 h-12 bg-secondary-green text-white text-xl flex items-center justify-center rounded-full shadow-button hover:bg-secondary-darkgreen transition-smooth z-50" aria-label="Remonter en haut">
        <i class="fas fa-arrow-up"></i>
    </button>

 <!-- Main content refait avec design moderne -->
<!-- Main content refait avec design moderne -->
<main class="max-w-7xl mx-auto px-4 py-12 md:py-16">
    <!-- En-tête de section -->
    <div class="text-center mb-12 md:mb-16">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Contactez-nous</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans vos projets</p>
    </div>

    <!-- Formulaire de contact et Google Maps côte à côte -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        <!-- Formulaire de contact amélioré -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">Envoyez-nous un message</h2>
            <form action="https://formspree.io/f/xzzrwanv" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Votre nom</label>
                        <input type="text" id="nom" name="nom" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#437305] focus:border-transparent transition-all" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Votre email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#437305] focus:border-transparent transition-all" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#437305] focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                        <input type="text" id="sujet" name="sujet" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#437305] focus:border-transparent transition-all">
                    </div>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Votre message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#437305] focus:border-transparent transition-all" required></textarea>
                </div>
                <button type="submit" class="bg-gradient-to-r from-[#437305] to-[#365c04] hover:from-[#365c04] hover:to-[#2a4903] text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 w-full">
                    Envoyer le message
                </button>
            </form>
        </div>

        <!-- Google Maps avec la localisation spécifique -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <iframe 
                src="https://www.google.com/maps?q=Rue+Aflao+Gakli+69,+Lom%C3%A9,+Togo&output=embed" 
                width="100%" 
                height="100%" 
                style="min-height: 400px; border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="rounded-xl">
            </iframe>
        </div>
    </div>

    <!-- Informations de contact en bas -->
    <div class="bg-gradient-to-br from-[#437305] to-[#365c04] text-white rounded-xl shadow-lg p-6 md:p-8">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center">Informations de contact</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Adresse</h3>
                <p>184 Rue Agnan<br>Quartier Djidjolé, Lomé</p>
            </div>
            
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-phone-alt text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Téléphone</h3>
                <p>(+228) 22 50 75 10</p>
            </div>
            
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Email</h3>
                <p class="break-all">{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</p>
            </div>
            
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Horaires</h3>
                <p>Lun-Ven: 7h30-12h<br>14h30-18h</p>
            </div>
        </div>
        
        <div class="flex justify-center space-x-4 pt-6 border-t border-white/20">
            <a href="{{ $general['facebook_url'] ?? '#' }}" class="w-12 h-12 bg-white text-[#437305] rounded-full flex items-center justify-center hover:bg-gray-100 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ $general['instagram_url'] ?? '#' }}" class="w-12 h-12 bg-white text-[#437305] rounded-full flex items-center justify-center hover:bg-gray-100 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="{{ $general['linkedin_url'] ?? '#' }}" class="w-12 h-12 bg-white text-[#437305] rounded-full flex items-center justify-center hover:bg-gray-100 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="{{ $general['youtube_url'] ?? '#' }}" class="w-12 h-12 bg-white text-[#437305] rounded-full flex items-center justify-center hover:bg-gray-100 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>
</main>

    <!-- Section FAQ -->
    <section class="max-w-4xl mx-auto px-4 py-12 md:py-16">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-heading font-bold mb-4">Questions fréquentes</h2>
            <p class="text-neutral-darkgray">Trouvez rapidement des réponses à vos questions</p>
        </div>

        <div class="space-y-4">
            <div class="accordion-item bg-white rounded-lg shadow-card overflow-hidden">
                <button class="accordion-toggle w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:text-secondary-green transition-smooth">
                    <span>Comment puis-je postuler à une offre d'emploi ?</span>
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
                <div class="accordion-content px-5">
                    <p class="pb-5 text-gray-600">Vous pouvez consulter nos offres d'emploi dans la section Recrutement et postuler directement en ligne en remplissant le formulaire de candidature.</p>
                </div>
            </div>

            <div class="accordion-item bg-white rounded-lg shadow-card overflow-hidden">
                <button class="accordion-toggle w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:text-secondary-green transition-smooth">
                    <span>Quels sont vos horaires d'ouverture ?</span>
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
                <div class="accordion-content px-5">
                    <p class="pb-5 text-gray-600">Nous sommes ouverts du lundi au vendredi de 7h30 à 12h et de 14h30 à 18h. Nous sommes fermés les weekends et jours fériés.</p>
                </div>
            </div>

            <div class="accordion-item bg-white rounded-lg shadow-card overflow-hidden">
                <button class="accordion-toggle w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:text-secondary-green transition-smooth">
                    <span>Dans quels pays êtes-vous présents ?</span>
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
                <div class="accordion-content px-5">
                    <p class="pb-5 text-gray-600">Nous avons des implantations au Togo, au Bénin et au Niger. Vous pouvez consulter les détails de chaque implantation dans la section dédiée.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (conservé tel quel) -->
    <footer class="bg-[#3C74A8E8] text-gray-100 relative">
        <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Bloc logo et newsletter -->
            <div class="space-y-4 relative flex flex-col items-center md:items-start">
                <div class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0"></div>
                <img src="{{ asset('images/Page contact/logo-350100.png') }}" class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
                <h2 class="text font-semibold relative z-10 text-center md:text-left text-base md:text-lg">Un réseau de délégués médicaux sur le Togo, le Bénin et le Niger</h2>
                <div class="flex w-full max-w-xs">
                    <input type="text" placeholder="Email"
                        class="w-full px-3 py-2 bg-white text-black border border-gray-600 rounded-l-md focus:outline-none" />
                    <button class="bg-[#437305] px-4 py-2 border border-[#437305] rounded-r-md">
                        <i class="fas fa-arrow-up transform rotate-45 text-white"></i>
                    </button>
                </div>
            </div>
            <!-- Liens rapides -->
            <div class="md:ml-8 flex flex-col items-center md:items-start">
                <h2 class="mb-4 font-semibold text-lg">Liens rapides</h2>
                <ul class="space-y-2 text-center md:text-left">
                    <li><a href="{{ route('accueil') }}" class="hover:underline">À propos</a></li>
                    <li><a href="{{ route('prestation') }}" class="hover:underline">Services</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:underline">Blog</a></li>
                    <li><a href="{{ route('recrutement') }}" class="hover:underline">Recrutement</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
                </ul>
            </div>
            <!-- Contact -->
            <div class="flex flex-col items-center md:items-start">
                <h2 class="mb-4 font-semibold text-lg">Contact</h2>
                <ul class="space-y-2 text-center md:text-left">
                    <li>184 rue Agnan quartier djidjolé</li>
                    <li>derrière EPP Aflao gakli</li>
                    <li>
                        <i class="fas fa-phone-alt text-[#437305]"></i>
                        <a href="tel:+22890123456" target="_blank" class="ml-1">+228 90 12 34 56</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope text-[#437305]"></i>
                        <a href="mailto:{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}" target="_blank" rel="noopener noreferrer" class="ml-1">{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</a>
                    </li>
                    <li class="flex gap-5 mt-2 justify-center md:justify-start">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </li>
                    </ul>
            </div>
            <!-- Horaires -->
            <div class="md:ml-8 flex flex-col items-center md:items-start">
                <h2 class="mb-4 font-semibold text-lg">Heures d’ouvertures</h2>
                <ul class="space-y-1 text-center md:text-left">
                    <li>Lundi : 7h30 - 18h</li>
                    <li>Mardi : 7h30 - 18h</li>
                    <li>Mercredi : 7h30 - 18h</li>
                    <li>Jeudi : 7h30 - 18h</li>
                    <li>Vendredi : 7h30 - 18h</li>
                </ul>
            </div>
        </div>
        <div class="bg-[#3C74A8] py-4 text-xs md:text-sm shadow-inner">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-y-2 px-4">
                <div class="w-full md:w-2/5 flex justify-center md:justify-end mb-2 md:mb-0">
                    <span class="text-white text-center md:text-right tracking-wide flex items-center gap-2">
                        <i class="fa-regular fa-copyright"></i>
                        Copyright Pharmacol 2025. Tous droits réservés.
                    </span>
                </div>
                <span class="hidden md:inline text-white mx-6 text-lg opacity-60">|</span>
                <div class="w-full md:w-2/5 flex justify-center md:justify-start items-center gap-4">
                    <a href="https://www.neostart.tech/" target="_blank" class="text-white hover:underline text-center md:text-left tracking-wide flex items-center gap-2 transition-all duration-200">
                        <i class="fas fa-code"></i>
                        Développé par Neo Start Technology
                    </a>
                    <a href="{{ route('admin.login') }}" class="text-white/60 hover:text-white/80 transition-all duration-200 text-xs" title="Administration">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialisation de la carte
        function initMap() {
            const lat = 6.1860;
            const lon = 1.2045;
            const map = L.map('map').setView([lat, lon], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([lat, lon])
                .addTo(map)
                .bindPopup("<b>Pharmacol</b><br>184 Rue Agnan Quartier Djidjolé, Lomé")
                .openPopup();
        }

        // Initialisation de la carte au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            
            // Fonctionnalité accordéon FAQ
            const accordionToggles = document.querySelectorAll('.accordion-toggle');
            
            accordionToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    
                    // Basculer l'élément actuel
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        content.style.paddingTop = '0';
                        content.style.paddingBottom = '0';
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        content.style.paddingTop = '1rem';
                        content.style.paddingBottom = '1rem';
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        });

        // Fonction de défilement vers le haut
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>