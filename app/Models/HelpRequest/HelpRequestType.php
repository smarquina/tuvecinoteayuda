<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Models\HelpRequest;

use App\Models\Common\BaseModel;


/**
 * App\Models\HelpRequest\HelpRequestType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequestType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HelpRequestType extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'help_request_types';
}
