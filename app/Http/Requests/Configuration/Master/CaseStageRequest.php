<?php

namespace App\Http\Requests\Configuration\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaseStageRequest extends FormRequest {
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
				Rule::unique('case_stages')->ignore($this->case_stage),
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
			'name' => _lang('case_stage_name'),
			'description' => _lang('case_stage_description'),
		];
	}
}
