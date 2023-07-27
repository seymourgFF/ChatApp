<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LsMessageFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'message' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf','max:3000'],
            'to_user_id' =>'integer'
        ];
    }
}
