<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pour les headers de sécurité HTTP
 * 
 * Ajoute les headers de sécurité OWASP recommandés
 * pour protéger contre les attaques communes
 */
class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // ============================================
        // 🔐 HEADERS DE SÉCURITÉ CRITIQUES
        // ============================================

        // ✅ X-Frame-Options : Prévenir le clickjacking
        // DENY : Page ne peut pas être affichée en iframe
        $response->header('X-Frame-Options', 'DENY');

        // ✅ X-Content-Type-Options : Prévenir le MIME-sniffing
        // nosniff : Empêcher le navigateur de deviner le type MIME
        $response->header('X-Content-Type-Options', 'nosniff');

        // ✅ X-XSS-Protection : Prévention XSS (héritage)
        // Protection complète avec rapport d'erreur
        $response->header('X-XSS-Protection', '1; mode=block');

        // ✅ Content-Security-Policy (CSP) : Protection XSS avancée
        // Ultra restrictif : script uniquement depuis l'app elle-même
        $csp = [
            "default-src 'self'",                           // Tout depuis le même domaine
            "script-src 'self' 'unsafe-inline'"  ,          // Scripts locaux ou inline React/Vite
            "style-src 'self' 'unsafe-inline'",             // CSS local ou inline Tailwind
            "img-src 'self' data: https:",                  // Images locales ou HTTPS
            "font-src 'self' data:",                        // Fonts locales
            "connect-src 'self' https:",                    // Connexions API locales/HTTPS
            "frame-ancestors 'none'",                       // Pas d'iframe
            "base-uri 'self'",                              // Base URL restriction
            "form-action 'self'",                           // Formulaires seulement vers soi-même
            "upgrade-insecure-requests",                    // HTTP -> HTTPS
        ];
        $cspHeader = implode('; ', $csp);
        $response->header('Content-Security-Policy', $cspHeader);
        $response->header('Content-Security-Policy-Report-Only', $cspHeader);

        // ✅ Referrer-Policy : Contrôler les informations de référent
        // strict-origin-when-cross-origin : Info minimale en cross-origin
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ✅ Permissions-Policy (anciennement Feature-Policy)
        // Désactiver les features dangereuses
        $permissions = [
            'accelerometer=()',                 // Pas d'accès accéléromètre
            'camera=()',                        // Pas de caméra
            'geolocation=()',                   // Pas de géolocalisation
            'gyroscope=()',                     // Pas de gyroscope
            'magnetometer=()',                  // Pas de magnétomètre
            'microphone=()',                    // Pas de micro
            'payment=()',                       // Pas d'API Payment
            'usb=()',                           // Pas d'accès USB
            'vr=()',                            // Pas de réalité virtuelle
            'xr-spatial-tracking=()',           // Pas de suivi spatial
        ];
        $response->header('Permissions-Policy', implode(', ', $permissions));

        // ✅ Strict-Transport-Security : HTTPS obligatoire
        // max-age: 31536000 (1 an), includeSubDomains, preload
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // ✅ X-Permitted-Cross-Domain-Policies : Pas de crossdomain.xml
        $response->header('X-Permitted-Cross-Domain-Policies', 'none');

        // ✅ Cache-Control : Prévenir la mise en cache sensible
        if ($request->is('admin', 'admin/*')) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, private');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Thu, 01 Jan 1970 00:00:01 GMT');
        }

        // ✅ Server header : Masquer les infos serveur
        $response->header('Server', 'Secure Server');

        // ✅ Cross-Origin-Embedder-Policy
        $response->header('Cross-Origin-Embedder-Policy', 'require-corp');

        // ✅ Cross-Origin-Opener-Policy
        $response->header('Cross-Origin-Opener-Policy', 'same-origin');

        // ✅ Cross-Origin-Resource-Policy
        $response->header('Cross-Origin-Resource-Policy', 'same-site');

        return $response;
    }
}
