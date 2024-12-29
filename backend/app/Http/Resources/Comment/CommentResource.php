<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_name'=> User::find(auth()?->user()?->id)?->name,
            'post_id'=>$this->post_id,
            'text'=>$this->text,
            'created_at'=>$this->created_at
        ];
    }
}
