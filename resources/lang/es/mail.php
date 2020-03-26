<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 21/03/2020
 * Time: 2:49
 */

return [
    'common'       => ['hi_user'      => '¡Hola :user!',
                       'hi'           => '¡Hola!',
                       'welcome'      => 'Estimado/a :user, bienvenido/a a Tu vecino te ayuda.',
                       'no_print'     => 'Por favor considere el medio ambiente antes de imprimir este correo electrónico!',
                       'not_attended' => 'No responda a este correo. Esta cuenta no es atendida',
                       'team'         => "<br> Recibe un cordial saludo del equipo de Tu Vecino te Ayuda. <br> Y recuerda ¡NO ESTÁS SOLO!",
                       'action_text'  => "Si encuentra algún problema al pulsar el botón \":actionText\", copie y peque la siguiente URL \n" .
                                         'en la barra de direcciones de su navegador: <a href=\':actionURL\'>:actionURL</a>',
                       'rights'       => 'Todos los derechos reservados',
                       'protocols'    => 'Protocolos',
                       'policies'     => "Aviso Legal, privacidad y cookies",
    ],
    'auth'         => [
        'resetPassword' => [
            'subject'    => 'Cambio de contraseña',
            'body'       => "Hemos recibido una solicitud de cambio de contraseña para tu usuario. Si no has sido tú
                             no te preocupes, ignora este mensaje.<br> Puedes acceder al cambio de contraseña desde
                             el siguiente enlace:'",
            'expiration' => "Su enlace para restablecer la contraseña caducará en :count minutos.",
            'act_btn'    => 'Establecer contraseña',
        ],
        'newUser'       => [
            'subject'          => 'Bienvenido a ' . config('app.name'),
            'body_requester'   => "Para empezar a recibir ayuda de tus vecinos valida tu correo con el enlace a continuación.
                                 Después podrás publicar qué tipo de ayuda solicitas desde tu <a href=':profileURL'>perfil</a>
                                 y un voluntario se pondrá en contacto contigo.",
            'body_volunteer'   => "Para empezar a prestar ayuda a tus vecinos valida tu correo con el enlace a continuación.
                                 Después podrás revisar las solicitudes de ayuda en tu zona desde tu <a href=':profileURL'>perfil</a>
                                  y marcar a qué solicitudes deseas prestar ayuda.",
            'body_association' => "Para empezar a gestionar voluntarios de tu entidad valida tu correo con el enlace a continuación.
                                 Después podrás coordinar y gestionar a tus voluntarios desde tu <a href=':profileURL'>perfil</a>",
            'act_btn'          => 'Activar usuario',
        ],
    ],
    'help_request' => [
        'accepted_requester'  => [
            'subject' => 'Su petición de ayuda va a ser atendida por su vecin@!',
            'body'    => "Tu solicitud de ayuda :description ha sido aceptada por :name.
                          En tu <a href=':profileURL'>perfil</a> puedes ver más información y contactar con el vecino/a que se ha ofrecido a ayudarte.",
            'act_btn' => 'Ir a mi perfil',
        ],
        'accepted_volunteer'  => [
            'subject' => 'Gracias por atender la petición de tu vecin@!',
            'body'    => "Gracias por atender la petición de tu vecin@: \' :description \' \n
                          A continuación tienes los datos de tu vecino/a para que te puedas poner en contacto: \n
                                - :name
                                - :telephone",
            'act_btn' => 'Ir a mi perfil',
        ],
        'cancelled_requester' => [
            'subject' => 'Su petición de ayuda ha sido cancelada',
            'body'    => "El usuario :name ha eliminado su solicitud de ayuda \":description\",
                            pero no te preocupes, puedes seguir ayudando. \n
                            Busca otras solicitudes en tu zona en tu <a href=':profileURL'>perfil</a>.",
            'act_btn' => 'Ir a mi perfil',
        ],
        'cancelled_volunteer' => [
            'subject' => 'El voluntario ha declinado su ofrecimiento',
            'body'    => 'El voluntario :name ha declinado su ofrecimiento de ayuda a tu solicitud ":description". \n
                        Te informaremos cuando algún otro voluntario en tu zona acepte tu solicitud.',
            'act_btn' => 'Ir a mi perfil',
        ],
        'new'                 => [
            'subject' => 'Uno de tus vecinos necesita tu ayuda.',
            'body'    => 'Uno de tus vecinos necesita tu ayuda. Acepta su solicitud en tu <a href=\':profileURL\'>perfil</a>. \n
                          Muchas gracias por ayudar.',
            'act_btn' => 'Ir a mi perfil',
        ],
    ],
    'association' => [
        'user_joined'                 => [
            'subject' => 'Un usuario se ha unido a la asociación.',
            'body'    => ':name se ha unido a <i>:association</i>. Puedes ver su información desde tu <a href=\':profileURL\'>perfil</a>. \n
                          Muchas gracias por ayudar.',
            'act_btn' => 'Ir a mi perfil',
        ],
    ],
];
