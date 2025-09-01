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

    <!-- Header principal (phone, search, socials) -->
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
                    <button onclick="toggleSearch && toggleSearch()" class="absolute left-3">
                        <i class="fas fa-search text-[#3C74A8]"></i>
                    </button>
                    <input id="searchInput" type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
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

    <script>
        // Burger + dropdown handlers (depend on #menu-toggle and #main-menu if present in page)
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menu-toggle');
            const mainMenu = document.getElementById('main-menu');

            if (menuToggle && mainMenu) {
                menuToggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    mainMenu.classList.toggle('hidden');
                });
                mainMenu.addEventListener('click', function(e) { e.stopPropagation(); });
                document.body.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        mainMenu.classList.add('hidden');
                        document.querySelectorAll('.qdropdown-menu').forEach(menu => menu.classList.add('hidden'));
                    }
                });
            }

            document.querySelectorAll('.qdropdown > a').forEach(drop => {
                drop.addEventListener('click', function(e) {
                    const submenu = this.nextElementSibling;
                    if(window.innerWidth < 768) {
                        e.preventDefault();
                        submenu.classList.toggle('hidden');
                        document.querySelectorAll('.qdropdown-menu').forEach(menu => { if (menu !== submenu) menu.classList.add('hidden'); });
                    } else {
                        e.preventDefault();
                        submenu.classList.toggle('hidden');
                    }
                });
            });

            document.addEventListener('click', function(e) {
                if (window.innerWidth >= 768) {
                    if (!e.target.closest('.qdropdown')) {
                        document.querySelectorAll('.qdropdown-menu').forEach(menu => menu.classList.add('hidden'));
                    }
                }
            });
        });
    </script>
</header>
