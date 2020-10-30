<?php


namespace App\Http\Requests\API\Cafe;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCafeRequest extends FormRequest
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
            'location_name' => 'required|string',
            'primary_image' => 'sometimes|file|image',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required',
            'country' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'location_name.required' => 'The location name is required for this cafe',
            'location_name.string' => 'The location name must be a string',
            'primary_image.file' => 'The primary image must be an image file',
            'primary_image.image' => 'The primary image must be an image',
            'address.required' => 'An address is required for this cafe',
            'address.string' => 'An address must be a string',
            'city.required' => 'A city is required for this cafe',
            'city.string' => 'A city must be a string',
            'zip.required' => 'A zip is required for this cafe',
            'country.required' => 'A country is required'
        ];
    }
}
