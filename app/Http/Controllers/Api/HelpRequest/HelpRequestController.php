<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\HelpRequest;

use App\Events\CancelHelpRequest;
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
use Auth;

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

        return new HelpRequestsCollection($helpRequests->sortByDesc('created_at'), true);
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
                $helpRequests = $user->helpRequests;
                break;
            case UserType::USER_TYPE_VOLUNTEER:
                $helpRequests = $user->assignedHelpRequests;
                break;
            default:
                $helpRequests = collect();
        }

        return (new HelpRequestsCollection($helpRequests, false))
            ->additional(['show_direction'                => true,
                          'show_assigned_additional_data' => true]);
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

    /**
     * Cancel accepted help request.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function revert(Request $request, $id) {
        try {
            $help_request = HelpRequest::findOrFail($id);

            if ($help_request->assignedUser->contains('id', \Auth::id())) {
                $help_request->assignedUser()->detach([\Auth::id()]);

                if ($help_request->assigned_user_count == 0) {
                    $help_request->accepted_at = null;
                    $help_request->save();
                }
                return $this->responseOK(trans('helprequest.revert.accepted'));
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                                trans('helprequest.revert.error'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('helprequest.revert.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }

    /**
     * Delete my help request.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id) {
        try {
            $help_request = HelpRequest::findOrFail($id);

            if ($help_request->user_id == \Auth::id()) {
                $help_request->assignedUser()->sync([]);
                $help_request->delete();

                event(new CancelHelpRequest($help_request));

                return $this->responseOK(trans('helprequest.delete.correct'));
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                                trans('helprequest.delete.error'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('helprequest.delete.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }

    /**
     * Track click in external call action of one help request.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trackExternalCall(Request $request, $id) {
        try {
            $help_request = HelpRequest::findOrFail($id);

            if ($help_request->user_id == Auth::id()) {
                $help_request->track_external_call += 1;
                if (empty($help_request->track_external_call_at)) {
                    $help_request->track_external_call_at = now();
                }
                $help_request->save();

                return $this->responseOK(trans('helprequest.trackexternalcall.correct'));
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, trans('helprequest.trackexternalcall.error'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('helprequest.trackexternalcall.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }
}
