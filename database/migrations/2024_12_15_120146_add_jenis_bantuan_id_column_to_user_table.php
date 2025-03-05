<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table): void {
            $table->string('jenis_bantuan_id')->after('instansi_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table): void {
            $table->dropColumn('jenis_bantuan_id');
        });
    }
};
