<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('caste_fields', function (Blueprint $table) {
			$table->id();
			$table->string('type')->nullable();
			$table->string('name')->nullable();
			$table->string('photo')->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('caste_fields');
	}
};
