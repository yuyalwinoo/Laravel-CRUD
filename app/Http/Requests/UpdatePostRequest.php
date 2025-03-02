<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
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
        $postId = $this->route('post')->id;
        return [
            'title' => 'required|max:255|unique:posts,title,' . $postId,
            'content' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please Enter title',
            'content.required' => 'Please Enter content',
        ];
    }
}
