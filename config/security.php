<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuration de sécurité globale
    |--------------------------------------------------------------------------
    |
    | Paramètres de sécurité centralisés pour l'application
    | Niveaux de sécurité : low, medium, high, maximum
    |
    */

    'level' => env('SECURITY_LEVEL', 'maximum'),

    /*
    |--------------------------------------------------------------------------
    | VALIDATION DES ENTRÉES
    |--------------------------------------------------------------------------
    */
    'validation' => [
        // Stricte validation des emails
        'email_strict' => true,
        
        // Vérifier les emails existants
        'email_verification' => true,
        
        // Longueur minimum des mots de passe
        'password_min_length' => 12,
        
        // Exiger des caractères spéciaux
        'password_special_chars' => true,
        
        // Exiger des chiffres
        'password_numbers' => true,
        
        // Exiger des majuscules
        'password_uppercase' => true,
        
        // Maximum de tentatives de login
        'login_max_attempts' => 5,
        
        // Durée du blocage après tentatives (minutes)
        'login_lockout_duration' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | SANITISATION
    |--------------------------------------------------------------------------
    */
    'sanitization' => [
        // Nettoyer les balises HTML
        'strip_html_tags' => true,
        
        // Encoder les caractères HTML
        'html_encode' => true,
        
        // Supprimer les null bytes
        'remove_null_bytes' => true,
        
        // Nettoyer les entrées SQL
        'sql_safe' => true,
        
        // Nettoyer les entrées JavaScript
        'js_safe' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | AUTHENTIFICATION & SESSIONS
    |--------------------------------------------------------------------------
    */
    'auth' => [
        // Durée de la session (minutes)
        'session_lifetime' => 120,
        
        // Durée du "Remember me" (jours)
        'remember_me_duration' => 7,
        
        // Renouveller le session ID à chaque login
        'regenerate_session' => true,
        
        // Vérifier l'user agent pour les sessions
        'verify_user_agent' => true,
        
        // Vérifier l'IP pour les sessions
        'verify_ip_address' => true,
        
        // Double authentification TOTP (futur)
        'two_factor_enabled' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | RATE LIMITING
    |--------------------------------------------------------------------------
    */
    'rate_limiting' => [
        // Requêtes API par minute
        'api_requests_per_minute' => 60,
        
        // Requêtes login par heure
        'login_requests_per_hour' => 20,
        
        // Requêtes password reset par heure
        'password_reset_per_hour' => 5,
        
        // Activer le rate limiting global
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | HEADERS DE SÉCURITÉ HTTP
    |--------------------------------------------------------------------------
    */
    'http_headers' => [
        // X-Frame-Options
        'x_frame_options' => 'DENY',
        
        // X-Content-Type-Options
        'x_content_type_options' => 'nosniff',
        
        // Strict-Transport-Security (HTTPS)
        'hsts_enabled' => true,
        'hsts_max_age' => 31536000, // 1 an
        'hsts_include_subdomains' => true,
        'hsts_preload' => true,
        
        // Content-Security-Policy
        'csp_enabled' => true,
        'csp_report_only' => false,
        
        // X-XSS-Protection
        'x_xss_protection' => '1; mode=block',
        
        // Referrer-Policy
        'referrer_policy' => 'strict-origin-when-cross-origin',
    ],

    /*
    |--------------------------------------------------------------------------
    | CHIFFREMENT
    |--------------------------------------------------------------------------
    */
    'encryption' => [
        // Algorithme de hachage mot de passe
        'password_algorithm' => 'bcrypt',
        
        // Rounds bcrypt
        'bcrypt_rounds' => 12,
        
        // Algorithme de chiffrement (AES-256-CBC)
        'cipher' => 'AES-256-CBC',
        
        // Chiffrer les cookies sensibles
        'encrypt_cookies' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | UPLOAD DE FICHIERS
    |--------------------------------------------------------------------------
    */
    'file_upload' => [
        // Extensions interdites strictement
        'forbidden_extensions' => [
            'exe', 'bat', 'cmd', 'com', 'pif', 'scr', 'vbs', 'js',
            'jar', 'zip', 'rar', 'dll', 'msi', 'app', 'dmg',
            'php', 'php3', 'php4', 'php5', 'phtml', 'phar',
            'asp', 'aspx', 'jsp', 'jspx', 'py', 'pl', 'sh',
        ],
        
        // Types MIME autorisés
        'allowed_mimes' => [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ],
        
        // Taille maximum (MB)
        'max_file_size' => 10,
        
        // Vérifier la signature du fichier (magic bytes)
        'verify_magic_bytes' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | LOGGING & AUDIT
    |--------------------------------------------------------------------------
    */
    'logging' => [
        // Logger tous les logins
        'log_logins' => true,
        
        // Logger tous les changements sensibles
        'log_changes' => true,
        
        // Logger tous les accès admin
        'log_admin_access' => true,
        
        // Logger les tentatives échouées
        'log_failed_attempts' => true,
        
        // Niveau de détail (stack, single, daily)
        'channel' => 'daily',
    ],

    /*
    |--------------------------------------------------------------------------
    | API SECURITY
    |--------------------------------------------------------------------------
    */
    'api' => [
        // Exiger HTTPS/TLS 1.2+
        'require_https' => true,
        
        // Exiger API key
        'require_api_key' => true,
        
        // Validation JWT
        'jwt_enabled' => true,
        'jwt_secret' => env('JWT_SECRET', 'secret-key-change-me'),
        
        // Token expiration (heures)
        'token_expiration' => 24,
        
        // Refresh token expiration (jours)
        'refresh_token_expiration' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | DATABASE SECURITY
    |--------------------------------------------------------------------------
    */
    'database' => [
        // Utiliser des prepared statements (Eloquent par défaut)
        'use_prepared_statements' => true,
        
        // Chiffrer les connexions BD
        'ssl_connection' => env('DB_SSL', false),
        
        // Timeout de connexion (secondes)
        'connection_timeout' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | XSS PREVENTION
    |--------------------------------------------------------------------------
    */
    'xss_prevention' => [
        // Encoder la sortie par défaut
        'encode_output' => true,
        
        // Nettoyer l'HTML en entrée
        'sanitize_html' => true,
        
        // Autoriser les tags HTML sûrs
        'allowed_html_tags' => [
            'b', 'i', 'em', 'strong', 'p', 'br', 'ul', 'ol', 'li', 'a',
            'blockquote', 'code', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CORS SECURITY
    |--------------------------------------------------------------------------
    */
    'cors' => [
        // Ne pas accepter les origins arbitraires
        'restrict_origins' => true,
        
        // Whitelist stricte des origins
        'allowed_origins' => [
            'https://pharmacol.com',
            'https://www.pharmacol.com',
        ],
        
        // Credentials obligatoires
        'require_credentials' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | SECURITY SCANNING
    |--------------------------------------------------------------------------
    */
    'scanning' => [
        // Vérifier les dépendances npm régulièrement
        'npm_audit' => true,
        
        // Vérifier les dépendances Composer
        'composer_audit' => true,
        
        // Vérifier les mises à jour de sécurité
        'update_check' => true,
    ],
];
