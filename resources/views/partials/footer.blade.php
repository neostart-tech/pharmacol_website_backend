<footer class="bg-[#3C74A8E8] text-gray-100 relative">
    <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Bloc logo et newsletter -->
        <div class="space-y-4 relative flex flex-col items-center md:items-start">
            <div class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0"></div>
            <img src="{{ asset('images/Page contact/logo-350100.png') }}" alt="{{ __('messages.logo_pharmacol_alt') }}" class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
            <h2 class="text font-semibold relative z-10 text-center md:text-left text-base md:text-lg">{{ __('messages.network_tagline') }}</h2>
            <div class="flex w-full max-w-xs">
                <input type="text" placeholder="{{ __('messages.newsletter_email_placeholder') }}"
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
                <li>{{ __('messages.address_line_2') }}</li>
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
                    <a href="{{ $general['linkedin_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
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
                <a href="{{ route('admin.login') }}" class="text-white/60 hover:text-white/80 transition-all duration-200 text-xs" title="{{ __('messages.administration') }}">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
