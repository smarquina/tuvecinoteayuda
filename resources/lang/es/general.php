<?php
/**
 * Created for bet4g.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 30/08/2018
 * Time: 1:48
 */

return ['bool'       => ['yes' => 'Si',
                         'no'  => 'No',],
        'ajax'       => ['unsupported' => 'Operación no soportada',],
        'model'      => ['update'             => ['correct' => ':Value actualizado correctamente.',
                                                  'error'   => 'Se ha producido un error al actualizar el registro',],
                         'store'              => ['correct' => ':Value creado correctamente.',
                                                  'error'   => 'Se ha producido un error al crear el registro',],
                         'find'               => ['error' => 'Registro no encontrado',],
                         'delete'             => ['correct' => ':Value eliminado correctamente.',
                                                  'error'   => 'Se ha producido un error al eliminar el registro',],
                         'copy'               => ['correct' => ':Value duplicado correctamente.',
                                                  'error'   => 'Se ha producido un error al duplicar el registro',],
                         'alignment'          => ['center' => 'Centrado',
                                                  'left'   => 'Izquierda',
                                                  'right'  => 'Derecha',],
                         'vertical_alignment' => ['medium' => 'Medio',
                                                  'bottom' => 'Inferior/normal',
                                                  'top'    => 'Superíndice',],
                         'reorder'            => ['reorder_ok'    => 'Se ha reordenado correctamente.',
                                                  'reorder_error' => 'Ha habido un problema al reordenar.',],],
        'file'       => ['upload_ok'    => 'Fichero Subido correctamente.',
                         'upload_error' => 'Ha ocurrido un error al subir el fichero.',],
        'buttons'    => ['save'   => 'Guardar',
                         'cancel' => 'Cancelar',
                         'back'   => 'Volver',
                         'delete' => 'Eliminar',
                         'close'  => 'Cerrar',
                         'edit'   => 'Editar',
                         'accept' => 'Aceptar',],
        'permission' => [

        ],
        'attributes' => [
            'id'          => 'ID',
            'name'        => 'Nombre',
            'status_id'   => 'Estado',
            'user_id'     => 'Usuario',
            'description' => 'Descripción',
            'created_at'  => 'Fecha creación',
            'updated_at'  => 'Última actualización',
            'lang'        => 'Idioma',
            'image'       => 'Imagen',

            'date_from'   => 'Fecha inicio',
            'date_to'     => 'Fecha finalización',
            'date'        => 'Fecha',
            'location'    => 'Localización',
            'position'    => 'Posición',

            'actions' => 'Acciones',
        ],
];
