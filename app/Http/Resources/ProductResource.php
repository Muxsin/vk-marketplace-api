<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            'user' => $this->user->login,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $auth = auth('sanctum');

        if ($auth->check()) {
            $data['mine'] = $this->user_id === $auth->id();
        }

        return $data;
    }
}
