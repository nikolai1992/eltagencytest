<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('films', function (Blueprint $table) {
            $table->text('screenshots')
                ->after('premier_end')
                ->nullable()
                ->default(null);
		});
	}

	public function down(): void
	{
		Schema::table('', function (Blueprint $table) {
			//
		});
	}
};
