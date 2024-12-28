<?php

namespace App\Http\Resources\Post;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'user_name'=>$this->name,
            'title'=>$this->title,
            'preview'=>$this->preview,
            'description'=>$this->description,
            'prev_image'=>$this->prev_image,
            'category_name'=>$this->category_title
        ];
    }
}
