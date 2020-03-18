<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:38
 */

namespace App\Resources\HelpRequest;


use App\Resources\ApiResource;
use App\Models\HelpRequest\HelpRequest;
use App\Resources\User\UserCollection;
use App\Resources\User\UserResource;

class HelpRequestResource extends ApiResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="HelpRequestResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var HelpRequest $helpRequest */
        $helpRequest = clone $this;

        return [
            'id'                => $helpRequest->id,
            'user'              => new UserResource($helpRequest->user, $this->resume),
            'help_request_type' => new HelpRequestTypeResource($helpRequest->type),
            'message'           => $helpRequest->message,
            'assigned_user_id'  => new UserCollection($helpRequest->assignedUser),
            'accepted_at'       => $helpRequest->accepted_at ? $helpRequest->accepted_at->format("d/m/Y h:i") : null,
            'created_at'        => $helpRequest->created_at->format("d/m/Y h:i"),
        ];
    }
}
