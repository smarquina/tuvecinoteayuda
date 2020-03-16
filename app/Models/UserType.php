<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Models;

use App\Models\Common\BaseModel;

/**
 * App\Models\UserType
 *
 * @property int    $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType whereName($value)
 * @mixin \Eloquent
 */
class UserType extends BaseModel {
    const USER_TYPE_REQUESTER = 1;
    const USER_TYPE_VOLUNTEER = 2;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_types';

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
