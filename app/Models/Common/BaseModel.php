<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 2:19
 */

namespace App\Models\Common;

/**
 * App\Models\Common\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends \Eloquent {

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $dateFormat = "d/m/Y h:i";
}
