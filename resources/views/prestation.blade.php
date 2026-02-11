<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ __('messages.prestations') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link rel="shortcut icon" href="{{ asset('images/Page contact/logo-350100.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body { font-family: 'Lexend', 'Inter', sans-serif; }
            .accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
            }
            .accordion-content.open {
                padding-bottom: 0.75rem;
            }
        </style>
    </head>

    <body class="bg-white text-gray-800">
        <button onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50" aria-label="{{ __('messages.scroll_to_top') }}">↑
        </button>

        <!-- HEADER -->
        <header>
            <!-- Bandeau top -->
            <div id="Prestations" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row flex-wrap sm:justify-between text-gray-700 gap-2 sm:gap-0">
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-center">
                        <span><i class="fas fa-map-marker-alt text-green-700"></i> {{ __('messages.address') }}</span>
                        <span><i class="fas fa-envelope text-green-700"></i> {{ $general['email_contact'] ?? 'contact@agence-pharmacol.com' }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center justify-center">
                        <span>
                            <i class="fas fa-clock text-green-700"></i>
                            {{ __('messages.working_hours') }}
                            <span class="hidden sm:inline"> / </span>
                        </span>
                        <span class="sm:ml-1">
                            {{ __('messages.closed_weekends') }}
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
                            <p class="text-xs">{{ __('messages.call_anytime') }}</p>
                            <strong class="text-sm font-bold">(+228) 22 50 75 10</strong>
                        </div>
                        <div class="hidden md:block w-px h-6 bg-white"></div>
                        <div class="relative flex items-center w-full md:w-60 lg:w-72">
                            <button onclick="toggleSearch()" class="absolute left-3">
                                <i class="fas fa-search text-[#3C74A8]"></i>
                            </button>
                            <input id="searchInput" type="text" placeholder="{{ __('messages.search_placeholder') }}" class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <ul id="suggestions" class="absolute left-0 top-full w-full mt-1 bg-white text-black border border-gray-300 rounded shadow hidden z-50 text-sm max-h-60 overflow-y-auto"></ul>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 text-white w-full md:w-1/4 justify-center md:justify-end mt-4 md:mt-0">
                        <a href="{{ $general['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook"></i></a>
                        <a href="{{ $general['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                        <a href="{{ $general['youtube_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                        @include('partials.language-switcher')
                    </div>
                </div>
            </div>

            <!-- Bandeau Prestations & navbar responsive -->
            <div class="relative z-0 qhero-prestations bg-cover bg-center h-40 sm:h-56 md:h-72" style="background-image: url('{{ asset('images/Page contact/medicine-capsules-global-health-with-geometric-pattern-digital-remix.jpg') }}');">
                <div class="absolute inset-0 bg-black/40 z-0"></div>
                <div class="bg-white bg-opacity-100 backdrop-blur-md w-full md:w-[70%] mx-auto relative z-30">
                    <nav class="relative z-20">
                        <div class="qcontainer flex justify-around items-center px-4 py-3">
                            <!-- Logo -->
                            <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                                <div class="qlogo">
                                    <img src="images/Page prestations 2/logo-350100.png" alt="{{ __('messages.logo_pharmacol_alt') }}" class="h-12 md:h-16">
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
                                        <span>{{ __('messages.nos_implantations') }}</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block md:mt-0 z-50">
                                        <li>
                                            <a href="{{ route('accueil.togo') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto"> {{ __('messages.togo') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('accueil.benin') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/bj.png" alt="Benin" class="w-5 h-auto"> {{ __('messages.benin') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('accueil.niger') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto"> {{ __('messages.niger') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('prestation') }}" class="text-[#437305] hover:text-green-600 block px-4 py-3 md:p-0 font-bold">{{ __('messages.prestations') }}</a></li>
                                <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">{{ __('messages.recrutement') }}</a></li>
                                <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">{{ __('messages.blog') }}</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">{{ __('messages.contact') }}</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-end pb-8 sm:justify-center sm:pb-0 text-white text-center">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold w-full">{{ __('messages.prestations') }}</h1>
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

    <!-- Contenu de la page -->
    <section class="py-10 sm:py-16 px-2 sm:px-4">
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 items-stretch">
            <aside class="flex flex-col justify-between overflow-hidden shadow-lg bg-white mb-6 md:mb-0 rounded-xl">
                <div class="bg-[#3f73a3] text-white text-center py-4 font-semibold text-lg sm:text-xl">{{ __('messages.all_services') }}</div>
                    <div class="bg-[#437305] p-4 sm:p-6 flex-grow flex flex-col justify-between">
                        <ul class="space-y-2 sm:space-y-4">
                            <li>
                            <button onclick="showContent('promotion')" data-key="promotion"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.medical_promotion') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('encadrement')" data-key="encadrement"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.medical_supervision') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('representation')" data-key="representation"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.pharmaceutical_representation_title') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('autorisation')" data-key="autorisation"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.market_authorization_title') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('marketing')" data-key="marketing"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.marketing_communication_title') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('consulting')" data-key="consulting"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                {{ __('messages.consulting_title') }}
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </aside>

                <div class="md:col-span-2 flex items-center justify-center">
                    <img id="service-image" src="{{ asset('images/Page prestations 2/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg') }}"
                        alt="Recherche médicale"
                        class="rounded-2xl shadow-xl w-full max-w-3xl object-cover transition-all duration-500" />
                </div>
            </div>
        </section>

        <section class="bg-gray-50 px-2 sm:px-4 py-10 sm:py-5">
            <div class="max-w-screen-xl mx-auto md:col-span-2 p-4 sm:p-10 md:p-20" id="content-area">
                <!-- Le contenu dynamique s'affichera ici -->
            </div>
        </section>
        <script>
            // Contenus HTML pour chaque service (textes enrichis et icônes)
            const servicesContent = {
                promotion: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-bullhorn text-[#437305]"></i>
                            {{ __('messages.medical_promotion_full_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.medical_promotion_full_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-user-md text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.targeted_medical_visits') }}</strong> {{ __('messages.targeted_medical_visits_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-chalkboard-teacher text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.scientific_meetings_org') }}</strong> {{ __('messages.scientific_meetings_org_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-file-medical-alt text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.documentation_distribution') }}</strong> {{ __('messages.documentation_distribution_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-blue-50 border-l-4 border-[#3f73a3] p-4 rounded">
                            <i class="fas fa-info-circle text-[#3f73a3] mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.ethical_approach_note') }}</span>
                        </div>
                    </div>
                `,
                encadrement: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-users-cog text-[#437305]"></i>
                            {{ __('messages.sales_force_supervision_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.sales_force_supervision_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-chalkboard text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.personalized_coaching') }}</strong> {{ __('messages.personalized_coaching_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-chart-line text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.performance_monitoring') }}</strong> {{ __('messages.performance_monitoring_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-graduation-cap text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.continuous_training') }}</strong> {{ __('messages.continuous_training_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-green-50 border-l-4 border-[#437305] p-4 rounded">
                            <i class="fas fa-hands-helping text-[#437305] mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.talent_valorization_note') }}</span>
                        </div>
                    </div>
                `,
                representation: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-handshake text-[#437305]"></i>
                            {{ __('messages.pharma_representation_full_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.pharma_representation_full_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-file-signature text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.administrative_management') }}</strong> {{ __('messages.administrative_management_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-balance-scale text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.regulatory_monitoring') }}</strong> {{ __('messages.regulatory_monitoring_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-network-wired text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.partnership_development') }}</strong> {{ __('messages.partnership_development_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                            <i class="fas fa-user-shield text-yellow-600 mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.privileged_interlocutor_note') }}</span>
                        </div>
                    </div>
                `,
                autorisation: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-certificate text-[#437305]"></i>
                            {{ __('messages.market_authorization_full_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.market_authorization_full_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-folder-open text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.registration_file') }}</strong> {{ __('messages.registration_file_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-tasks text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.procedures_monitoring') }}</strong> {{ __('messages.procedures_monitoring_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-search text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.regulatory_watch') }}</strong> {{ __('messages.regulatory_watch_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
                            <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.optimized_filing_note') }}</span>
                        </div>
                    </div>
                `,
                marketing: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-bullseye text-[#437305]"></i>
                            {{ __('messages.marketing_comm_full_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.marketing_comm_full_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-broadcast-tower text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.promotional_campaigns') }}</strong> {{ __('messages.promotional_campaigns_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-paint-brush text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.communication_materials') }}</strong> {{ __('messages.communication_materials_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-calendar-check text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.professional_events') }}</strong> {{ __('messages.professional_events_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded">
                            <i class="fas fa-lightbulb text-indigo-600 mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.creative_team_note') }}</span>
                        </div>
                    </div>
                `,
                consulting: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-user-tie text-[#437305]"></i>
                            {{ __('messages.consulting_full_title') }}
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            {!! __('messages.consulting_full_desc') !!}
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-search-dollar text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.organizational_audit') }}</strong> {{ __('messages.organizational_audit_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-lightbulb text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.development_strategy') }}</strong> {{ __('messages.development_strategy_desc') }}
                            </li>
                            <li>
                                <i class="fas fa-hands-holding text-[#3f73a3] mr-2"></i>
                                <strong>{{ __('messages.personalized_support') }}</strong> {{ __('messages.personalized_support_desc') }}
                            </li>
                        </ul>
                        <div class="mt-6 bg-gray-100 border-l-4 border-[#3f73a3] p-4 rounded">
                            <i class="fas fa-star text-[#3f73a3] mr-2"></i>
                            <span class="text-gray-700">{{ __('messages.trust_expertise_note') }}</span>
                        </div>
                    </div>
                `
            };

            // Images associées à chaque service
            const servicesImages = {
                promotion: "{{ asset('images/Page prestations 2/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg') }}",
                encadrement: "{{ asset('images/Page prestations 2/team-meeting-pharma.jpg') }}",
                representation: "{{ asset('images/Page prestations 2/pharma-representation.jpg') }}",
                autorisation: "{{ asset('images/Page prestations 2/autorisation-marche.jpg') }}",
                marketing: "{{ asset('images/Page prestations 2/marketing-communication.jpg') }}",
                consulting: "{{ asset('images/Page prestations 2/consulting-pharma.jpg') }}"
            };

            // Fonction pour afficher le contenu selon le service choisi
            function showContent(key) {
                const area = document.getElementById('content-area');
                area.innerHTML = servicesContent[key] || '';
                // Mettre à jour l'image
                const img = document.getElementById('service-image');
                if (img && servicesImages[key]) {
                    img.src = servicesImages[key];
                    img.alt = document.querySelector(`button[data-key="${key}"]`)?.innerText || '';
                }
                // Optionnel : mettre à jour le style du bouton actif
                document.querySelectorAll('.service-btn').forEach(btn => {
                    btn.classList.remove('bg-[#3f73a3]', 'text-white');
                    btn.classList.add('bg-white', 'text-[#3f73a3]');
                    if (btn.getAttribute('data-key') === key) {
                        btn.classList.remove('bg-white', 'text-[#3f73a3]');
                        btn.classList.add('bg-[#3f73a3]', 'text-white');
                    }
                });
            }

            // Afficher le contenu par défaut au chargement
            document.addEventListener('DOMContentLoaded', function() {
                showContent('promotion');
            });
        </script>
        
        <section class="bg-gradient-to-br from-[#fafbfc] to-[#eff6fd] px-2 sm:px-4 pb-16 sm:pb-24">
            <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 items-start">
                <!-- Bloc aide rapide -->
                <div class="flex flex-col justify-between space-y-8 self-start h-auto">
                    <div class="bg-white/90 border border-[#d1e7ef] rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center text-center">
                        <svg class="w-14 h-14 mb-5 text-[#3C74A8] drop-shadow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke="#3C74A8" stroke-width="2" fill="#e6f2ff"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6" stroke="#437305" stroke-width="2"/>
                        </svg>
                        <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 tracking-tight text-[#3C74A8]">{{ __('messages.need_quick_help') }}</h2>
                        <p class="mb-6 text-base sm:text-lg text-[#437305] opacity-90">{{ __('messages.medical_team_responds') }}</p>
                        <a href="{{ route('contact') }}" class="inline-block bg-[#3C74A8] text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-[#437305] transition-all duration-200">{{ __('messages.contact_us_now') }}</a>
                    </div>
                </div>

                <!-- Bloc central : valeurs, avantages, pourquoi nous choisir -->
                <div class="md:col-span-2 flex flex-col space-y-10 sm:space-y-14">
                    <!-- Bloc Intro -->
                    <div class="space-y-3 sm:space-y-6">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#3C74A8] text-center sm:text-left flex items-center gap-3">
                            <svg class="w-8 h-8 text-[#437305]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="12" cy="12" r="8" stroke="#3C74A8" stroke-width="2" fill="#e6f2ff"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01" stroke="#437305"/>
                            </svg>
                            {{ __('messages.why_choose_expertise') }}
                        </h2>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            {{ __('messages.our_commitment') }}
                        </p>
                    </div>

                    <!-- Valeurs -->
                    <div class="space-y-2 sm:space-y-4">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-[#437305] flex items-center gap-2">
                            <i class="fas fa-heartbeat text-[#3C74A8]"></i>
                            {{ __('messages.our_values_title') }}
                        </h3>
                        <ul class="flex flex-wrap gap-4 sm:gap-6">
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-bolt text-[#437305] mr-2"></i> {{ __('messages.reactivity') }}
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-sync-alt text-[#437305] mr-2"></i> {{ __('messages.adaptability') }}
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-balance-scale text-[#437305] mr-2"></i> {{ __('messages.rigor') }}
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-eye text-[#437305] mr-2"></i> {{ __('messages.transparency') }}
                            </li>
                        </ul>
                    </div>

                    <!-- Avantages -->
                    <div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#3C74A8] mb-2 flex items-center gap-2">
                            <i class="fas fa-star text-[#437305]"></i>
                            {{ __('messages.our_advantages') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-microscope text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">{{ __('messages.cutting_edge_technology') }}</h4>
                                    <p class="text-sm text-[#6A6A6A]">{{ __('messages.cutting_edge_technology_desc') }}</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-user-shield text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">{{ __('messages.reliability_security') }}</h4>
                                    <p class="text-sm text-[#6A6A6A]">{{ __('messages.reliability_security_desc') }}</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-users text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">{{ __('messages.multidisciplinary_team') }}</h4>
                                    <p class="text-sm text-[#6A6A6A]">{{ __('messages.multidisciplinary_team_desc') }}</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-hand-holding-heart text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">{{ __('messages.human_support') }}</h4>
                                    <p class="text-sm text-[#6A6A6A]">{{ __('messages.human_support_desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Engagements -->
                    <div>
                        <h3 class="text-lg sm:text-xl md:text-2xl text-[#437305] mt-4 mb-4 sm:mb-6 font-semibold flex items-center gap-2">
                            <i class="fas fa-handshake-angle text-[#3C74A8]"></i>
                            {{ __('messages.our_commitments') }}
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">{{ __('messages.personalized_advice') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">{{ __('messages.international_standards') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">{{ __('messages.pricing_transparency') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">{{ __('messages.continuous_follow_up') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#3C74A8E8] text-gray-100 relative">
            <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Bloc logo et newsletter -->
                <div class="space-y-4 relative flex flex-col items-center md:items-start">
                    <div class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0"></div>
                    <img src="{{ asset('images/Page contact/logo-350100.png') }}" class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
                    <h2 class="text font-semibold relative z-10 text-center md:text-left text-base md:text-lg">{{ __('messages.network_tagline') }}</h2>
                    <div class="flex w-full max-w-xs">
                        <input type="text" placeholder="{{ __('messages.email_placeholder') }}"
                            class="w-full px-3 py-2 bg-white text-black border border-gray-600 rounded-l-md focus:outline-none" />
                        <button class="bg-[#437305] px-4 py-2 border border-[#437305] rounded-r-md">
                            <i class="fas fa-arrow-up transform rotate-45 text-white"></i>
                        </button>
                    </div>
                </div>
                <!-- Liens rapides -->
                <div class="md:ml-8 flex flex-col items-center md:items-start">
                    <h2 class="mb-4 font-semibold text-lg">{{ __('messages.quick_links') }}</h2>
                    <ul class="space-y-2 text-center md:text-left">
                        <li><a href="{{ route('accueil') }}" class="hover:underline">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('prestation') }}" class="hover:underline">{{ __('messages.services') }}</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:underline">{{ __('messages.blog') }}</a></li>
                        <li><a href="{{ route('recrutement') }}" class="hover:underline">{{ __('messages.recrutement') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:underline">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div class="flex flex-col items-center md:items-start">
                    <h2 class="mb-4 font-semibold text-lg">{{ __('messages.contact') }}</h2>
                    <ul class="space-y-2 text-center md:text-left">
                        <li>{{ __('messages.address') }}</li>
                        <li>{{ __('messages.behind_epp') }}</li>
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
                    <h2 class="mb-4 font-semibold text-lg">{{ __('messages.opening_hours_title') }}</h2>
                    <ul class="space-y-1 text-center md:text-left">
                        <li>{{ __('messages.monday') }} : {{ __('messages.hours_schedule') }}</li>
                        <li>{{ __('messages.tuesday') }} : {{ __('messages.hours_schedule') }}</li>
                        <li>{{ __('messages.wednesday') }} : {{ __('messages.hours_schedule') }}</li>
                        <li>{{ __('messages.thursday') }} : {{ __('messages.hours_schedule') }}</li>
                        <li>{{ __('messages.friday') }} : {{ __('messages.hours_schedule') }}</li>
                    </ul>
                </div>
            </div>
            <div class="bg-[#3C74A8] py-4 text-xs md:text-sm shadow-inner">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-y-2 px-4">
                    <div class="w-full md:w-2/5 flex justify-center md:justify-end mb-2 md:mb-0">
                        <span class="text-white text-center md:text-right tracking-wide flex items-center gap-2">
                        <i class="fa-regular fa-copyright"></i>
                            {{ __('messages.copyright_text') }}
                        </span>
                    </div>
                    <span class="hidden md:inline text-white mx-6 text-lg opacity-60">|</span>
                    <div class="w-full md:w-2/5 flex justify-center md:justify-start items-center gap-4">
                        <a href="https://www.neostart.tech/" target="_blank" class="text-white hover:underline text-center md:text-left tracking-wide flex items-center gap-2 transition-all duration-200">
                        <i class="fas fa-code"></i>
                            {{ __('messages.developed_by') }}
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


