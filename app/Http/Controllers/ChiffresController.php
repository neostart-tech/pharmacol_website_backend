<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Storage;

    class ChiffresController extends Controller
    {
        public function edit()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            return view('admin.dashboard', compact('chiffres'));
        }

        public function update(Request $request)
        {
            $chiffres = [];
            $defaultValues = [
                'Togo' => [
                    'bureaux' => '3',
                    'laboratoires' => '20',
                    'collaborateurs' => '25',
                    'pharmacies' => '300',
                    'delegues' => '25',
                    'ville_principale' => 'Lomé',
                    'equipe_image' => 'images/Pharmacol/equipe-togo.png'
                ],
                'Bénin' => [
                    'bureaux' => '2',
                    'laboratoires' => '15',
                    'collaborateurs' => '20',
                    'pharmacies' => '250',
                    'delegues' => '20',
                    'ville_principale' => 'Cotonou',
                    'equipe_image' => 'images/Pharmacol/equipe-benin.png'
                ],
                'Niger' => [
                    'bureaux' => '2',
                    'laboratoires' => '15',
                    'collaborateurs' => '18',
                    'pharmacies' => '200',
                    'delegues' => '18',
                    'ville_principale' => 'Niamey',
                    'equipe_image' => 'images/Pharmacol/equipe-niger.png'
                ]
            ];

            foreach (['Togo','Bénin','Niger'] as $pays) {
                $data = $request->input("chiffres.$pays", []);
                $data['pays'] = $pays;

                // Fusionner avec les valeurs par défaut pour éviter les champs vides
                $data = array_merge($defaultValues[$pays], $data);

                // Gestion de l'image
                if ($request->hasFile("equipe_image_$pays")) {
                    $file = $request->file("equipe_image_$pays");
                    $ext = strtolower($file->getClientOriginalExtension());
                    if (!in_array($ext, ['jpg','jpeg','png'])) {
                        return back()->with('success', "Format d'image non supporté pour $pays (jpg, jpeg, png uniquement).");
                    }
                    $filename = "equipe-" . strtolower($pays) . "." . $ext;
                    $file->move(public_path('images/Pharmacol'), $filename);
                    $data['equipe_image'] = "images/Pharmacol/$filename";
                }

                $chiffres[] = $data;
            }
            
            $general = $request->input('chiffres.general', []);
            $general['pays'] = 'general';
            
            // Valeurs par défaut pour general
            $generalDefaults = [
                'collaborateurs' => '150',
                'laboratoires' => '50',
                'annees_experience' => '15',
                'description' => 'Notre expertise s\'étend sur l\'ensemble de l\'Afrique de l\'Ouest',
                'facebook_url' => 'https://www.facebook.com/agence-pharmacol',
                'instagram_url' => 'https://www.instagram.com/agence-pharmacol',
                'linkedin_url' => 'https://www.linkedin.com/company/agence-pharmacol/',
                'youtube_url' => 'https://www.youtube.com/channel/agence-pharmacol',
                'email_contact' => 'contact@agence-pharmacol.com'
            ];
            $general = array_merge($generalDefaults, $general);
            
            $chiffres[] = $general;

            \Storage::put('chiffres.json', json_encode($chiffres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return back()->with('success', 'Chiffres mis à jour !');
        }

        public function index()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            return view('admin.dashboard', compact('chiffres'));
        }
    }
?>


