<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Models\User;

use App\Models\Common\BaseModel;
use App\Models\HelpRequest\HelpRequest;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * App\Models\User\User
 *
 * @property int                                                                                                            $id
 * @property int                                                                                                            $user_type_id
 * @property int                                                                                                            $user_status_id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $email
 * @property string                                                                                                         $phone
 * @property string                                                                                                         $password
 * @property string|null                                                                                                    $remember_token
 * @property string                                                                                                         $address
 * @property string                                                                                                         $city
 * @property string                                                                                                         $zip_code
 * @property bool                                                                                                           $nearby_areas_id
 * @property \Illuminate\Support\Carbon|null                                                                                $email_verified_at
 * @property \Illuminate\Support\Carbon|null                                                                                $created_at
 * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HelpRequest\HelpRequest[]                            $assignedHelpRequests
 * @property-read int|null                                                                                                  $assigned_help_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HelpRequest\HelpRequest[]                            $helpRequests
 * @property-read int|null                                                                                                  $help_requests_count
 * @property-read \App\Models\User\NearbyAreas                                                                              $nearbyAreas
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null                                                                                                  $notifications_count
 * @property-read \App\Models\User\UserStatus                                                                               $status
 * @property-read \App\Models\User\UserType                                                                                 $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereNearbyAreasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUserStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUserTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereZipCode($value)
 * @mixin \Eloquent
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject {

    use Notifiable, Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'phone', 'password', 'remember_token',
        'user_type', 'address', 'city', 'zip_code', 'nearby_areas_id',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    protected $casts = [
        'email'             => 'string',
        'nick'              => 'string',
        'phone'             => 'string',
        'address'           => 'string',
        'city'              => 'string',
        'zip_code'          => 'string',
        'nearby_areas_id'   => 'boolean',
        'user_status_id'    => 'integer',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Related type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /**
     * Related user Status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo(UserStatus::class, 'user_status_id');
    }

    /**
     * Related nearby areas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nearbyAreas() {
        return $this->belongsTo(NearbyAreas::class, 'nearby_areas_id');
    }

    /**
     * Associated help requests.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpRequests() {
        return $this->hasMany(HelpRequest::class, 'user_id');
    }

    /**
     * Associated asignated help requests.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedHelpRequests() {
        return $this->hasMany(HelpRequest::class, 'assigned_user_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
