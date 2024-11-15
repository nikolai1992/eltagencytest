<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Film extends Model
{
    use HasTranslations, HasFactory;

    protected $guarded = false;

    public $translatable = ['name', 'description'];

	protected function casts()
	{
		return [
			'premier_start' => 'datetime',
			'premier_end' => 'datetime',
            'screenshots' => 'array',
		];
	}

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_film');
    }

    public function casteFields()
    {
        return $this->belongsToMany(CasteField::class, 'film_caste_field');
    }
}
