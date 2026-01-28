<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contact_id' => $this->contact_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'whatsapp_no' => $this->whatsapp_no,
            'address' => $this->address,
            'landmark' => $this->landmark,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
