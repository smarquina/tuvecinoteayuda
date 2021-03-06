<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 18/03/2020
 * Time: 1:38
 */

return [
    'attributes'   => [
        'user_type_id'          => "Tipo de usuario",
        'nearby_areas_id'       => "Zonas",
        'password_confirmation' => "Confirmación de contraseña",
        'activity_areas_id'     => "Ámbito",
        'corporate_name'        => "Nombre corporativo",
        'cif'                   => "CIF/NIF",
        'token'                 => 'Código de seguridad',
    ],
    'association'  => [
        'join'   => [
            'correct' => 'Te has unido correctamente a la asociación :value',
            'error'   => 'No podemos localizar esa asociación',
        ],
        'detach' => [
            'correct' => 'Ahora ya no estás asociado a :value',
            'error'   => 'No podemos localizar esa asociación',
        ],
    ],
    'verification' => [
        'connection_error' => 'No podemos conectar con el servicio de verificación de usuarios.',
        'error'            => 'No podemos verificar el DNI, envíe una  foto de más calidad o revise los datos',
        'correct'          => 'Gracias por verificar tus datos.',
        'dni_invalid'      => 'El DNI proporcionado no es válido',
    ],
];
