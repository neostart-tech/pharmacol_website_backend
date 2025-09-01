{{-- filepath: backend/resources/views/contact.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Contact</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
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

    <body class="font-sans">
        <button id="scrollToTopBtn" onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50" aria-label="Remonter en haut">↑
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


        <!-- Corps de la page -->
        <div class="relative z-[-10]">
            <!-- Contact Section -->
            <div class="relative flex flex-col md:flex-row gap-10 md:gap-20 px-4 md:pl-10 md:pr-2 mt-12 max-w-7xl mx-auto" id="contact">

                <div class="bg-[#437305] text-white relative flex flex-col pt-10 gap-8 w-full md:w-[420px] h-auto md:h-[660px] shadow-lg mb-20 md:mb-0">
                    <div class="pl-8 flex items-start gap-4">
                        <div class="flex items-center justify-center bg-[#6b973d] rounded-full w-12 h-12">
                            <i class="fas fa-phone-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-[#DBDBDB] font-medium text-[14px]">Vous avez des questions ?</h2>
                            <p class="text-white font-semibold text-[18px]">(+228) 22 50 75 10</p>
                        </div>  
                    </div>
                    <div class="pl-8 flex items-start gap-4">
                        <div class="flex items-center justify-center bg-[#6b973d] rounded-full w-12 h-12">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-[#DBDBDB] font-medium text-[14px]">Envoyer un mail</h2>
                            <p class="text-white font-medium text-[14px]">{{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</p>
                        </div>
                    </div>
                    <div class="pl-8 pb-10 flex items-start gap-4">
                        <div class="flex items-center justify-center bg-[#6b973d] rounded-full w-12 h-12">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-[#DBDBDB] font-medium text-[14px]">Visiter à tout moment</h2>
                            <p class="text-white font-medium text-[14px]">184 Rue Agnan Quartier Djidjolé</p>
                        </div>
                    </div>
                    <img src="{{ asset('images/Page accueil togo/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg') }}" class="hidden md:block absolute bottom-[-30px] left-1/2 -translate-x-1/2 w-[340px] h-[378px] object-cover" />
                    <div class="flex gap-8 justify-around items-center text-[#3C74A8] bg-white w-[90%] max-w-[250px] h-[70px] px-7 mx-auto absolute md:bottom-[-30px] bottom-[-50px] left-1/2 -translate-x-1/2 shadow-lg">
                        <a href="https://www.instagram.com"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="https://www.facebook.com"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="https://www.pinterest.com"><i class="fab fa-pinterest-p text-xl"></i></a>
                    </div>
                </div>

                <form action="https://formspree.io/f/xzzrwanv" method="POST" class="w-full md:w-[816px] bg-white shadow-lg p-6 md:p-10 flex flex-col mb-10">
                    <h4 class="text-green-700 text-lg font-medium mb-2 uppercase tracking-wide">🧬 Nous contacter</h4>
                    <h2 class="text-2xl md:text-[40px] font-bold text-black mb-6 md:mb-10">N'hésitez pas à nous écrire</h2>
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <input type="text" name="nom" placeholder="Votre nom"
                            class="bg-[#F3F3F3] placeholder-[#6A6A6A] font-medium text-[16px] outline-none p-4 w-full md:w-1/2 rounded" required />
                        <input type="email" name="email" placeholder="Votre adresse mail"
                            class="bg-[#F3F3F3] placeholder-[#6A6A6A] font-medium text-[16px] outline-none p-4 w-full md:w-1/2 rounded" required />
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <input type="text" name="telephone" placeholder="Téléphone"
                            class="bg-[#F3F3F3] placeholder-[#6A6A6A] font-medium text-[16px] outline-none p-4 w-full md:w-1/2 rounded" />
                        <input type="text" name="sujet" placeholder="Sujet"
                            class="bg-[#F3F3F3] placeholder-[#6A6A6A] font-medium text-[16px] outline-none p-4 w-full md:w-1/2 rounded" />
                    </div>
                    <textarea name="message" placeholder="Laisser un message"
                        class="bg-[#F3F3F3] placeholder-[#6A6A6A] font-medium text-[16px] outline-none resize-none w-full h-40 md:h-80 p-4 mb-4 rounded"
                        required></textarea>
                    <button type="submit"
                        class="bg-[#437305] text-white text-xl font-semibold px-8 py-3 w-full md:w-[150px] rounded self-end">Envoyer</button>
                </form>
            </div>
        </div>

        <!-- Carte -->
        <div id="Carte" class="h-[400px] grayscale"></div>
        <script>
        const lat = 6.1860;
        const lon = 1.2045;
        const carte = L.map("Carte", {
            zoomControl: false,
            dragging: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            keyboard: false,
        }).setView([lat, lon], 16);
        L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
            attribution: '&copy; <a href="https://carto.com/">Carto</a>',
        }).addTo(carte);
        L.marker([lat, lon])
            .addTo(carte)
            .bindPopup("<b>184 Rue Agnan</b><br>Quartier Djidjolé, Lomé.")
            .openPopup();

        document.getElementById("Carte").addEventListener("click", () => {
            const mapEl = document.getElementById("Carte");
            mapEl.classList.remove("grayscale");
            carte.dragging.enable();
            carte.scrollWheelZoom.enable();
            carte.doubleClickZoom.enable();
            carte.boxZoom.enable();
            carte.keyboard.enable();
            carte.zoomControl.enable();
        });
        </script>

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
    </body>
</html>