<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned()->default(null)->nullable();
            $table->foreign('role_id', 'fk_up_role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('SET NULL');
		});
	}

	public function down(): void
	{

	}
};
