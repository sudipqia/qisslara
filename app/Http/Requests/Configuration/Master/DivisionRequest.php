<?php

namespace App\Http\Requests\Configuration\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DivisionRequest extends FormRequest {
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
				'required', 'max:191',
				Rule::unique('divisions')->ignore($this->division),
			],
			'sortname' => [
				'required', 'max:191',
				Rule::unique('divisions')->ignore($this->division),
			],
			'phonecode' => [
				'sometimes', 'nullable', 'digits_between:1,6', 'max:191',
				Rule::unique('divisions')->ignore($this->division),
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
			'name' => _lang('Division Name'),
			'sortname' => __('form.sortname'),
			'phonecode' => __('form.phonecode'),
		];
	}
}
