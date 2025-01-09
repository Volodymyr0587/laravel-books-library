<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
        return [
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'title' => 'required|string|max:255',
            'year_of_publication' => 'required|integer|digits:4|min:1800|max:' . date('Y'),
            'num_of_pages' => 'nullable|integer|min:1',
            'genre' => 'nullable|string|max:255',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
