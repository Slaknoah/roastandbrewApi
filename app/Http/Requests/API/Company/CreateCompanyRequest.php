<?php

namespace App\Http\Requests\API\Company;

use App\Http\Resources\Company\Company;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can( 'store', [ Company::class ] );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string',
            'roaster'       => 'required|integer',
            'subscription'  => 'required|integer',
            'description'   => 'nullable|string',
            'website'       => 'nullable|url',
            'address'       => 'required|string',
            'country'       => 'required',
            'city'          => 'required|string',
            'state'         => 'nullable|string|size:2',
            'zip'           => 'nullable|numeric',
            'facebook_url'  => 'nullable|url',
            'twitter_url'   => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'logo'          => 'required|file|image',
            'header'        => 'required|file|image'
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
            'name.required'     => 'The name of the company is required.',
            'name.string'       => 'The name must be a string.',
            'roaster.required'  => 'A flag declaring the company as a roaster is required.'
        ];
    }
}
