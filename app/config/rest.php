<?php
/**
 *  dFramework
 *
 *  The simplest PHP framework for beginners
 *  Copyright (c) 2019, Dimtrov Sarl
 *  This content is released under the Mozilla Public License 2 (MPL-2.0)
 *
 *  @package	dFramework
 *  @author	    Dimitri Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 *  @copyright	Copyright (c) 2019, Dimtrov Sarl. (https://dimtrov.hebfree.org)
 *  @copyright	Copyright (c) 2019, Dimitri Sitchet Tomkeu. (https://www.facebook.com/dimtrovich)
 *  @license	https://opensource.org/licenses/MPL-2.0 MPL-2.0 License
 *  @homepage	https://dimtrov.hebfree.org/works/dframework
 *  @version    3.1
 */


 /*
| -------------------------------------------------------------------
| REST SETTINGS OF APPLICATION
| -------------------------------------------------------------------
| This file will contain the configurations of REST component for creation your web services.
|
| For complete instructions please consult the 'Rest Configuration' in User Guide.
|
*/




/*
|--------------------------------------------------------------------------
| REST Language File
|--------------------------------------------------------------------------
|
| Language file to load from the language directory
|
*/
$rest['language'] = 'en';

/*
|--------------------------------------------------------------------------
| HTTP protocol
|--------------------------------------------------------------------------
|
| Set to force the use of HTTPS for REST API calls
|
*/
$rest['force_https'] = false;

/*
|--------------------------------------------------------------------------
| Allowable Methods
|--------------------------------------------------------------------------
|
| List of authorize method to access in web service
|
*/
$rest['allowed_methods'] = [
  'GET',
  'POST',
  'OPTIONS',
  'PUT',
  'PATCH',
  'DELETE',
];

/*
|--------------------------------------------------------------------------
| REST Output Format
|--------------------------------------------------------------------------
|
| The default format of the response
|
| 'array':      Array data structure
| 'csv':        Comma separated file
| 'json':       Uses json_encode(). Note: If a GET query string
|               called 'callback' is passed, then jsonp will be returned
| 'php':        Uses var_export()
| 'serialized':  Uses serialize()
| 'xml':        Uses simplexml_load_string()
|
*/
$rest['return_format'] = 'json';

/*
|--------------------------------------------------------------------------
| REST Status Field Name
|--------------------------------------------------------------------------
|
| The field name for the status inside the response
|
*/
$rest['status_field_name'] = 'status';

/*
|--------------------------------------------------------------------------
| REST Message Field Name
|--------------------------------------------------------------------------
|
| The field name for the message inside the response
|
*/
$rest['message_field_name'] = 'error';

/*
|--------------------------------------------------------------------------
| REST Handle Exceptions
|--------------------------------------------------------------------------
|
| Handle exceptions caused by the controller
|
*/
$rest['handle_exceptions'] = true;

/*
|--------------------------------------------------------------------------
| Global IP Blacklisting
|--------------------------------------------------------------------------
|
| Prevent connections to the REST server from blacklisted IP addresses
|
| Usage:
| 1. Set to TRUE and add any IP address to 'ip_blacklist'
|
*/
$rest['ip_blacklist_enabled'] = false;

/*
|--------------------------------------------------------------------------
| REST IP Blacklist
|--------------------------------------------------------------------------
|
| Prevent connections from the following IP addresses
|
| e.g: ['123.456.789.0', '987.654.32.1']
|
*/
$rest['ip_blacklist'] = [];

/*
|--------------------------------------------------------------------------
| Global IP White-listing
|--------------------------------------------------------------------------
|
| Limit connections to your REST server to White-listed IP addresses
|
| Usage:
| 1. Set to TRUE and select an auth option for extreme security (client's IP
|    address must be in white-list and they must also log in)
| 2. Set to TRUE with auth set to FALSE to allow White-listed IPs access with no login
| 3. Set to FALSE but set 'auth_override_class_method' to 'white-list' to
|    restrict certain methods to IPs in your white-list
|
*/
$rest['ip_whitelist_enabled'] = false;

/*
|--------------------------------------------------------------------------
| REST IP White-list
|--------------------------------------------------------------------------
|
| Limit connections to your REST server with a comma separated
| list of IP addresses
|
| e.g: '123.456.789.0, 987.654.32.1'
|
| 127.0.0.1 and 0.0.0.0 are allowed by default
|
*/
$rest['ip_whitelist'] = [];

/*
|--------------------------------------------------------------------------
| REST AJAX Only
|--------------------------------------------------------------------------
|
| Set to TRUE to allow AJAX requests only. Set to FALSE to accept HTTP requests
|
| Note: If set to TRUE and the request is not AJAX, a 505 response with the
| error message 'Only AJAX requests are accepted.' will be returned.
|
| Hint: This is good for production environments
|
*/
$rest['ajax_only'] = false;

/*
|--------------------------------------------------------------------------
| REST Auth
|--------------------------------------------------------------------------
|
| Set to specify the REST API requires to be logged in
|
| FALSE     No login required
| 'jwt'     Jeton Web Token with Bearer header
| 'session' Check for a PHP session variable. See 'auth_source' to set the
|           authorization key
*/
$rest['auth'] = false;

/*
|--------------------------------------------------------------------------
| REST JWT Configuration
|--------------------------------------------------------------------------
|
| Set the configuration of jwt algorithm's
|
*/
$rest['jwt'] = [
    /**
     * Cle du token
     */
    'key' => 'df_jwt_key',
    /**
     * Temps d'expiration du token en minute
     */
    'exp_time' => 5,

];


return compact('rest');