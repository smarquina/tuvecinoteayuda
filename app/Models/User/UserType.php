<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Models\User;

use App\Models\Common\BaseNameTable;


/**
 * App\Models\User\UserType
 *
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserType extends BaseNameTable {

    const USER_TYPE_REQUESTER   = 1;
    const USER_TYPE_VOLUNTEER   = 2;
    const USER_TYPE_ASSOCIATION = 3;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_types';
}
