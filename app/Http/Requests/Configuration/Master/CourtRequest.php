<?php

namespace App\Http\Requests\Configuration\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourtRequest extends FormRequest {
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
			'name' => [
				'required', 'string',

			],
			'division.id' => [
				'required', 'integer',

			],
			'district.id' => [
				'required', 'integer',

			],
			'court_category.id' => [
				'required', 'integer',

			],

			'description' => [
				'sometimes', 'nullable', 'max:500',
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
			'name' => _lang('Court Name'),
			'division.id' => _lang('Division'),
			'district.id' => _lang('Disctrict'),
			'court_category.id' => _lang('Court Category'),
			'description' => _lang('Court Description'),
		];
	}
}
