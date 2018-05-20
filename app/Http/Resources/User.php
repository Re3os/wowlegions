<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'accountId'          => $this->id,
            'isEmployee'            => false,
            'currencyCode'    => ''.$this->currency.'',
            'locale'    => 'ru',
            'region'    => 'EU',
        ];
    }
}