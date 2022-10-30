<?php

namespace App\Http\Requests\Configuration\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCategoryRequest extends FormRequest {
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
				Rule::unique('client_categories')->ignore($this->client),
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
			'name' => _lang('category_client_name'),
			'description' => _lang('category_client_description'),
		];
	}
}
