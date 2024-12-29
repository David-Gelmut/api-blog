<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\User\UserResource;
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
            'title'=>$this->title,
            'preview'=>$this->preview,
            'description'=>$this->description,
            'prev_image'=>$this->prev_image,
            'created_at'=>$this->created_at,
            'user'=>new UserResource($this->user),
            'category'=>new CategoryResource($this->category),
            'comments'=>CommentResource::collection($this->comments)
        ];
    }
}
