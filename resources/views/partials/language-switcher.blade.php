<!-- Language Switcher Dropdown -->
<div class="relative inline-block text-left" id="languageSwitcher">
    <!-- Globe Icon Button -->
    <button onclick="toggleLanguageDropdown(event)" 
            type="button" 
            id="languageButton"
            class="flex items-center justify-center w-9 h-9 bg-white text-[#3C74A8] rounded-full hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md"
            aria-label="{{ __('messages.language') }}"
            aria-expanded="false"
            aria-haspopup="true">
        <i class="fas fa-globe text-lg"></i>
    </button>

    <!-- Dropdown Menu -->
    <div id="languageDropdown"
         class="hidden absolute right-0 mt-2 w-40 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transition-all duration-150"
         role="menu" 
         aria-orientation="vertical"
         aria-labelledby="languageButton">
        <div class="py-1" role="none">
            <!-- French Option -->
            <a href="{{ route('lang.switch', 'fr') }}" 
               onclick="closeLanguageDropdown()"
               class="flex items-center px-4 py-2.5 text-sm transition-colors duration-150 {{ app()->getLocale() === 'fr' ? 'bg-[#3C74A8] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
               role="menuitem">
                <span class="mr-2 text-base">🇫🇷</span>
                <span>{{ __('messages.french') }}</span>
                @if(app()->getLocale() === 'fr')
                    <i class="fas fa-check ml-auto text-xs"></i>
                @endif
            </a>
            
            <!-- English Option -->
            <a href="{{ route('lang.switch', 'en') }}" 
               onclick="closeLanguageDropdown()"
               class="flex items-center px-4 py-2.5 text-sm transition-colors duration-150 {{ app()->getLocale() === 'en' ? 'bg-[#3C74A8] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
               role="menuitem">
                <span class="mr-2 text-base">🇬🇧</span>
                <span>{{ __('messages.english') }}</span>
                @if(app()->getLocale() === 'en')
                    <i class="fas fa-check ml-auto text-xs"></i>
                @endif
            </a>
        </div>
    </div>
</div>

<script>
    // Language switcher dropdown functionality
    function toggleLanguageDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('languageDropdown');
        const button = document.getElementById('languageButton');
        const isHidden = dropdown.classList.contains('hidden');
        
        if (isHidden) {
            dropdown.classList.remove('hidden');
            button.setAttribute('aria-expanded', 'true');
        } else {
            dropdown.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        }
    }

    function closeLanguageDropdown() {
        const dropdown = document.getElementById('languageDropdown');
        const button = document.getElementById('languageButton');
        dropdown.classList.add('hidden');
        button.setAttribute('aria-expanded', 'false');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const switcher = document.getElementById('languageSwitcher');
        const dropdown = document.getElementById('languageDropdown');
        const button = document.getElementById('languageButton');
        
        if (switcher && !switcher.contains(event.target)) {
            dropdown.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Close dropdown on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLanguageDropdown();
        }
    });
</script>
