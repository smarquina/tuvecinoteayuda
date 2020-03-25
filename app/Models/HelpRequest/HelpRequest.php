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
use App\Models\User\User;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\HelpRequest\HelpRequest
 *
 * @property int                                                                   $id
 * @property int                                                                   $user_id
 * @property int                                                                   $help_request_type_id
 * @property string                                                                $message
 * @property \Illuminate\Support\Carbon|null                                       $accepted_at
 * @property \Illuminate\Support\Carbon|null                                       $created_at
 * @property \Illuminate\Support\Carbon|null                                       $updated_at
 * @property \Illuminate\Support\Carbon|null                                       $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $assignedUser
 * @property-read int|null                                                         $assigned_user_count
 * @property-read \App\Models\HelpRequest\HelpRequestType                          $type
 * @property-read \App\Models\User\User                                            $user
 * @method static bool|null forceDelete()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereHelpRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HelpRequest\HelpRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HelpRequest\HelpRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HelpRequest\HelpRequest withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $track_external_call
 * @property string|null $track_external_call_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereTrackExternalCall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HelpRequest\HelpRequest whereTrackExternalCallAt($value)
 */
class HelpRequest extends BaseModel {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'help_requests';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'help_request_type_id', 'message', 'assigned_user_id', 'accepted_at', 'track_external_call', 'track_external_call_at',
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
        'id'                   => 'integer',
        'user_id'              => 'integer',
        'help_request_type_id' => 'integer',
        'message'              => 'string',
        'assigned_user_id'     => 'integer',
        'accepted_at'          => 'datetime',
    ];


    /**
     * Related user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Related help request type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(HelpRequestType::class, 'help_request_type_id');
    }

    /**
     * Related assigned user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assignedUser() {
        return $this->belongsToMany(User::class, 'help_requests_has_assigned_user',
                                    'help_request_id',
                                    'user_id');
    }
}
