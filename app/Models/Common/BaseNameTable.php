<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 12:16
 */

namespace App\Models\Common;


/**
 * App\Models\Common\BaseNameTable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseNameTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseNameTable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\BaseNameTable query()
 * @mixin \Eloquent
 */
class BaseNameTable extends BaseModel {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];
}
