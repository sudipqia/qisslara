<?php

namespace App\Http\Requests\Configuration\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourtCategoryRequest extends FormRequest {
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
				Rule::unique('court_categories')->ignore($this->court),
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
			'name' => _lang('category_court_name'),
			'description' => _lang('category_court_description'),
		];
	}
}
