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
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HelpRequest
 *
 * @property int $id
 * @property int $user_id
 * @property int $help_request_type
 * @property string $message
 * @property int|null $assigned_user_id
 * @property string|null $accepted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereHelpRequestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest whereUserId($value)
 * @mixin \Eloquent
 */
class HelpRequest extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'help_request_type', 'message', 'assigned_user_id', 'accepted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'accepted_at' => 'datetime',
    ];
}
