<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BestHotelsRequest extends FormRequest
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
            "fromDate"          => "required|date",
            "toDate"            => "required|date",
            "city"              => "required|string",
            "numberOfAdults"    => "required|integer|min:1|max:5"
        ];
    }

	/**
	 * @param Validator $validator
	 */
	protected function failedValidation(Validator $validator)
	{
		if ($validator->fails()) {
			throw new HttpResponseException(validationErrors($validator->errors()->all()));
		}
	}
}
