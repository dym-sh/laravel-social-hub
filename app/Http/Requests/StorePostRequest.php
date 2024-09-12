<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

class StorePostRequest extends FormRequest
{

    public static array $extensions =
        [ 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'
        , 'mp3', 'wav', 'mp4'
        , 'doc', 'docx', 'pdf', 'csv', 'xls', 'xlsx'
        , 'zip'
        ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['nullable', 'string'],
            'attachments' => [
                'array',
                'max:50',
                function ($attribute, $value, $fail) {
                    $totalSize = collect($value)
                        ->sum(fn (UploadedFile $file) => $file->getSize()
                    );
                    dd($totalSize);
                    if($totalSize > 1024*1024*1024) {
                        $fail('The total size of all files must not exceed 1 GB');
                    }
                },
            ],
            'attachments.*' => [
                'file'
                ,File::types(self::$extensions)
            ],
            'user_id' => ['numeric'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
            'body'=> $this->input('body') ?: ''
        ]);
    }

    public function messages(): array
    {
        return [
            'attachments.*.file' => 'Each attachment must be a file',
            'attachments.*.mimes' => 'Invalid filetype for attachment.',
            'attachments.*.max' => 'Attachment size cant be more than 500 MB',
        ];
    }
}
