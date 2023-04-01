<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\http\Resources\UserResource;

class SocietyResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     * https://stackoverflow.com/questions/67902019/how-to-get-only-specific-fields-from-laravel-eloquent-api-resource
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'contact' => $this->contact,
            'description' => $this->description,
            'country' => $this->associatedCountry()->select('countryCode','name')->get(),
            'state' => $this->associatedState()->select('id','state_title')->get(),
            'city' => $this->associatedCity()->select('id','name')->get(),
            'postcode' => $this->postcode,
            'user' => new UserResource($this->user),
            'user' => $this->user()->select('name', 'email')->get(),
        ];
    }
}
