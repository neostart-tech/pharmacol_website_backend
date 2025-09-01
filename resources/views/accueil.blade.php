<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pharmacol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
        La pérennité de Pharmacol {{ $general['annees_experience'] ?? '-' }} ans d'expertise et de présence terrain          body {
 font-family: 'Lexend',
        sans-serif;
        }
    </style>
</head>

<button id="scrollToTopBtn" onclick="scrollToTop()"
    class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl hidden items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50"
    aria-label="Remonter en haut">↑
</button>

<body class="bg-white text-gray-800">
    <a href="connexion.php"></a>
    <header>
        <!-- Bandeau top -->
        <div id="Accueil" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
            <div
                class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row flex-wrap sm:justify-between text-gray-700 gap-2 sm:gap-0">
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-center">
                    <span><i class="fas fa-map-marker-alt text-green-700"></i> 184 rue agnan quartier djidjolé</span>
                    <span><i class="fas fa-envelope text-green-700"></i>
                        {{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</span>
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
                <!-- Espace gauche vide sur desktop -->
                <div class="hidden md:block w-1/4"></div>
                <!-- Bloc central : téléphone + recherche -->
                <div
                    class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 space-x-0 md:space-x-4 text-white w-full md:w-auto">
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
                        <input id="searchInput" type="text" placeholder="Rechercher..."
                            class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            oninput="updateSuggestions()" onkeydown="if(event.key === 'Enter') performSearch()">
                        <ul id="suggestions"
                            class="absolute left-0 top-full w-full mt-1 bg-white text-black border border-gray-300 rounded shadow hidden z-50 text-sm max-h-60 overflow-y-auto">
                        </ul>
                    </div>
                </div>
                <!-- Réseaux sociaux : en dessous sur mobile, à droite sur desktop -->
                <div class="flex space-x-5 text-white w-full md:w-1/4 justify-center md:justify-end mt-4 md:mt-0">
                    <a href="{{ $general['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                            class="fab fa-facebook"></i></a>
                    <a href="{{ $general['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                            class="fab fa-instagram"></i></a>
                    <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                            class="fab fa-linkedin"></i></a>
                    <a href="{{ $general['youtube_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                            class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Bandeau Prestations & navbar responsive -->
        <div class="relative z-0 qhero-prestations bg-cover bg-center h-[700px]"
            style="background-image: url('{{ asset('images/Page index/side-view-researcher-biotechnology-laboratory-with-plant-test-tube.jpg') }}');">

            <div class="bg-white bg-opacity-100 backdrop-blur-md w-full md:w-[70%] mx-auto relative z-30">
                <nav class="relative z-20">
                    <div class="qcontainer flex justify-around items-center px-4 py-3">
                        <!-- Logo -->
                        <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                            <div class="qlogo">
                                <img src="{{ asset('images/Page prestations 2/logo-350100.png') }}" alt="Logo Pharmacol"
                                    class="h-12 md:h-16">
                            </div>
                        </a>
                        <!-- Hamburger bouton mobile -->
                        <button id="menu-toggle" class="md:hidden text-[#3C74A8] text-3xl focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <!-- Menu principal -->
                        <ul id="main-menu"
                            class="hidden md:flex qnav-links md:items-center md:space-x-10 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                            <li class="qdropdown relative group">
                                <a href="#"
                                    class="text hover:text-gray-900 flex items-center space-x-2 px-4 py-3 md:p-0">
                                    <span>Nos Implentations</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul
                                    class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block md:mt-0 z-50">
                                    <li>
                                        <a href="{{ route('accueil.togo') }}"
                                            class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto">
                                            Togo
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('accueil.benin') }}"
                                            class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/bj.png" alt="Benin" class="w-5 h-auto">
                                            Benin
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('accueil.niger') }}"
                                            class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                            <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto">
                                            Niger
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('prestation') }}"
                                    class="text-gray-90 hover:text-green-600 block px-4 py-3 md:p-0">Prestations</a>
                            </li>
                            <li><a href="{{ route('recrutement') }}"
                                    class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Recrutement</a>
                            </li>
                            <li><a href="{{ route('blog') }}"
                                    class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Contact</a></li>
                        </ul>
                    </div>
                </nav>
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
                        if (window.innerWidth < 768) {
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
                    if (window.innerWidth < 768) {
                        const isDropdown = e.target.closest('.qdropdown');
                        const isMenuToggle = e.target.closest('#menu-toggle');
                        if (!isDropdown && !isMenuToggle) {
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

                document.addEventListener('DOMContentLoaded', function() {
                    const menuToggle = document.getElementById('menu-toggle');
                    const mainMenu = document.getElementById('main-menu');

                    // Burger menu
                    if (menuToggle && mainMenu) {
                        menuToggle.addEventListener('click', function(e) {
                            e.stopPropagation();
                            mainMenu.classList.toggle('hidden');
                        });
                        mainMenu.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                        document.body.addEventListener('click', function() {
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
                            if (window.innerWidth < 768) {
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
                        if (window.innerWidth < 768) {
                            const isDropdown = e.target.closest('.qdropdown');
                            if (!isDropdown) {
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

            <div class="absolute inset-0 flex flex-col gap-20 items-center justify-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold text-center">PHARMACOL, un réseau de <br> délégués médicaux
                    sur le Togo, <br> le Bénin , le Niger</h1>
                <a href="mailto:{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}" target="_blank"
                    rel="noopener noreferrer" class="bg-[#437305] p-4">Parlons de votre projet</a>
            </div>
        </div>
    </header>


    <!-- Contenu page index -->
    <section id ="À propos de nous" class="flex items-center justify-center relative mb-40">

        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mx-auto relative md:absolute md:top-[-100px] left-0 right-0">
            <div
                class="w-full md:w-[400px] h-[200px] bg-white flex flex-row py-8 px-6 md:px-10 gap-5 border-solid border-[1px] border-gray-200 mx-auto">
                <img src="{{ asset('images/Page index/chemistry1.png') }}" class="w-14 h-14" />
                <div class="flex flex-col gap-5">
                    <div class="font-bold text-base md:text-[20px]">Derniers équipements</div>
                    <div class="font-extralight text-base md:text-lg">Nos laboratoires disposent d’équipements modernes
                        pour développer et fournir des médicaments fiables.</div>
                </div>
            </div>

            <div
                class="w-full md:w-[400px] h-[200px] bg-[#437305] flex flex-row py-8 px-6 md:px-10 gap-5 text-white mx-auto">
                <img src="images/Page index/research1.png" class="w-14 h-14" />
                <div class="flex flex-col gap-5">
                    <div class="font-bold text-base md:text-[20px]">Recrutement des forces de ventes</div>
                    <div class="font-extralight text-base md:text-lg">Le pilier de la stratégie d’implantation : une
                        équipe professionnelle</div>
                </div>
            </div>

            <div
                class="w-full md:w-[400px] h-[200px] bg-white flex flex-row py-8 px-6 md:px-10 gap-5 border-solid border-[1px] border-gray-200 mx-auto">
                <img src="images/Page index/safe.png" class="w-14 h-14" />
                <div class="flex flex-col gap-5">
                    <div class="font-bold text-base md:text-[20px]">Promotion Médicale</div>
                    <div class="font-extralight text-base md:text-lg">Le merchandising et la formation des équipes
                        officinales</div>
                </div>
            </div>
        </div>

    </section>

    <section id="apropos" class="py-20 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl">

            <!-- En-tête centré -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-[#437305] font-semibold text-lg uppercase tracking-wider mb-3 block">
                    À PROPOS DE NOUS
                </span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                    Promotion de vos produits pharmaceutiques en Afrique de l'Ouest
                </h2>
                <p class="text-lg text-gray-600">
                    Notre expertise au service de votre succès au Togo, Bénin et Niger
                </p>
            </div>

            <!-- Contenu en deux colonnes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                <!-- Colonne texte - Transformée en carte design -->
                <div
                    class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 md:p-10 border border-gray-100 hover:shadow-2xl transition-all duration-300">
                    <div class="prose prose-lg text-gray-600 max-w-none">
                        <p class="mb-6 leading-relaxed text-lg md:text-xl">Fondée en 1996 par Abel ACOLATSE, PHARMACOL
                            est une agence spécialisée dans la représentation pharmaceutique et la promotion médicale.
                            Présente au Togo, au Bénin et au Niger, notre siège est basé à Lomé, Togo.</p>
                        <p class="mb-6 leading-relaxed text-lg md:text-xl">PHARMACOL, votre levier de croissance : nous
                            vous accompagnons dans toutes les étapes de votre développement local, depuis l'obtention
                            des autorisations de mise sur le marché, la mise en place et la commercialisation de
                            produits, jusqu'au renforcement et à l'expansion de votre présence locale.</p>
                        <p class="mb-8 leading-relaxed text-lg md:text-xl">Notre mission : Offrir un accompagnement
                            stratégique, fiable et efficace pour favoriser le succès durable de nos partenaires dans la
                            région.</p>
                    </div>

                    <!-- Séparateur -->
                    <div class="border-t border-gray-200 my-8"></div>

                    <!-- Bloc satisfaction -->
                    <div class="flex items-start gap-5 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="bg-[#437305]/10 p-3 rounded-full flex-shrink-0">
                            <img src="{{ asset('images/Page index/vector.png') }}" class="w-6 h-6"
                                alt="Satisfaction" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Satisfaction à 100 % Précision</h3>
                            <p class="text-gray-600">Nos laboratoires et équipes qualifiées assurent des services
                                précis et fiables, pour votre entière satisfaction.</p>
                        </div>
                    </div>
                </div>

                <!-- Colonne image -->
                <div class="relative w-full">
                    <div class="rounded-2xl overflow-hidden shadow-xl mb-8">
                        <img src="{{ asset('images/Page index/image3.png') }}" alt="À propos de Pharmacol"
                            class="w-full h-auto object-cover" />
                    </div>

                    <!-- Carte contact avec espacement ajouté -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-5 mt-6">
                        <div class="flex items-center gap-4">
                            <div class="bg-[#437305]/10 p-3 rounded-full">
                                <img src="{{ asset('images/Page index/chat.png') }}" class="w-8 h-8"
                                    alt="Contact" />
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Appel aux questions</p>
                                <p class="font-bold text-gray-800">+228 22 50 75 10</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton dans la colonne image -->
                    <a href="#"
                        class="inline-flex items-center justify-center bg-[#437305] hover:bg-[#365c04] text-white font-medium py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg gap-3 w-full text-center mt-6 mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Télécharger notre plaquette</span>
                    </a>

                </div>

            </div>
        </div>
    </section>


    <!-- Section Services -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="{{ asset('images/Page prestations 1/adn.png') }}" alt="ADN" class="w-10 h-10">
                    <span class="text-[#437305] uppercase tracking-widest font-medium text-2xl">Nos services</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-[#3C74A8] mb-4">Notre expertise et savoir-faire à votre
                    disposition</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Découvrez l'ensemble de nos services conçus pour répondre à
                    tous vos besoins pharmaceutiques en Afrique de l'Ouest</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/1v.png') }}" alt="Promotion médicale"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Promotion médicale Parapharmaceutique
                    </h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Sensibilisation et information des
                        professionnels santé.</p>
                </div>

                <!-- Service 2 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/2b.png') }}" alt="Recrutement"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Recrutement Encadrement de la force de
                        vente</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Talents commerciaux recrutés et encadrés
                        efficacement.</p>
                </div>

                <!-- Service 3 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/3v.png') }}" alt="Représentation"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Représentation pharmaceutique</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Valorisation et suivi des produits
                        pharmaceutiques.</p>
                </div>

                <!-- Service 4 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/4v.png') }}" alt="Règlementation"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Règlementation, autorisation de mise sur
                        le marché</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Respect des normes pour mise sur marché
                        efficace.</p>
                </div>

                <!-- Services supplémentaires (grille 2ème ligne) -->
                <!-- Service 5 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/5v.png') }}" alt="Marketing"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Marketing Communication</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Promotion stratégique et visibilité
                        optimale des produits.</p>
                </div>

                <!-- Service 6 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/6v.png') }}" alt="Étude"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Étude de faisabilité Consulting</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Analyses stratégiques et conseils
                        personnalisés performants.</p>
                </div>

                <!-- Service 7 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/7v.png') }}" alt="Reporting"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Reporting Pharmacovigilance</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Analyse et reporting des événements
                        indésirables médicaux.</p>
                </div>

                <!-- Service 8 -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center card-hover group hover:bg-[#437305] transition-colors duration-300">
                    <div
                        class="bg-[#437305] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 p-4 rounded-full w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/8v.png') }}" alt="Veille"
                            class="w-10 h-10 group-hover:invert" />
                    </div>
                    <h3 class="font-bold text-lg mb-3 group-hover:text-white">Veille concurentielle</h3>
                    <p class="text-gray-600 text-sm group-hover:text-white">Analyse régulière du marché et concurrents.
                    </p>
                </div>
            </div>
        </div>
    </section>




        <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="images/Page prestations 1/adn.png" alt="ADN" class="w-10 h-10">
                    <span class="text-[#437305] uppercase tracking-widest font-medium text-2xl">Notre processus de travail</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-[#3C74A8] mb-4">Une approche structurée pour des résultats optimaux</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Notre méthodologie éprouvée garantit l'efficacité et la qualité de nos services</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <!-- Ligne de connexion (desktop seulement) -->
                <div class="hidden md:block absolute left-0 right-0 top-20 h-0.5 bg-gray-200 z-0"></div>
                
                <!-- Étape 1 -->
                <div class="flex flex-col items-center text-center relative z-10" data-aos="fade-up">
                    <div class="bg-[#437305] text-white hexagon w-20 h-20 flex items-center justify-center mb-6">
                        <span class="text-xl font-bold">01</span>
                    </div>
                    <h3 class="font-bold text-lg mb-3">Brief et Projet Clients</h3>
                    <p class="text-gray-600 text-sm">Analyse approfondie des besoins pour une stratégie personnalisée</p>
                </div>
                
                <!-- Étape 2 -->
                <div class="flex flex-col items-center text-center relative z-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-[#437305] text-white hexagon w-20 h-20 flex items-center justify-center mb-6">
                        <span class="text-xl font-bold">02</span>
                    </div>
                    <h3 class="font-bold text-lg mb-3">Le laboratoire élabore une proposition</h3>
                    <p class="text-gray-600 text-sm">Conception de solutions innovantes adaptées à vos objectifs spécifiques</p>
                </div>
                
                <!-- Étape 3 -->
                <div class="flex flex-col items-center text-center relative z-10" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-[#437305] text-white hexagon w-20 h-20 flex items-center justify-center mb-6">
                        <span class="text-xl font-bold">03</span>
                    </div>
                    <h3 class="font-bold text-lg mb-3">Tests Début des tests</h3>
                    <p class="text-gray-600 text-sm">Lancement et évaluation pour garantir la performance optimale</p>
                </div>
                
                <!-- Étape 4 -->
                <div class="flex flex-col items-center text-center relative z-10" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-[#437305] text-white hexagon w-20 h-20 flex items-center justify-center mb-6">
                        <span class="text-xl font-bold">04</span>
                    </div>
                    <h3 class="font-bold text-lg mb-3">Rapports livrés</h3>
                    <p class="text-gray-600 text-sm">Présentation de résultats détaillés pour une prise de décision éclairée</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Section Statistiques -->
    <section class="py-16 md:py-24 bg-cover bg-center bg-fixed relative"
        style="background-image: url('{{ asset('images/Page index/portrait-female-pharmacist-working-drugstore.jpg') }}');">
        <div class="absolute inset-0 bg-[#3C74A8] bg-opacity-90"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Pharmacol en chiffres</h2>
                <p class="text-white text-opacity-80 max-w-3xl mx-auto">Notre présence et notre impact à travers
                    l'Afrique de l'Ouest</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 text-center text-white stat-card border border-white border-opacity-20">
                    <div
                        class="bg-white bg-opacity-10 p-4 rounded-full w-16 h-16 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/10.png') }}" alt="Pays" class="w-8 h-8" />
                    </div>
                 <div class="text-4xl font-bold mb-2 count-up" data-count="{{ $general['pays_couverts'] ?? 3 }}">3

                    {{-- <div class="text-4xl font-bold mb-2 count-up" data-count="{{ $general['pays_couverts'] ?? 3 }}">0 --}}
                    </div>
                    <div class="text-sm font-medium">Pays couverts</div>
                </div>

                <!-- Stat 2 -->
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 text-center text-white stat-card border border-white border-opacity-20">
                    <div
                        class="bg-white bg-opacity-10 p-4 rounded-full w-16 h-16 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/11.png') }}" alt="Collaborateurs" class="w-8 h-8" />
                    </div>
                    <div class="text-4xl font-bold mb-2 count-up" data-count="103">103</div>

                    {{-- <div class="text-4xl font-bold mb-2 count-up" data-count="{{ $collaborateurs }}">0</div> --}}
                    <div class="text-sm font-medium">Collaborateurs terrain mobilisés</div>
                </div>

                <!-- Stat 3 -->
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 text-center text-white stat-card border border-white border-opacity-20">
                    <div
                        class="bg-white bg-opacity-10 p-4 rounded-full w-16 h-16 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/12.png') }}" alt="Partenaires" class="w-8 h-8" />
                    </div>
                <div class="text-4xl font-bold mb-2 count-up" data-count="{{  7 }}">7</div>

                    {{-- <div class="text-4xl font-bold mb-2 count-up" data-count="{{ $laboratoires }}">0</div> --}}
                    <div class="text-sm font-medium">Entreprises pharmaceutiques partenaires</div>
                </div>

                <!-- Stat 4 -->
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 text-center text-white stat-card border border-white border-opacity-20">
                    <div
                        class="bg-white bg-opacity-10 p-4 rounded-full w-16 h-16 mx-auto mb-5 flex items-center justify-center">
                        <img src="{{ asset('images/Page index/13.png') }}" alt="Expérience" class="w-8 h-8" />
                    </div>
                    <div class="text-4xl font-bold mb-2">+<span class="count-up"
                            data-count="{{ $general['annees_experience'] ?? 29 }}">29</span></div>
                    {{-- <div class="text-4xl font-bold mb-2">+<span class="count-up"
                            data-count="{{ $general['annees_experience'] ?? 28 }}">0</span></div> --}}
                    <div class="text-sm font-medium">Années d'expérience</div>
                </div>
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center bg-white text-[#3C74A8] hover:bg-gray-100 font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span>Découvrir notre expertise</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- Script pour l'animation des compteurs -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des compteurs
            const counters = document.querySelectorAll('.count-up');
            const speed = 2000; // Plus la valeur est basse, plus c'est rapide

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const count = +counter.innerText;
                const increment = Math.ceil(target / speed);

                function updateCount() {
                    if (count < target) {
                        counter.innerText = Math.min(count + increment, target);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                }

                // Démarrer l'animation lorsque l'élément est dans le viewport
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCount();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(counter);
            });
        });
    </script>

    <!-- Section Pourquoi nous choisir -->

    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="inline-block text-[#437305] font-semibold uppercase tracking-wider text-gray-800 mb-4  ">
                    Pourquoi nous choisir
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Une maîtrise parfaite de l'écosystème sanitaire
                </h2>
                <p class="text-gray-600 text-lg">
                    Expertise en réglementation pharmaceutique au Togo, Bénin et Niger
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-stretch">
                <!-- Image Column -->
                <div class="h-full flex flex-col" data-aos="fade-right">
                    <div class="h-full rounded-2xl overflow-hidden shadow-xl flex-1 flex">
                        <img class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                            src="images/Page index/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg"
                            alt="Expertise Pharmacol en Afrique de l'Ouest">
                    </div>
                </div>

                <!-- Content Column -->
                <div class="flex flex-col h-full" data-aos="fade-left">
                    <!-- Values Card -->
                    <div class="bg-[#437305] rounded-2xl p-6 md:p-8 text-white shadow-lg mb-8">
                        <div class="flex flex-col md:flex-row items-center gap-6">
                            <div class="flex-shrink-0 bg-black/20 p-4 rounded-2xl">
                                <img src="images/Page index/14.png" alt="Nos valeurs"
                                    class="w-12 h-12 md:w-16 md:h-16">
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="text-xl md:text-2xl font-bold mb-2">Nos valeurs</h3>
                                <p>
                                    Réactivité, adaptabilité, rigueur et transparence font partie intégrantes de notre
                                    leitmotiv
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Advantages List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        <div
                            class="flex items-start gap-4 p-5 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 bg-[#437305]/10 p-2 rounded-full">
                                <img src="images/Page index/tick.png" alt="Check" class="w-5 h-5">
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Expertise confirmée</h4>
                                <p class="text-gray-600 text-sm">
                                    La pérennité de Pharmacol 28 ans d'expertise et de présence terrain
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-5 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 bg-[#437305]/10 p-2 rounded-full">
                                <img src="images/Page index/tick.png" alt="Check" class="w-5 h-5">
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Équipe qualifiée</h4>
                                <p class="text-gray-600 text-sm">
                                    Une force de vente composée de 50 délégués médicaux compétents et expérimentés
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-5 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 bg-[#437305]/10 p-2 rounded-full">
                                <img src="images/Page index/tick.png" alt="Check" class="w-5 h-5">
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Outils modernes</h4>
                                <p class="text-gray-600 text-sm">
                                    Des moyens et outils d'aide à la vente de dernière génération
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-5 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 bg-[#437305]/10 p-2 rounded-full">
                                <img src="images/Page index/tick.png" alt="Check" class="w-5 h-5">
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Réseau étendu</h4>
                                <p class="text-gray-600 text-sm">
                                    Une maîtrise parfaite du réseau des structures sanitaires et pharmaceutiques
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Country Buttons -->
                    <div class="mt-auto">
                        <p class="text-gray-600 text-sm mb-4 text-center md:text-left">Découvrez notre présence dans
                            chaque pays :</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                            <a href="#"
                                class="flex items-center justify-center gap-2 bg-[#437305] hover:bg-[#365c04] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                <img src="https://flagcdn.com/w20/tg.png" alt="Togo" class="w-5 h-5 rounded-sm">
                                <span>Togo</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center gap-2 bg-[#437305] hover:bg-[#365c04] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                <img src="https://flagcdn.com/w20/bj.png" alt="Bénin" class="w-5 h-5 rounded-sm">
                                <span>Bénin</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center gap-2 bg-[#437305] hover:bg-[#365c04] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                <img src="https://flagcdn.com/w20/ne.png" alt="Niger" class="w-5 h-5 rounded-sm">
                                <span>Niger</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section bleue principale - Version améliorée -->
    <section class="bg-[#31689B] text-white py-12 md:py-16 px-4 md:px-8 relative overflow-hidden">
        <!-- Éléments décoratifs -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-10% left-5% w-40 h-40 rounded-full bg-white"></div>
            <div class="absolute bottom-10% right-5% w-32 h-32 rounded-full bg-white"></div>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8 relative z-10">
            <!-- Texte principal -->
            <div class="max-w-3xl text-center md:text-left w-full md:w-auto">
                <div class="text-xs md:text-sm tracking-widest uppercase mb-3 opacity-80 font-semibold">Intégrer
                    Pharmacol</div>
                <h2 class="text-xl md:text-3xl lg:text-4xl font-bold leading-snug mb-2">
                    Vous souhaitez assurer l'information médicale et promouvoir les produits pharmaceutiques et leur bon
                    usage dans le respect de l'éthique auprès des professionnels de santé de votre zone géographique
                </h2>
                <div class="h-1 w-16 bg-white/30 rounded-full mt-5 mx-auto md:mx-0"></div>
            </div>

            <!-- Bouton avec design amélioré -->
            <div class="flex w-full md:w-auto justify-center md:justify-end items-center">
                <a href="{{ route('recrutement') }}"
                    class="bg-white text-[#31689B] px-8 py-3 md:px-10 md:py-4 font-semibold shadow-lg hover:shadow-xl transition-all duration-300 rounded-lg text-lg md:text-xl text-center w-full md:w-auto hover:-translate-y-1 transform">
                    Nous rejoindre
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Section des cartes -->
    <div class="bg-white py-16 px-4 md:px-8">
        <div class="w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 relative">

            <!-- Card 1 -->
            <a href="{{ route('recrutement') }}"
                class="bg-white shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 p-6 flex-1 border border-gray-100 relative w-full mb-8 md:mb-0 rounded-2xl group opacity-0 animate-fade-slide">

                <!-- Icône -->
                <div
                    class="w-16 h-16 md:w-20 md:h-20 absolute -top-8 left-6 flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-200 to-blue-50 shadow-md group-hover:scale-110 transition-transform duration-500">
                    <img src="images/Page index/icon1.png" alt="Délégués" class="w-10 md:w-12 object-contain" />
                </div>

                <!-- Titre -->
                <h3
                    class="text-lg md:text-xl font-semibold mb-3 text-[#31689B] pt-10 md:pt-12 group-hover:text-blue-700 transition-colors duration-300">
                    Des délégués de terrains
                </h3>

                <!-- Texte -->
                <p class="text-gray-600 text-xs md:text-sm leading-relaxed">
                    Chargé de représenter l’entreprise directement auprès des partenaires, clients ou structures
                    locales, le délégué sur le terrain assure la coordination, le suivi et la mise en œuvre des actions
                    sur le terrain. Il est le lien essentiel entre le siège et les réalités locales.
                </p>
            </a>

            <!-- Card 2 -->
            <a href="{{ route('recrutement') }}"
                class="bg-white shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 p-6 flex-1 border border-gray-100 relative w-full rounded-2xl group opacity-0 animate-fade-slide [animation-delay:0.2s]">

                <!-- Icône -->
                <div
                    class="w-16 h-16 md:w-20 md:h-20 absolute -top-8 left-6 flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-200 to-blue-50 shadow-md group-hover:scale-110 transition-transform duration-500">
                    <img src="images/Page index/icon2.png" alt="Assistants" class="w-10 md:w-12 object-contain" />
                </div>

                <!-- Titre -->
                <h3
                    class="text-lg md:text-xl font-semibold mb-3 text-[#31689B] pt-10 md:pt-12 group-hover:text-blue-700 transition-colors duration-300">
                    Des assistants médicaux
                </h3>

                <!-- Texte -->
                <p class="text-gray-600 text-xs md:text-sm leading-relaxed">
                    L’assistant médical accompagne les professionnels de santé dans la gestion administrative et la
                    préparation des consultations. Il facilite le parcours du patient en assurant l’accueil, la prise de
                    rendez-vous et la saisie des dossiers médicaux.
                </p>
            </a>

        </div>
    </div>

<!-- Animations personnalisées -->
<style>
@keyframes fade-slide {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-slide {
  animation: fade-slide 0.8s ease-out forwards;
}
</style>


    <!-- Section blog -->
    <section class="py-16 bg-[#f7fafc] flex flex-col items-center" id="blog-home">
        <div class="w-full max-w-3xl px-2">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-[#31689B] mb-2">Dernier article du blog</h2>
            <div class="text-center text-gray-500 mb-6 text-sm md:text-base">
                Découvrez nos actualités, conseils et analyses sur la promotion pharmaceutique en Afrique de l’Ouest.
            </div>
            @php
                $dernierArticle = \App\Models\Blog::whereIn('etat', ['en ligne', 'les 2'])
                    ->orderBy('date', 'desc')
                    ->first();
            @endphp

            @if ($dernierArticle)
                <a href="{{ route('blog') }}"
                    class="block group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 cursor-pointer max-w-2xl mx-auto">
                    @if ($dernierArticle->image)
                        <div class="relative">
                            <img src="{{ asset($dernierArticle->image) }}" alt="{{ $dernierArticle->titre }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <span
                                class="absolute top-2 left-2 bg-[#437305] text-white text-[10px] px-2 py-0.5 rounded-full shadow">Nouveau</span>
                        </div>
                    @endif
                    <div class="p-4 flex flex-col gap-3">
                        <h3
                            class="text-lg md:text-xl font-bold text-[#31689B] mb-1 group-hover:text-[#437305] transition-colors duration-300">
                            {{ $dernierArticle->titre }}
                        </h3>
                        <div class="flex items-center gap-2 text-gray-500 text-xs mb-2">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($dernierArticle->date)->format('d/m/Y') }}
                        </div>
                        <p class="text-gray-700 text-xs md:text-sm line-clamp-3 mb-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($dernierArticle->texte), 120) }}
                        </p>
                        <div
                            class="mt-1 text-[#437305] font-semibold group-hover:underline flex items-center gap-2 text-xs md:text-sm">
                            Lire plus <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            @else
                <div class="text-gray-400 text-center text-base">Aucun article disponible pour le moment.</div>
            @endif
        </div>
    </section>

    <!-- partenaire -->
    <section class="bg-white py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-4xl font-bold text-center text-blue-400 mb-8 md:mb-12">Nos partenaires</h2>
            @if ($partenaires->count() > 0)
                <div class="relative">
                    <div class="overflow-hidden">
                        <div id="partenaires-slider"
                            class="flex items-center justify-start transition-transform duration-500 ease-in-out"
                            style="will-change: transform;">
                            @php
                                $p = $partenaires->toArray();
                                $count = count($p);
                            @endphp
                            @foreach ($p as $i => $partenaire)
                                <div class="flex-none w-1/3 partenaire-slide">
                                    <a href="{{ $partenaire['lien'] ?? '#' }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="block group transition-transform duration-300 hover:scale-105"
                                        title="{{ $partenaire['nom'] ?? '' }}">
                                        <div
                                            class="bg-white p-6 rounded-lg shadow-md border border-gray-200 h-32 flex items-center justify-center hover:shadow-lg transition-shadow duration-300">
                                            <img src="{{ asset($partenaire['image'] ?? '') }}"
                                                alt="{{ $partenaire['nom'] ?? '' }}"
                                                class="max-h-20 max-w-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300" />
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($count > 1)
                        <button id="prev-btn"
                            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-10 h-10 bg-[#3C74A8] text-white rounded-full hover:bg-[#2a5a8a] transition-colors duration-300 flex items-center justify-center shadow-lg z-10">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="next-btn"
                            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-10 h-10 bg-[#3C74A8] text-white rounded-full hover:bg-[#2a5a8a] transition-colors duration-300 flex items-center justify-center shadow-lg z-10">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            @else
                <div class="text-center text-gray-500 py-8">
                    <p>Aucun partenaire à afficher pour le moment.</p>
                </div>
            @endif
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.getElementById('partenaires-slider');
                const slides = slider ? slider.querySelectorAll('.partenaire-slide') : [];
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');
                let current = 0;
                const total = slides.length;
                const visible = 3;
                // Corrige le centrage et le blocage pour que le premier et le dernier soient bien visibles
                function updateSlider(animate = true) {
                    if (total <= visible) {
                        slider.style.transform = 'translateX(0)';
                        if (prevBtn) prevBtn.disabled = true;
                        if (nextBtn) nextBtn.disabled = true;
                        if (prevBtn) prevBtn.style.opacity = '0.5';
                        if (nextBtn) nextBtn.style.opacity = '0.5';
                        return;
                    }
                    // Blocage classique : premier groupe aligné à gauche, dernier à droite
                    if (current < 0) current = 0;
                    if (current > total - visible) current = total - visible;
                    const slide = slides[0];
                    const style = window.getComputedStyle(slide);
                    const marginLeft = parseInt(style.marginLeft) || 0;
                    const marginRight = parseInt(style.marginRight) || 0;
                    const slideWidth = slide.offsetWidth + marginLeft + marginRight;
                    const offset = current * slideWidth;
                    slider.style.transition = animate ? 'transform 0.5s cubic-bezier(.4,0,.2,1)' : 'none';
                    slider.style.transform = `translateX(-${offset}px)`;
                    // Désactive les boutons aux extrémités
                    if (prevBtn) prevBtn.disabled = current === 0;
                    if (nextBtn) nextBtn.disabled = current === total - visible;
                    if (prevBtn) prevBtn.style.opacity = current === 0 ? '0.5' : '1';
                    if (nextBtn) nextBtn.style.opacity = current === total - visible ? '0.5' : '1';
                }

                function next() {
                    if (current < total - visible) {
                        current++;
                        updateSlider();
                    }
                }

                function prev() {
                    if (current > 0) {
                        current--;
                        updateSlider();
                    }
                }
                if (nextBtn) nextBtn.addEventListener('click', next);
                if (prevBtn) prevBtn.addEventListener('click', prev);
                window.addEventListener('resize', () => updateSlider(false));
                // Centrage initial
                setTimeout(() => updateSlider(false), 100);
            });
        </script>
    </section>


    <!-- Footer -->
    <footer class="bg-[#3C74A8E8] text-gray-100 relative">
        <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Bloc logo et newsletter -->
            <div class="space-y-4 relative flex flex-col items-center md:items-start">
                <div
                    class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0">
                </div>
                <img src="./images/Page contact/logo-350100.png"
                    class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
                <h2 class="text font-semibold relative z-10 text-center md:text-left text-base md:text-lg">Un réseau de
                    délégués médicaux sur le Togo, le Bénin et le Niger</h2>
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
                        <a href="mailto:{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="ml-1">{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</a>
                    </li>
                    <li class="flex gap-5 mt-2 justify-center md:justify-start">
                        <a href="{{ $general['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ $general['instagram_url'] ?? '#' }}" target="_blank"
                            rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-linkedin"></i></a>
                        <a href="{{ $general['youtube_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-youtube"></i></a>
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
                    <a href="https://www.neostart.tech/" target="_blank"
                        class="text-white hover:underline text-center md:text-left tracking-wide flex items-center gap-2 transition-all duration-200">
                        <i class="fas fa-code"></i>
                        Développé par Neo Start Technology
                    </a>
                    <a href="{{ route('admin.login') }}"
                        class="text-white/60 hover:text-white/80 transition-all duration-200 text-xs"
                        title="Administration">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
