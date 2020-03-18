<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 18/03/2020
 * Time: 8:38
 */

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

abstract class ApiResource extends JsonResource
{

    protected $resume;

    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     * @param bool  $resume
     */
    public function __construct($resource, $resume = false)
    {
        $this->resume = $resume;

        parent::__construct($resource);
    }

}
