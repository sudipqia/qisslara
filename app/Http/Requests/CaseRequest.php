<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaseRequest extends FormRequest {
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

			'mobile' => [
				'required', 'string',

			],

			'email' => [
				'email','sometimes', 'nullable',

			],

			'address' => [
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
			'name' => _lang('Client Name'),
			'division.id' => _lang('Division'),
			'district.id' => _lang('Disctrict'),
			'mobile' => _lang('Mobile'),
			'email' => _lang('Email'),
			'address' => _lang('address'),
		];
	}
}
