<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAdUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
         'home_top_bar_ad' => 'nullable|image',
         'home_middle_ad' => 'nullable|image',
         'view_page_ad' => 'nullable|image',
         'news_page_ad' => 'nullable|image',
         'side_bar_ad' => 'nullable|image',
        ];
    }
}