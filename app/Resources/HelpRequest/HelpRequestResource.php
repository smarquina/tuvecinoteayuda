<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:38
 */

namespace App\Resources\HelpRequest;


use App\Models\HelpRequest\HelpRequest;
use App\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HelpRequestResource extends JsonResource {

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
            'user'              => new UserResource($helpRequest->user),
            'help_request_type' => new HelpRequestResource($helpRequest->type),
            'message'           => $helpRequest->message,
            'assigned_user_id'  => new UserResource($helpRequest->user),
            'accepted_at'       => $helpRequest->accepted_at ?? null,
        ];
    }
}
