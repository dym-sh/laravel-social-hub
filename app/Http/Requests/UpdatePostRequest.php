<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class UpdatePostRequest extends StorePostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // todo change later to handle community posts

        $post = $this->route('post');

        return Auth::id() == $post->user_id;
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'deleted_file_ids' => 'array',
            'deleted_file_ids.*' => 'numeric',
        ]);
    }

}
