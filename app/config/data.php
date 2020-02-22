<?php

/*
| -------------------------------------------------------------------
| DATAS SETTINGS OF APPLICATION
| -------------------------------------------------------------------
| This file will contain the datas settings of your application.
|
| For complete instructions please consult the 'Data Configuration' in User Guide.
|
*/



/*
|--------------------------------------------------------------------------
|PHP ERRORS SAVE
|--------------------------------------------------------------------------
|
| Specifie le fichier où seront renseignées les erreurs d'execution
|   Le fichier specifié prend ses bases à la racine du site (au meme niveau que le fichier.htaccess)
*/
$data['log_file'] = 'df_phplogfile.txt';

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
*/
$data['encryption'] = [
    /**
     * KEY
     *  La cle de chiffrement des donnees de l'application (cookie, et donnees chiffrées avec la librairie Crypto)
     * 
     * @var string
     */
    'key' => 't568hujkjdfghjudv45rt6y7u3edf3eq',

    /**
     * ALGO
     *  Specifie l'algorithme à utiliser pour le chiffrement des donnees
     * 
     * @var string
     */
    'algo' => 'CAST5-CBC',

    /**
     * ADD_HMAC
     *  Specifie si on doit ajouter un hmac a la fin d'un chiffrement (utilisé dans la librairie Crypto)
     * 
     * @var bool
     */
    'add_hmac' => true,
];


/*
| -------------------------------------------------------------------
| SESSION SETTINGS OF APPLICATION
| -------------------------------------------------------------------
| This section will contain the sessions settings of your application.
*/
$data['session'] = [
    /**
     * NAME
     *  Definit le nom de la session de votre application
     * 
     * @var string
     */
    'name' => 'df_app',

    /**
     * CACHE_LIMITER 
     */
    'cache_limiter' => 'private',

    /**
     * LIFETIME
     *  Temps d'expirara du cache de session en minute
     * 
     * @var int
     */
    'lifetime' => 60,

    /**
     * EXPIRE
     *  The number of SECONDS you want the session to last.
     *  Setting to 0 (zero) means expire when the browser is closed.
     * 
     * @var int
     */
    'expire' => 7200,
];


/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
*/
$data['cookies'] = [
    /**
     * PREFIX
     *  Set a cookie name prefix if you need to avoid collisions
     * 
     * @var string
     */
    'prefix'   => '',
    /**
     * DOMAIN
     *  Set to .your-domain.com for site-wide cookies
     * 
     * @var string
     */
    'domain'   => '',
    /**
     * PATH
     *  Typically will be a forward slash
     * 
     * @var string
     */
    'path'     => '/',
    /**
     * SECURE
     *  Cookie will only be set if a secure HTTPS connection exists.
     *  Whether to only transfer cookies via SSL
     * 
     * @var bool
     */
    'secure'   => false,
    /**
     * HTTPONLY
     *  Cookie will only be accessible via HTTP(S) (no javascript)
     *  Whether to only makes the cookie accessible via HTTP (no javascript)
     * 
     * @var bool
     */
    'httponly' => true,
];


/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
*/
$data['csrf'] = [
    /**
     * PROTECTION
     * 
     * @var bool
     */
    'protection'    => false,

    /**
     * TOKEN_NAME
     *  The token name
     * 
     * @var string
     */
    'token_name'    => 'csrf_test_name',

    /**
     * COOKIE_NAME
     *  The cookie name
     * 
     * @var string
     */
    'cookie_name'   => 'csrf_cookie_name',

    /**
     * EXPIRE
     *  The number in seconds the token should expire.
     * 
     * @var int
     */
    'expire'        => 7200,
    
    /**
     * REGENERATE
     *  Regenerate token on every submission
     * 
     * @var bool
     */
    'regenerate'    => true,

    /**
     * EXCLUDE_URIS
     *  Array of URIs which ignore CSRF checks
     * 
     * @var array
     */
    'exclude_uris'  => []
];


/*
|--------------------------------------------------------------------------
| Hydrator
|--------------------------------------------------------------------------
| Set a configuration of sql entities hydratator
*/
$data['hydrator'] = [
    /**
     * CASE
     *  Specifie si le nom des colones issues de la bd doivent etre convertie
     *  Les valeurs admissible sont camel (camelcase), pascal(pascalcase), null (rien)
     * 
     * @var string|null
     */
    'case'    => 'camel'
];


/**
 * DON'T TOUCH THIS LINE. IT'S USING BY CONFIG CLASS
 */
return compact('data');