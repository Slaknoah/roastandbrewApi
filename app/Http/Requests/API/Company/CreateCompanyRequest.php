<?php

namespace App\Http\Requests\API\Company;

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
            'name'          => 'required|string',
            'roaster'       => 'required|integer',
            'subscription'  => 'required|integer',
            'description'   => 'string',
            'website'       => 'url',
            'address'       => 'required|string',
            'city'          => 'required|string',
            'state'         => 'required|string|size:2',
            'zip'           => 'required|numeric',
            'facebook_url'  => 'url',
            'twitter_url'   => 'url',
            'instagram_url' => 'url',
        ];
    }
}
