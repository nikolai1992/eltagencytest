<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsUpdateRequest extends FormRequest
{
	public function rules(): array
	{
        $id = $this->route('tag');

		return [
            'name.*' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $id,
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
