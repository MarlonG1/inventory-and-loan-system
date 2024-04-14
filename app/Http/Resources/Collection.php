<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    protected $secondArg;

    public function __construct($resource, $secondArg = [])
    {
        parent::__construct($resource);
        $this->secondArg = $secondArg;
    }

    public function toArray(Request $request): array
    {
        if (!empty($this->secondArg)) {
            return [
                'data' => $this->collection,
                'otherInformation' => $this->secondArg,
            ];
        }

        return parent::toArray($request);
    }
}
