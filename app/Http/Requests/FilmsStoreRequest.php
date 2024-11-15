<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmsStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name.*' => 'required|max:255',
			'description.*' => 'required',
			'year' => 'required|integer',
			'video_id' => 'required|max:255',
			'premier_start' => 'nullable|date',
			'premier_end' => 'nullable|date',
            'poster' => 'required|mimes:jpg,jpeg,png',
            'screenshots' => 'required',
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
