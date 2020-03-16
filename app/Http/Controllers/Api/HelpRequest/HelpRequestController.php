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
use App\Models\HelpRequest;
use App\Models\User;
use App\Models\UserType;
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
     * List help requests based on user type
     *
     * @return HelpRequestsCollection
     */
    public function list() {
        /** @var User $user */
        $user = \Auth::user();

        switch ($user->user_type) {
            case UserType::USER_TYPE_REQUESTER:
                $helpRequests = HelpRequest::whereAssignedUserId(\Auth::id())->get();
                return new HelpRequestsCollection($helpRequests);

            case UserType::USER_TYPE_VOLUNTEER:
                $helpRequests = HelpRequest::join('user', 'helrequest.assigned_user_id', 'user.id')
                                           ->where('user.city', $user->city)
                                           ->get();

                return new HelpRequestsCollection($helpRequests);
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
            $help_request = HelpRequest::find($id);

            if (empty($help_request->assigned_user_id)) {
                $help_request->assigned_user_id = \Auth::id();
                $help_request->accepted_at      = now();
                $help_request->save();

                return new HelpRequestResource($help_request);
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                                'Petición ya atendida con anterioridad');
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.update.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }
}
