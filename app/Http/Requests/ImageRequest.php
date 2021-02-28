<?php

namespace App\Http\Requests;

use App\Rules\ImageValidation;
use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:media',
            'provider' => 'required|exists:providers,id',
            'image_file' => ['required', new ImageValidation($this->input('provider'))]
        ];
    }
}
