<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasteFieldStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
            'name.*' => 'required|max:255',
            'type' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
