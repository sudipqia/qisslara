<?php

namespace App\Http\Requests\Configuration\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActRequest extends FormRequest {
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
			'act_no' => [
				'required', 'string',
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
			'name' => _lang('Act'),
			'description' => _lang('Act Description'),
			'act_no'=>_lang('Act'),
		];
	}
}
