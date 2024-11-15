<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name.*' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:tags,slug',
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
