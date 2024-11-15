<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasteFieldUpdateRequest extends FormRequest
{
	public function rules(): array
	{
		return [
            'name.*' => 'required|max:255',
            'type' => 'required',
            'photo' => 'nullable|mimes:jpg,jpeg,png',
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
