<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('penandatangan', static function (Blueprint $table): void {
            $table->id();
            $table->string('kode_kelurahan');
            $table->string('kode_kecamatan');
            $table->string('nama_penandatangan');
            $table->string('nip');
            $table->string('jabatan');
            $table->unsignedTinyInteger('status_penandatangan')->nullable()->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penandatangan');
    }
};
