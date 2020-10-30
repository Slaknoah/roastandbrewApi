<?php

namespace App\Http\Requests\API\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can( 'update',  $this->company );
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
            'logo'          => 'sometimes|file|image',
            'header_image_url' => 'sometimes|file|image'
        ];
    }
}
