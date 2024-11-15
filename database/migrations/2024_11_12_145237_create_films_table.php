<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('films', function (Blueprint $table) {
			$table->id();
			$table->json('name')->nullable();
			$table->json('description')->nullable();
			$table->string('poster')->nullable();
			$table->string('video_id')->nullable();
			$table->integer('year')->nullable();
			$table->boolean('status')->nullable();
			$table->timestamp('premier_start')->nullable();
			$table->timestamp('premier_end')->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('films');
	}
};
