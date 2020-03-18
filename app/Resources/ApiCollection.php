<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 18/03/2020
 * Time: 11:47
 */

namespace App\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiCollection extends ResourceCollection {

    protected $resume;

    /**
     * Create a new resource instance.
     *
     * @param mixed $collection
     * @param bool  $resume
     */
    public function __construct($collection, $resume = false) {
        $this->resume = $resume;
        parent::__construct($collection);
    }
}
