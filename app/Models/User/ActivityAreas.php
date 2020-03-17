<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 17/03/2020
 * Time: 19:45
 */

namespace App\Models\User;

use App\Models\Common\BaseNameTable;

/**
 * App\Models\User\ActivityAreas
 *
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas whereActivityAreascol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\ActivityAreas whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActivityAreas extends BaseNameTable {

    const N_A        = 1;
    const LOCAL     = 2;
    const STATE     = 3;
    const NATIONAL  = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_areas';
}
