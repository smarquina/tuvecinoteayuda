<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 12:15
 */

namespace App\Models\User;


use App\Models\Common\BaseNameTable;

/**
 * App\Models\User\UserStatus
 *
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserStatus extends BaseNameTable {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_status';
}
