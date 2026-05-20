<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitOrderRequest extends FormRequest
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
            'company' => 'required|max:200',
			'address' => 'required|max:200',
			'contactPerson' => 'required|max:200',
			'contactPhone' => 'required|max:200',
			'note' => 'max:2000'
        ];
    }

	public function attributes()
	{
		return collect($this->rules())->map(function($value, $key) {
			return trans('web.orderForm.' . $key);
		})->toArray();
	}
}
