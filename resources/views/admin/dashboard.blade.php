{{-- filepath: backend/resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body { font-family: 'Lexend', sans-serif; }
            .selected-section { background: linear-gradient(90deg, #e0e7ff 80%, #fff 100%); color: #3730a3; }
            .sidebar-shadow { box-shadow: 2px 0 16px 0 rgba(60, 116, 168, 0.10); }
            .sidebar-link { transition: background 0.2s, color 0.2s; }
            .sidebar-link i { min-width: 1.5rem; }
            .sidebar-link.selected-section { font-weight: 600; }
            .logout-btn { font-weight: 600; }
            .card { box-shadow: 0 2px 16px 0 rgba(60, 116, 168, 0.07); border-radius: 1rem; }
            .table-row-hover:hover { background: #f1f5f9; }
            @media (max-width: 900px) {
                aside { position: fixed; left: -100vw; transition: left 0.3s; }
                aside.open { left: 0; }
                main { margin-left: 0 !important; }
            }
        </style>
    </head>
    <body class="bg-[#f7fafc]">
        <!-- Sidebar -->
        <div class="flex">
            <aside id="sidebar" class="sidebar-shadow fixed top-0 left-0 h-screen w-[18rem] bg-white text-gray-700 p-4 z-50 flex flex-col border-r border-gray-200 shadow-r transition-all duration-300">
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('images/Page prestations 2/logo-350100.png') }}" alt="Logo Pharmacol" class="h-16 mb-2">
                    <span class="text-lg font-bold text-[#3C74A8] tracking-wide">Admin</span>
                </div>
                <nav class="flex flex-col gap-1 min-w-[200px] p-2 text-base text-gray-700 flex-1">
                    <button type="button" onclick="showSection('blog')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-blog mr-3"></i> Blog
                    </button>
                    <button type="button" onclick="showSection('recrutement')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-briefcase mr-3"></i> Suivi recrutement
                    </button>
                    <button type="button" onclick="showSection('newsletter')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-envelope-open-text mr-3"></i> Newsletter
                    </button>
                    <button type="button" onclick="showSection('entreprises')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-building mr-3"></i> Entreprises
                    </button>
                    @if(session('role') === 'admin')
                    <button type="button" onclick="showSection('utilisateurs')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-users mr-3"></i> Utilisateurs
                    </button>
                    @endif
                    <button type="button" onclick="showSection('chiffres')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-chart-bar mr-3"></i> Chiffres & images
                    </button>
                    <div class="flex-1"></div>
                    <a href="{{ route('admin.logout') }}"
                    class="logout-btn flex items-center w-full p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition mt-4 mb-2 justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                </nav>
            </aside>
            <!-- Burger menu for mobile -->
            <button id="burger" class="fixed top-4 left-4 z-50 bg-white border border-gray-300 rounded-lg p-2 shadow md:hidden">
                <i class="fas fa-bars text-2xl text-[#3C74A8]"></i>
            </button>

            <!-- Main content -->
            <main class="ml-[18rem] w-full p-6 flex flex-col transition-all duration-300">
                <h1 class="text-3xl font-bold text-[#3C74A8] mb-8">Tableau de bord</h1>

                <!-- Section Blog -->
                <section id="blog" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Articles du blog</h2>
                            <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter un article
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-800 text-gray-300">
                                        <th class="px-4 py-2">Image</th>
                                        <th class="px-4 py-2">Titre</th>
                                        <th class="px-4 py-2">Contenu</th>
                                        <th class="px-4 py-2">Date</th>
                                        <th class="px-4 py-2">État</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="Image de l'article" class="w-16 h-16 object-cover rounded">
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 font-semibold">{{ $blog->titre }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ Str::limit(strip_tags($blog->texte), 80) }}</td>
                                        <td class="px-4 py-2">{{ $blog->date }}</td>
                                        <td class="px-4 py-2">
                                            <span class="inline-block px-2 py-1 rounded text-xs
                                                {{ $blog->etat === 'en ligne' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                                {{ $blog->etat }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 space-x-2 flex gap-2">
                                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                            <form method="POST" action="{{ route('admin.blog.destroy', $blog->id) }}" onsubmit="return confirm('Supprimer cet article ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Recrutement -->
                <section id="recrutement" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Postes à pourvoir</h2>
                            <a href="{{ route('admin.poste.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter un poste
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-800 text-gray-300">
                                        <th class="px-4 py-2">Titre</th>
                                        <th class="px-4 py-2">Descriptif</th>
                                        <th class="px-4 py-2">Localisation</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($postes as $poste)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2 font-semibold">{{ $poste->titre }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ Str::limit(strip_tags($poste->descriptif), 80) }}</td>
                                        <td class="px-4 py-2">{{ $poste->localisation }}</td>
                                        <td class="px-4 py-2 space-x-2 flex gap-2">
                                            <a href="{{ route('admin.poste.edit', $poste->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                            <form method="POST" action="{{ route('admin.poste.destroy', $poste->id) }}" onsubmit="return confirm('Supprimer ce poste ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Newsletter -->
                <section id="newsletter" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Newsletter</h2>
                            <a href="{{ route('admin.newsletter.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-800 text-gray-300">
                                    <tr>
                                        <th class="px-6 py-3 text-left">Email</th>
                                        <th class="px-6 py-3 text-left">Prénom</th>
                                        <th class="px-6 py-3 text-left">Nom</th>
                                        <th class="px-6 py-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                    @foreach($newsletters as $newsletter)
                                        <tr class="bg-white border-b border-gray-300 table-row-hover">
                                            <td class="px-6 py-3">{{ $newsletter->mail }}</td>
                                            <td class="px-6 py-3">{{ $newsletter->prenom }}</td>
                                            <td class="px-6 py-3">{{ $newsletter->nom }}</td>
                                            <td class="px-6 py-3 text-center flex gap-2 justify-center">
                                                <a href="{{ route('admin.newsletter.edit', $newsletter->mail) }}" class="text-blue-600 hover:underline">Modifier</a>
                                                <form method="POST" action="{{ route('admin.newsletter.destroy', $newsletter->mail) }}" onsubmit="return confirm('Supprimer cette newsletter ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Entreprises -->
                <section id="entreprises" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Entreprises</h2>
                            <a href="{{ route('admin.entreprise.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter une entreprise
                            </a>
                        </div>
                        <div class="flex flex-col gap-6">
                            @foreach(['Niger', 'Bénin', 'Togo'] as $pays)
                            <div>
                                <h3 class="text-xl font-bold mb-2">{{ $pays }}</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full table-auto mb-4">
                                        <thead>
                                            <tr class="bg-gray-800 text-gray-300">
                                                <th class="px-4 py-2">Nom</th>
                                                <th class="px-4 py-2">Ville</th>
                                                <th class="px-4 py-2">Coordonnées</th>
                                                <th class="px-4 py-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($entreprises->where('pays', $pays) as $entreprise)
                                            <tr class="bg-white border-b table-row-hover">
                                                <td class="px-4 py-2">{{ $entreprise->nom }}</td>
                                                <td class="px-4 py-2">{{ $entreprise->ville }}</td>
                                                <td class="px-4 py-2 text-xs">
                                                    <span>Lon: {{ $entreprise->longitude }}</span><br>
                                                    <span>Lat: {{ $entreprise->latitude }}</span>
                                                </td>
                                                <td class="px-4 py-2 flex gap-2">
                                                    <a href="{{ route('admin.entreprise.edit', $entreprise->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                                    <form method="POST" action="{{ route('admin.entreprise.destroy', $entreprise->id) }}" onsubmit="return confirm('Supprimer cette entreprise ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold mb-4 text-center">Carte des entreprises</h3>
                            <div id="map-entreprises" style="height: 400px; border-radius: 1rem; overflow: hidden;"></div>
                        </div>
                    </div>
                </section>

                <!-- Section Utilisateurs (admin uniquement) -->
                @if(session('role') === 'admin')
                <section id="utilisateurs" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Utilisateurs</h2>
                            <form method="POST" action="{{ route('admin.utilisateur.store') }}" class="flex gap-2 items-end">
                                @csrf
                                <div>
                                    <label class="block text-xs">Email</label>
                                    <input type="email" name="mail" class="border rounded p-1" required>
                                </div>
                                <div>
                                    <label class="block text-xs">Mot de passe</label>
                                    <input type="password" name="mot_de_passe" class="border rounded p-1" required>
                                </div>
                                <div>
                                    <label class="block text-xs">Rôle</label>
                                    <select name="role" class="border rounded p-1" required>
                                        <option value="user">user</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Créer</button>
                            </form>
                        </div>
                        @if($errors->any())
                            <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-800 text-gray-300">
                                    <tr>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Rôle</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($utilisateurs as $user)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2">{{ $user->mail }}</td>
                                        <td class="px-4 py-2">
                                            <select class="border rounded p-1 user-role-select" data-mail="{{ $user->mail }}" @if(session('admin') === $user->mail) disabled @endif>
                                                <option value="user" @if($user->role === 'user') selected @endif>user</option>
                                                <option value="admin" @if($user->role === 'admin') selected @endif>admin</option>
                                            </select>
                                        </td>
                                        <td class="px-4 py-2">
                                            @if(session('admin') !== $user->mail)
                                            <form method="POST" action="{{ route('admin.utilisateur.destroy', $user->mail) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                            @else
                                            <span class="text-gray-400 text-xs">(Vous)</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                @endif

                <!-- Section Chiffres et images -->
                <section id="chiffres" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <h2 class="text-2xl font-semibold text-[#437305] mb-6">Chiffres et images</h2>
                        <form id="chiffres-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.chiffres.update') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                @foreach(['Togo','Bénin','Niger'] as $pays)
                                    @php
                                        $data = collect($chiffres)->firstWhere('pays', $pays) ?? [];
                                        $imgPath = $data['equipe_image'] ?? '';
                                    @endphp
                                    <div class="border rounded-lg p-4 shadow-sm">
                                        <h3 class="text-lg font-bold mb-4 text-[#31689B]">{{ $pays }}</h3>
                                        <label class="block mb-2 text-sm">Bureaux</label>
                                        <input type="number" name="chiffres[{{ $pays }}][bureaux]" value="{{ $data['bureaux'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Laboratoires partenaires</label>
                                        <input type="number" name="chiffres[{{ $pays }}][laboratoires]" value="{{ $data['laboratoires'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Collaborateurs</label>
                                        <input type="number" name="chiffres[{{ $pays }}][collaborateurs]" value="{{ $data['collaborateurs'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Pharmacies couvertes</label>
                                        <input type="number" name="chiffres[{{ $pays }}][pharmacies]" value="{{ $data['pharmacies'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Délégués médicaux</label>
                                        <input type="number" name="chiffres[{{ $pays }}][delegues]" value="{{ $data['delegues'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Ville principale</label>
                                        <input type="text" name="chiffres[{{ $pays }}][ville_principale]" value="{{ $data['ville_principale'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        <label class="block mb-2 text-sm">Image équipe (.png, .jpg, .jpeg)</label>
                                        <div class="mb-2">
                                            @if($imgPath)
                                                <img src="{{ asset($imgPath) }}" alt="Equipe {{ $pays }}" class="w-full h-24 object-cover rounded mb-2 border">
                                            @endif
                                        </div>
                                        <input type="hidden" name="chiffres[{{ $pays }}][equipe_image]" value="{{ $imgPath }}">
                                        <input type="file" name="equipe_image_{{ $pays }}" accept=".jpg,.jpeg,.png" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#31689B] file:text-white hover:file:bg-[#437305]"/>
                                    </div>
                                @endforeach
                                @php
                                    $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
                                @endphp
                                <div class="border rounded-lg p-4 shadow-sm md:col-span-3">
                                    <h3 class="text-lg font-bold mb-4 text-[#31689B]">Informations générales</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block mb-2 text-sm">Collaborateurs</label>
                                            <input type="number" name="chiffres[general][collaborateurs]" value="{{ $general['collaborateurs'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm">Années d'expérience</label>
                                            <input type="number" name="chiffres[general][annees_experience]" value="{{ $general['annees_experience'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm">Pays couverts</label>
                                            <input type="number" name="chiffres[general][pays_couverts]" value="{{ $general['pays_couverts'] ?? '' }}" class="border rounded p-2 w-full mb-3" required>
                                        </div>
                                    </div>
                                    <div class="md:col-span-3 mt-4">
                                        <label class="block mb-2 text-sm">Description de l'expertise</label>
                                        <textarea name="chiffres[general][description]" class="border rounded p-2 w-full mb-3" rows="3" required>{{ $general['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="md:col-span-3 mt-4">
                                        <h4 class="text-lg font-semibold mb-4 text-[#31689B]">Réseaux sociaux</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block mb-2 text-sm">Facebook URL</label>
                                                <input type="url" name="chiffres[general][facebook_url]" value="{{ $general['facebook_url'] ?? '' }}" class="border rounded p-2 w-full mb-3" placeholder="https://www.facebook.com/agence-pharmacol">
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm">Instagram URL</label>
                                                <input type="url" name="chiffres[general][instagram_url]" value="{{ $general['instagram_url'] ?? '' }}" class="border rounded p-2 w-full mb-3" placeholder="https://www.instagram.com/agence-pharmacol">
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm">LinkedIn URL</label>
                                                <input type="url" name="chiffres[general][linkedin_url]" value="{{ $general['linkedin_url'] ?? '' }}" class="border rounded p-2 w-full mb-3" placeholder="https://www.linkedin.com/company/agence-pharmacol/">
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm">YouTube URL</label>
                                                <input type="url" name="chiffres[general][youtube_url]" value="{{ $general['youtube_url'] ?? '' }}" class="border rounded p-2 w-full mb-3" placeholder="https://www.youtube.com/channel/agence-pharmacol">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-3 mt-4">
                                        <h4 class="text-lg font-semibold mb-4 text-[#31689B]">Contact</h4>
                                        <div>
                                            <label class="block mb-2 text-sm">Email de contact</label>
                                            <input type="email" name="chiffres[general][email_contact]" value="{{ $general['email_contact'] ?? '' }}" class="border rounded p-2 w-full mb-3" placeholder="contact@agence-pharmacol.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="mt-6 bg-[#437305] hover:bg-[#31689B] text-white px-6 py-2 rounded shadow">Enregistrer</button>
                        </form>
                    </div>
                    
                    <!-- Gestion des partenaires -->
                    <div class="card bg-white p-6 mt-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold text-[#437305]">Gestion des partenaires</h2>
                            <button id="add-partenaire-btn" class="bg-[#437305] hover:bg-[#31689B] text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i>Ajouter un partenaire
                            </button>
                        </div>
                        
                        <!-- Liste des partenaires -->
                        <div id="partenaires-list" class="space-y-4">
                            <!-- Les partenaires seront chargés ici via JavaScript -->
                        </div>
                    </div>
                </section>

                <!-- Section Partenaires supprimée (maintenant dans chiffres) -->

                <!-- Modal pour ajouter/modifier un partenaire -->
                <div id="partenaire-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="modal-title" class="text-xl font-semibold text-[#437305]">Ajouter un partenaire</h3>
                            <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <form id="partenaire-form" enctype="multipart/form-data">
                            <input type="hidden" id="partenaire-id" name="id">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Nom du partenaire</label>
                                    <input type="text" id="partenaire-nom" name="nom" class="w-full border rounded p-2" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-2">Lien vers le site web</label>
                                    <input type="url" id="partenaire-lien" name="lien" class="w-full border rounded p-2" placeholder="https://" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-2">Logo/Image</label>
                                    <input type="file" id="partenaire-image" name="image" class="w-full border rounded p-2" accept="image/*">
                                    <div id="current-image" class="mt-2 hidden">
                                        <img id="preview-image" src="" alt="Aperçu" class="max-h-20 object-contain">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-2">Ordre d'affichage</label>
                                    <input type="number" id="partenaire-ordre" name="ordre" class="w-full border rounded p-2" min="0" value="0">
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" id="partenaire-actif" name="actif" class="mr-2" checked>
                                    <label for="partenaire-actif" class="text-sm font-medium">Actif</label>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-2 mt-6">
                                <button type="button" id="cancel-btn" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">Annuler</button>
                                <button type="submit" class="px-4 py-2 bg-[#437305] text-white rounded hover:bg-[#31689B]">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>

                @if(session('success'))
                    <div id="success-popup" class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 text-green-800 border border-green-300 px-8 py-4 rounded-lg shadow-lg text-center font-semibold transition-opacity duration-500 opacity-100">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(() => {
                            const popup = document.getElementById('success-popup');
                            if (popup) {
                                popup.style.opacity = '0';
                                setTimeout(() => popup.remove(), 600);
                            }
                        }, 2500);
                    </script>
                @endif

            </main>
        </div>
        <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section-content').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(sectionId).classList.remove('hidden');
            // Style sélectionné
            document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('selected-section'));
            const activeBtn = Array.from(document.querySelectorAll('.sidebar-link')).find(btn => {
                const onclickAttr = btn.getAttribute('onclick');
                return onclickAttr && onclickAttr.includes(`'${sectionId}'`);
            });
            if (activeBtn) activeBtn.classList.add('selected-section');
        }
        // Affiche la section selon le hash de l'URL
        document.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#', '');
            if (hash && document.getElementById(hash)) {
                showSection(hash);
            } else {
                showSection('blog');
            }
        });

        // Affiche la première section par défaut
        document.addEventListener('DOMContentLoaded', () => showSection('blog'));

        // Burger menu mobile
        const burger = document.getElementById('burger');
        const sidebar = document.getElementById('sidebar');
        if (burger && sidebar) {
            burger.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
            // Fermer le menu si on clique en dehors sur mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 900 && !sidebar.contains(e.target) && !burger.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            });
        }

        // Changement de rôle AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.user-role-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    const mail = this.dataset.mail;
                    const role = this.value;
                    fetch(`/admin/utilisateur/${encodeURIComponent(mail)}/role`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({role})
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.add('bg-green-100');
                            setTimeout(() => this.classList.remove('bg-green-100'), 800);
                        }
                    });
                });
            });
        });

        // Changement d'état Blog AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.blog-etat-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const etat = this.value;
                    fetch(`/admin/blog/${encodeURIComponent(id)}/etat`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({etat})
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.add('bg-green-100');
                            setTimeout(() => this.classList.remove('bg-green-100'), 800);
                        }
                    });
                });
            });
        });

        // Carte Leaflet des entreprises
        document.addEventListener('DOMContentLoaded', function() {
            if(document.getElementById('map-entreprises')) {
                var map = L.map('map-entreprises').setView([9.5, 2.5], 6);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                @foreach($entreprises as $e)
                    var marker = L.marker([{{ $e->latitude }}, {{ $e->longitude }}]).addTo(map)
                        .bindPopup('<b>{{ addslashes($e->nom) }}</b><br>{{ addslashes($e->ville) }}<br>{{ addslashes($e->pays) }}');
                    marker.bindTooltip("{{ addslashes($e->nom) }}, {{ addslashes($e->ville) }}", {permanent: true, direction: "top", offset: [-15, -10], className: "bg-white text-xs font-semibold px-2 py-1 rounded shadow"});
                @endforeach
            }
        });

        function addChiffreRow() {
            const list = document.getElementById('chiffres-list');
            const idx = list.children.length;
            const div = document.createElement('div');
            div.className = "flex flex-col md:flex-row gap-4 items-center chiffre-row";
            div.innerHTML = `
                <input type="text" name="chiffres[${idx}][label]" class="border rounded p-2 w-48" placeholder="Label" required>
                <input type="number" name="chiffres[${idx}][valeur]" class="border rounded p-2 w-32" placeholder="Valeur" required>
                <input type="text" name="chiffres[${idx}][image]" class="border rounded p-2 w-64" placeholder="Lien image" required>
                <button type="button" onclick="this.closest('.chiffre-row').remove()" class="text-red-600 hover:underline">Supprimer</button>
            `;
            list.appendChild(div);
        }

        // Gestion des partenaires
        let currentPartenaireId = null;

        // Charger les partenaires
        async function loadPartenaires() {
            console.log('🔄 Chargement des partenaires...');
            try {
                const response = await fetch('/admin/partenaires');
                console.log('📡 Réponse API:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                
                const partenaires = await response.json();
                console.log('📊 Partenaires reçus:', partenaires.length);
                
                const listContainer = document.getElementById('partenaires-list');
                if (!listContainer) {
                    console.error('❌ Container partenaires-list non trouvé');
                    return;
                }
                
                listContainer.innerHTML = '';
                
                if (partenaires.length === 0) {
                    listContainer.innerHTML = '<p class="text-gray-500 text-center py-4">Aucun partenaire configuré</p>';
                    return;
                }
                
                partenaires.forEach(partenaire => {
                    console.log('➕ Ajout partenaire:', partenaire.nom);
                    const div = document.createElement('div');
                    div.className = 'flex items-center justify-between border rounded p-4 bg-gray-50';
                    div.innerHTML = `
                        <div class="flex items-center space-x-4">
                            <img src="${partenaire.image}" alt="${partenaire.nom}" class="h-12 w-auto object-contain">
                            <div>
                                <h4 class="font-semibold">${partenaire.nom}</h4>
                                <p class="text-sm text-gray-600">${partenaire.lien}</p>
                                <span class="text-xs ${partenaire.actif ? 'text-green-600' : 'text-red-600'}">
                                    ${partenaire.actif ? 'Actif' : 'Inactif'}
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editPartenaire(${partenaire.id})" class="text-blue-600 hover:underline">Modifier</button>
                            <button onclick="deletePartenaire(${partenaire.id})" class="text-red-600 hover:underline">Supprimer</button>
                        </div>
                    `;
                    listContainer.appendChild(div);
                });
                console.log('✅ Partenaires chargés avec succès');
            } catch (error) {
                console.error('❌ Erreur lors du chargement des partenaires:', error);
                const listContainer = document.getElementById('partenaires-list');
                if (listContainer) {
                    listContainer.innerHTML = '<p class="text-red-500 text-center py-4">Erreur de chargement: ' + error.message + '</p>';
                }
            }
        }

        // Ouvrir le modal
        function openPartenaireModal(title = 'Ajouter un partenaire') {
            document.getElementById('modal-title').textContent = title;
            document.getElementById('partenaire-modal').classList.remove('hidden');
            document.getElementById('partenaire-modal').classList.add('flex');
        }

        // Fermer le modal
        function closePartenaireModal() {
            document.getElementById('partenaire-modal').classList.add('hidden');
            document.getElementById('partenaire-modal').classList.remove('flex');
            document.getElementById('partenaire-form').reset();
            document.getElementById('current-image').classList.add('hidden');
            currentPartenaireId = null;
        }

        // Modifier un partenaire
        async function editPartenaire(id) {
            try {
                const response = await fetch('/admin/partenaires');
                const partenaires = await response.json();
                const partenaire = partenaires.find(p => p.id === id);
                
                if (partenaire) {
                    currentPartenaireId = id;
                    document.getElementById('partenaire-id').value = id;
                    document.getElementById('partenaire-nom').value = partenaire.nom;
                    document.getElementById('partenaire-lien').value = partenaire.lien;
                    document.getElementById('partenaire-ordre').value = partenaire.ordre;
                    document.getElementById('partenaire-actif').checked = partenaire.actif;
                    
                    // Afficher l'image actuelle
                    const currentImageDiv = document.getElementById('current-image');
                    const previewImage = document.getElementById('preview-image');
                    previewImage.src = partenaire.image;
                    currentImageDiv.classList.remove('hidden');
                    
                    openPartenaireModal('Modifier le partenaire');
                }
            } catch (error) {
                console.error('Erreur lors de la récupération du partenaire:', error);
            }
        }

        // Supprimer un partenaire
        async function deletePartenaire(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?')) return;
            
            try {
                const response = await fetch(`/admin/partenaires/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                });
                
                if (response.ok) {
                    loadPartenaires();
                } else {
                    alert('Erreur lors de la suppression');
                }
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                alert('Erreur lors de la suppression');
            }
        }

        // Event listeners
        document.getElementById('add-partenaire-btn').addEventListener('click', () => openPartenaireModal());
        document.getElementById('close-modal').addEventListener('click', closePartenaireModal);
        document.getElementById('cancel-btn').addEventListener('click', closePartenaireModal);

        // Soumission du formulaire
        document.getElementById('partenaire-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('📝 Soumission formulaire partenaire...');
            
            const formData = new FormData(this);
            const method = currentPartenaireId ? 'PUT' : 'POST';
            const url = currentPartenaireId ? `/admin/partenaires/${currentPartenaireId}` : '/admin/partenaires';
            
            console.log('🎯 Méthode:', method, 'URL:', url);
            
            // Gérer explicitement la case à cocher "actif"
            const actifCheckbox = document.getElementById('partenaire-actif');
            if (actifCheckbox) {
                if (actifCheckbox.checked) {
                    formData.set('actif', '1');
                } else {
                    formData.set('actif', '0');
                }
            }
            
            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }
            
            // Log des données du formulaire
            console.log('📋 Données du formulaire:');
            for (let [key, value] of formData.entries()) {
                console.log(`  ${key}:`, value);
            }
            
            try {
                console.log('🚀 Envoi requête...');
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                });
                
                console.log('📡 Réponse:', response.status, response.statusText);
                
                if (response.ok) {
                    const result = await response.json();
                    console.log('✅ Succès!', result);
                    closePartenaireModal();
                    loadPartenaires();
                } else {
                    const errorText = await response.text();
                    console.error('❌ Erreur serveur:', response.status, errorText);
                    try {
                        const errorJson = JSON.parse(errorText);
                        alert('Erreur: ' + (errorJson.message || errorJson.error || 'Erreur inconnue'));
                    } catch (e) {
                        alert('Erreur serveur: ' + response.status + ' - ' + errorText.substring(0, 200));
                    }
                }
            } catch (error) {
                console.error('❌ Erreur réseau:', error);
                alert('Erreur lors de la sauvegarde: ' + error.message);
            }
        });

        // Charger les partenaires au chargement de la page
        document.addEventListener('DOMContentLoaded', loadPartenaires);
        </script>
    </body>
</html>


