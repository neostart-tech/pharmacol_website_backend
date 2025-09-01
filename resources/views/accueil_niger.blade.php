<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pharmacol - Niger</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body {
                font-family: 'Lexend', sans-serif;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
            }
            .accordion-content.open {
                padding-bottom: 0.75rem;
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    </head>
    <body class="bg-white text-gray-800" id="Niger">
        <button id="scrollToTopBtn" onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl hidden items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50 " aria-label="Remonter en haut">↑
        </button>

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
                <div class="relative z-0 qhero-prestations bg-cover bg-center h-[500px]" style="background-image: url('images/Page accueil togo/header.png');">
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
                            <ul id="main-menu" class="hidden md:flex qnav-links md:items-center md:space-x-8 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                                <li class="qdropdown relative group">
                                    <a href="#" class="text-[#437305] hover:text-green-600 flex items-center space-x-2 px-4 py-3 md:p-0">
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
                                            <a href="{{ route('accueil.niger') }}" class="flex items-center gap-2 px-4 py-2 text-[#437305] hover:text-green-600 font-bold">
                                                <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto"> Niger
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('prestation') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Prestations</a></li>
                                <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Recrutement</a></li>
                                <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                    <div class="absolute inset-0 flex items-center justify-start text-white px-6">
                        <div class="w-1/2 max-w-xl text-center ml-12">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">PHARMACOL NIGER</h1>
                            <h2 class="text-2xl md:text-3xl font-semibold mb-4">Vous accompagne</h2><br>
                            <a href="#contact" class="inline-block bg-[#437305] hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow">Évaluer la faisabilité de votre projet</a>
                        </div>
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

        <!-- HERO SECTION -->
        <section class="bg-gradient-to-r from-[#3C74A8] to-[#14b8a6] text-white pt-20 pb-12 px-4 sm:px-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-opacity-10 bg-white rounded-full blur-3xl w-[400px] h-[400px] top-[-100px] left-[-100px]"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-3">Bienvenue chez Pharmacol Niger</h2>
                <p class="text-lg md:text-xl mb-6">
                    Ancrée au cœur du Sahel, notre agence soutient les laboratoires pharmaceutiques dans leur croissance en Afrique de l’Ouest, avec une approche résolument humaine et adaptée aux réalités locales.<br>
                    <span class="font-semibold text-[#14b8a6]">
                        {{ $general['experience'] ?? '-' }} ans d'expérience terrain
                    </span>
                </p>
                <a href="#À propos de Pharmacol Niger" class="inline-block bg-white text-[#06788f] font-semibold px-8 py-3 rounded-full shadow-md hover:bg-gray-100 transition duration-300">
                    Découvrez notre action
                </a>
            </div>
        </section>

        <!-- CHIFFRES CLÉS -->
        <section class="py-20 px-4 sm:px-6 bg-gray-50" id="Chiffres Niger">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
                <div class="transform hover:scale-105 transition">
                    <p class="text-6xl font-extrabold text-[#14b8a6]">{{ $niger['bureaux'] ?? '-' }}</p>
                    <p class="mt-3 text-gray-700">Bureaux au Niger</p>
                </div>
                <div class="transform hover:scale-105 transition">
                    <p class="text-6xl font-extrabold text-[#14b8a6]">{{ $niger['laboratoires'] ?? '-' }}</p>
                    <p class="mt-3 text-gray-700">Entreprises pharmaceutiques partenaires</p>
                </div>
                <div class="transform hover:scale-105 transition">
                    <p class="text-6xl font-extrabold text-[#14b8a6]">{{ $niger['collaborateurs'] ?? '-' }}</p>
                    <p class="mt-3 text-gray-700">Collaborateurs terrain mobilisés</p>
                </div>
            </div>
        </section>

        <!-- PRÉSENTATION -->
        <section class="py-20 px-4 sm:px-6 bg-white" id="À propos de Pharmacol Niger">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12">
                <div class="w-full md:w-1/3 mb-8 md:mb-0 md:pr-6">
                    @if(!empty($niger['equipe_image']))
                        <img src="{{ asset($niger['equipe_image']) }}" alt="Équipe Pharmacol Niger" class="rounded-lg shadow-lg w-full max-w-xs md:max-w-full mx-auto" />
                    @else
                        <img src="{{ asset('images/Page accueil niger/directeur-niger.jpg') }}" alt="Directeur / équipe Pharmacol Niger" class="rounded-lg shadow-lg w-full max-w-xs md:max-w-full mx-auto" />
                    @endif
                </div>
                <div class="w-full md:w-2/3">
                    <h2 class="text-2xl font-bold text-[#06788f] mb-6">Pharmacol Niger, une implantation stratégique</h2>
                    <p class="text-base mb-4 text-justify leading-relaxed">
                        Présente à Niamey depuis 2010, Pharmacol Niger développe une approche terrain solide au service des laboratoires. Notre engagement repose sur une parfaite connaissance du tissu sanitaire nigérien, des circuits logistiques et des exigences réglementaires.
                    </p>
                    <p class="text-base mb-4 text-justify leading-relaxed">
                        Grâce à une équipe pluridisciplinaire, nous accompagnons la mise en marché de vos produits dans un environnement en mutation, avec une attention particulière portée à l’éthique, à la qualité de service, et au respect des spécificités locales.
                    </p>
                    <p class="text-base text-justify leading-relaxed">
                        Pharmacol Niger se positionne comme votre passerelle de confiance vers un marché à fort potentiel, dans une dynamique de santé publique durable.
                    </p>
                    
                    <!-- Statistiques détaillées -->
                    <div class="mt-8 grid grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-gradient-to-r from-blue-50 to-teal-50 rounded-lg border">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-[#06788f]">{{ $niger['pharmacies'] ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Pharmacies couvertes</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-[#06788f]">{{ $niger['delegues'] ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Délégués médicaux</p>
                        </div>
                        <div class="text-center col-span-2 md:col-span-1">
                            <p class="text-2xl font-bold text-[#06788f]">{{ $niger['ville_principale'] ?? '-' }}</p>
                            <p class="text-sm text-gray-600">Siège principal</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTEXTE NIGER -->
        <section class="py-20 px-4 sm:px-6 bg-gray-100">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-10 items-start">
                <div class="md:col-span-3 w-full mb-8 md:mb-0">
                    <h2 class="text-2xl font-bold text-[#06788f] mb-6">Le contexte sanitaire au Niger</h2>
                    <p class="text-base text-gray-800 mb-6 text-justify">
                        Le Niger, vaste pays sahélien de 1,27 million de km², est un territoire en pleine transformation sanitaire. Avec une population jeune et croissante de plus de 25 millions d’habitants, les besoins en santé sont immenses et les opportunités de collaboration pharmaceutique y sont réelles.
                    </p>
                    <p class="text-base text-gray-800 mb-6 text-justify">
                        Le système de santé nigérien s’appuie sur plusieurs niveaux de soins répartis entre zones rurales et urbaines. Malgré les défis logistiques, l’État nigérien et les partenaires privés multiplient les efforts pour améliorer la couverture médicale sur l’ensemble du territoire.
                    </p>
                    <ul class="list-disc list-inside text-base text-gray-700 space-y-2">
                        <li>1 267 000 km² pour 8 régions sanitaires</li>
                        <li>Plus de 1800 structures de santé recensées</li>
                        <li>Environ 150 pharmacies et points de distribution actifs</li>
                    </ul>
                </div>
                <div class="md:col-span-2 w-full" id="Carte Niger">
                    <div class="bg-white border rounded-xl shadow-lg p-4 h-96 flex flex-col">
                        <div id="map-niger" class="rounded w-full h-64 sm:h-80 md:h-96"></div>
                        <p class="mt-2 text-center text-sm text-gray-500 italic">Carte interactive du Niger</p>
                    </div>
                </div>
            </div>
            <script>
                var mapNiger = L.map('map-niger').setView([16.0, 8.0], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                }).addTo(mapNiger);

                function loadMarkersNiger() {
                    fetch('/api/entreprises?niger=1')
                        .then(response => {
                            if (!response.ok) throw new Error("Erreur réseau");
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(marker => {
                                const lat = parseFloat(marker.latitude);
                                const lng = parseFloat(marker.longitude);
                                const nom = marker.nom;
                                const ville = marker.ville;

                                if (!isNaN(lat) && !isNaN(lng)) {
                                    L.marker([lat, lng])
                                        .addTo(mapNiger)
                                        .bindTooltip(`<div class="font-bold">${nom}</div><div class="text-xs">${ville}</div>`, {
                                            direction: 'top',
                                            offset: [-15, -10],
                                            permanent: true,
                                            className: 'leaflet-tooltip-custom'
                                        });
                                }
                            });
                        })
                        .catch(error => {
                            console.error("Erreur lors du chargement des marqueurs Niger :", error);
                        });
                }

                document.addEventListener("DOMContentLoaded", function () {
                    loadMarkersNiger();
                });
            </script>
        </section>

        <!-- MODE OPÉRATOIRE -->
        <section class="py-20 px-4 sm:px-6 bg-white">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-[#06788f] mb-12">Notre méthode au Niger</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Implémentation ciblée</h3>
                        <ul class="text-left list-disc list-inside text-gray-700">
                            <li>Cartographie sanitaire</li>
                            <li>Accords avec les autorités locales</li>
                            <li>Formation des relais terrain</li>
                        </ul>
                    </div>
                    <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Croissance accompagnée</h3>
                        <ul class="text-left list-disc list-inside text-gray-700">
                            <li>Promotion médicale proactive</li>
                            <li>Visibilité institutionnelle</li>
                            <li>Campagnes santé publique</li>
                        </ul>
                    </div>
                    <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Suivi transparent</h3>
                        <ul class="text-left list-disc list-inside text-gray-700">
                            <li>Reporting mensuel</li>
                            <li>Audits qualité réguliers</li>
                            <li>Tableaux de bord partagés</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- POURQUOI CHOISIR PHARMACOL NIGER -->
        <section class="py-20 px-4 sm:px-6 bg-[#3C74A8] text-white text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold mb-4">Pourquoi choisir Pharmacol Niger ?</h2>
                <p class="text-base mb-6 leading-relaxed">
                    Une implantation stratégique à Niamey, une équipe expérimentée sur le terrain, et une vision durable de la représentation pharmaceutique dans un pays en forte croissance sanitaire.
                </p>
                <a href="#contact" class="inline-block mt-4 bg-white text-[#3C74A8] font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition">
                    Démarrons un partenariat
                </a>
            </div>
        </section>

        <!-- RECRUTEMENT -->
        <section class="py-20 px-4 sm:px-6 bg-white" id="recrutement">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-[#06788f] mb-4">Rejoignez l’équipe Pharmacol Niger</h2>
                <p class="text-lg text-gray-700 mb-12">
                    Passion, Excellence, Impact.<br class="hidden md:inline" />
                    Si ces mots vous parlent, nous serions ravis de vous rencontrer.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 text-left">
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Délégué médical – Zone Nord</h3>
                        <p class="text-gray-700 mb-4 text-sm">Poste basé à Agadez – Candidatures ouvertes</p>
                        <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Postuler maintenant</a>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Responsable Réglementaire</h3>
                        <p class="text-gray-700 mb-4 text-sm">Niamey – Expérience requise</p>
                        <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Voir les missions</a>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Assistant(e) administratif(ve)</h3>
                        <p class="text-gray-700 mb-4 text-sm">Stage de 6 mois – Niamey</p>
                        <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Envoyer une candidature</a>
                    </div>
                </div>
                <a href="{{ route('recrutement') }}" class="inline-block px-6 py-3 bg-[#3C74A8E8] text-white font-semibold rounded-full shadow-md hover:bg-[#3C74A8] transition">Voir toutes nos offres</a>
            </div>
        </section>

        <!-- CONTACT -->
        <section class="py-20 px-4 sm:px-6 bg-gray-100" id="contact">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-[#3C74A8] mb-4">Contactez-nous</h2>
                <p class="text-lg mb-6">Intéressé par notre accompagnement ? Échangeons sur la faisabilité de votre projet au Niger.</p>
                <a href="mailto:{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}" target="_blank" rel="noopener noreferrer" class="inline-block bg-[#14b8a6] text-white px-10 py-4 rounded-full hover:bg-[#0f827d] transition">{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</a>
            </div>
        </section>

        <!-- Footer -->
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
                            <a href="{{ $general['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $general['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                            <a href="{{ $general['youtube_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
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
    </body>
</html>


