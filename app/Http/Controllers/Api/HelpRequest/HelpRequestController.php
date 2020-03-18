<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\HelpRequest;

use App\Http\Controllers\Api\ApiController;
use App\Http\Enums\HttpErrors;
use App\Http\Requests\Help\HelpRequestRequest;
use App\Models\HelpRequest\HelpRequest;
use App\Models\User\NearbyAreas;
use App\Models\User\User;
use App\Models\User\UserType;
use App\Resources\HelpRequest\HelpRequestResource;
use App\Resources\HelpRequest\HelpRequestsCollection;
use Illuminate\Http\Request;

class HelpRequestController extends ApiController {

    /**
     * HelpRequestController constructor.
     */
    public function __construct() {
        $this->middleware("user.type:" . UserType::USER_TYPE_VOLUNTEER)
             ->only('accept');
    }

    /**
     * list with pending help requests.
     *
     * @return HelpRequestsCollection
     */
    public function pending() {
        /** @var User $user */
        $user = \Auth::user();

        $helpRequests = HelpRequest::withCount(['assignedUser', 'user'])
                                   ->get()
                                   ->where('assigned_user_count', 0);

        switch ($user->nearby_areas_id) {
            case NearbyAreas::MY_BUILDING:
            case NearbyAreas::MY_NEIGHBORHOOD:
                $helpRequests = $helpRequests->where('user.zip_code', $user->zip_code);
                break;
            case NearbyAreas::MY_CITY:
                $helpRequests = $helpRequests->where('user.city', $user->city);
                break;
            case NearbyAreas::CITY_AND_SURROUNDINGS:
                $helpRequests = $helpRequests->where('user.state', $user->state);
                break;
        }

        return new HelpRequestsCollection($helpRequests, true);
    }

    /**
     * List help requests based on user type
     *
     * @return HelpRequestsCollection
     */
    public function list() {
        /** @var User $user */
        $user = \Auth::user();

        switch ($user->user_type_id) {
            case UserType::USER_TYPE_REQUESTER:
                return new HelpRequestsCollection($user->helpRequests);
            case UserType::USER_TYPE_VOLUNTEER:
                return new HelpRequestsCollection($user->assignedHelpRequests);
            default:
                $helpRequests = collect();
        }
        return new HelpRequestsCollection($helpRequests);
    }

    /**
     * Store new help request.
     *
     * @param HelpRequestRequest $request
     * @return HelpRequestResource|\Illuminate\Http\JsonResponse
     */
    public function store(HelpRequestRequest $request) {
        try {
            $helpRequest          = new HelpRequest($request->all());
            $helpRequest->user_id = \Auth::id();
            $helpRequest->save();

            return new HelpRequestResource($helpRequest);
        } catch (\Exception $exception) {
            \Log::error($exception);
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, trans('general.model.store.error'));
        }
    }

    /**
     * User accepts help request.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse|HelpRequestResource
     */
    public function accept(Request $request, $id) {
        try {
            $help_request = HelpRequest::findOrFail($id);

            $help_request->assignedUser()->syncWithoutDetaching([\Auth::id()]);
            $help_request->accepted_at = now();
            $help_request->save();

            return new HelpRequestResource($help_request);
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.update.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }
}
