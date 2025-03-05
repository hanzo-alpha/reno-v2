<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bansos_diterima', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('bantuan_ppks_id')->index()->nullable();
            $table->string('nama_bansos', 100);
            $table->text('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bansos_diterima');
    }
};
