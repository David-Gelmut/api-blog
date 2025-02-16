<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostService
{
    public function getPathPrevImage(FormRequest $request, array $data): array
    {
        if ($request->has('prev_image')) {
            $prevPath = $request->file('prev_image')->store('posts', 'public');
            $data['prev_image'] = $prevPath;
        }
        return $data;
    }
}
