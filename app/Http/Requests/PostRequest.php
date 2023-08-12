<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return  ['name'=> 'required|max:100',
        'description'=> 'required',
        'image'=> 'required|image',];
    }
    public function messages()
    {
        return [
            'name.required'=> __('messages.The Name is required'),
            'name.max'=> __('messages.The Name tall max 100 characters'),
            'description.required'=> __('messages.The Description is required'),
            'image.required'=> __('messages.The Image is required'),
            'image.image'=> __('messages.The type should be Image'),
            
          ];
    }

}
