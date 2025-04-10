<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('berita_acara_rastra', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('berita_acara_id')->index()->nullable();
            $table->foreignId('bantuan_rastra_id')->index()->nullable();
            $table->string('nomor_ba');
            $table->string('judul_ba');
            $table->date('tgl_ba')->nullable()->default(today());
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->foreignId('item_bantuan_id')->index()->nullable();
            $table->foreignId('penandatangan_id')->index()->nullable();
            $table->string('keterangan')->nullable();
            $table->json('upload_ba')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acara_rastra');
    }
};
