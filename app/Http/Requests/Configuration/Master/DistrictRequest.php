<?php

namespace App\Http\Requests\Configuration\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistrictRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [
			'division.id' => [
				'required', 'integer',
			],
			'name' => [
				'required', 'max:191',
			],
		];
		return $rules;
	}

	/**
	 * Get custom attributes for validator errors.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
			'division.id' => _lang('Division'),
			'name' => _lang('District'),
		];
	}
}
