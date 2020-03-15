<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API header
    |--------------------------------------------------------------------------
    |
    | Headers validation
    |
    */
    'api_no_compat'       => 'Versión de Api no soportada',
    'compilation_invalid' => 'Por favor, actualice su aplicación para poder continuar',
    'auth_invalid'        => 'Falta el tipo de autorización',
    'headers_incomplete'  => 'Las cabeceras de la petición están incompletas',
    'headers_error'       => 'Hay un problema en las cabeceras de la petición',

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'          => 'Estas credenciales no coinciden con nuestros registros.',
    'throttle'        => 'Demasiados intentos de acceso. Por favor intente nuevamente en :seconds segundos.',
    'forbidden'       => 'No tiene permisos para realizar esta acción',
    'expired_request' => 'La petición ha caducado. Pruebe a solicitar de nuevo.',

    /*
	 |--------------------------------------------------------------------------
	 | User
	 |--------------------------------------------------------------------------
	 |
	 */
    "verification"    => array(
        "error"    => "No se ha podido activar el usuario",
        "correcto" => "Usuario activado correctamente",
    ),
    "login"           => array(
        "disabled"     => "El usuario está deshabilitado.",
        "invalidCred"  => "Credenciales de usuario inválidas.",
        "userNoExist"  => "No existe ningún usuario con ese nombre.",
        "noToken"      => "No se puede generar el token de usuario.",
        "invalidEmail" => "El email es inválido.",
        "blocked"      => "El usuario se encuentra bloqueado.",
    ),
    "logout"          => array(
        'success' => 'Se ha cerrado sesión',
    ),
];
