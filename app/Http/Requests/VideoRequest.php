<?php

namespace App\Http\Requests;

use App\Rules\VideoValidation;
use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            // Video validation is not hard coded. It is flexible depending on the media config rules of each Provider
            'video_file' => ['required', new VideoValidation($this->input('provider'))]
        ];
    }
}
