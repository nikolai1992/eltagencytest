<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('tag_film', function (Blueprint $table) {
			$table->id();
            $table->bigInteger('film_id')->unsigned()->default(null)->nullable();
            $table->foreign('film_id', 'fk_t_film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->bigInteger('tag_id')->unsigned()->default(null)->nullable();
            $table->foreign('tag_id', 'fk_f_t_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('tag_film');
	}
};
