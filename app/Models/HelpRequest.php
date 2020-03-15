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
 * App\Models\HelpRequest
 *
 * @property int                              $id
 * @property int                              $user_id
 * @property int                              $help_request_type
 * @property string                           $message
 * @property int|null                         $assigned_user_id
 * @property string|null                      $accepted_at
 * @property \Illuminate\Support\Carbon|null  $created_at
 * @property \Illuminate\Support\Carbon|null  $updated_at
 * @property-read \App\Models\HelpRequestType $type
 * @property-read \App\Models\User            $user
 * @property-read \App\Models\User|null       $assignedUser
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
class HelpRequest extends BaseModel {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'help_request_type', 'message', 'assigned_user_id', 'accepted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'accepted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'user_id'           => 'integer',
        'help_request_type' => 'integer',
        'message'           => 'string',
        'assigned_user_id'  => 'integer',
        'accepted_at'       => 'datetime',
    ];


    /**
     * Related user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Related help request type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(HelpRequestType::class);
    }

    /**
     * Related assigned user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
