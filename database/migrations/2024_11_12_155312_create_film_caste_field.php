<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('film_caste_field', function (Blueprint $table) {
			$table->id();
            $table->bigInteger('film_id')->unsigned()->default(null)->nullable();
            $table->foreign('film_id', 'fk_up_film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->bigInteger('caste_field_id')->unsigned()->default(null)->nullable();
            $table->foreign('caste_field_id', 'fk_f_cf_id')
                ->references('id')
                ->on('caste_fields')
                ->onDelete('cascade');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('film_caste_field');
	}
};
