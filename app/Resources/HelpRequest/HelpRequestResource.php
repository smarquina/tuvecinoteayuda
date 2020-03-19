<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:38
 */

namespace App\Resources\HelpRequest;


use App\Models\User\User;
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

        $assignedUsers = $helpRequest->assignedUser->transform(function (User $user) {
            $resume = $this->additional['show_assigned_additional_data'] ?? true;
            return (new UserResource($user, !$resume))->additional($this->additional);
        });

        return [
            'id'                  => $helpRequest->id,
            'user'                => (new UserResource($helpRequest->user, $this->resume))->additional($this->additional),
            'help_request_type'   => new HelpRequestTypeResource($helpRequest->type),
            'message'             => $helpRequest->message,
            'assigned_user_id'    => $assignedUsers,
            'assigned_user_count' => $helpRequest->assignedUser->count(),
            'accepted_at'         => $helpRequest->accepted_at ? $helpRequest->accepted_at->format("d/m/Y h:i") : null,
            'created_at'          => $helpRequest->created_at->format("d/m/Y h:i"),
        ];
    }
}
