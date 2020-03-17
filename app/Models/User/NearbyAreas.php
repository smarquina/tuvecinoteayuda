<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 12:17
 */

namespace App\Models\User;


use App\Models\Common\BaseNameTable;

/**
 * App\Models\User\NearbyAreas
 *
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas whereNearbyAreascol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\NearbyAreas whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NearbyAreas extends BaseNameTable {

    const MY_BUILDING           = 1;
    const MY_NEIGHBORHOOD       = 2;
    const MY_CITY               = 3;
    const CITY_AND_SURROUNDINGS = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nearby_areas';
}
