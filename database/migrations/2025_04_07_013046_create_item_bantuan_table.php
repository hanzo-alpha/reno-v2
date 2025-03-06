<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('item_bantuan', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('item_bantuan_uuid')->unique()->index()->nullable();
            $table->foreignId('jenis_bantuan_id')->index()->nullable();
            $table->string('kode_item');
            $table->string('nama_item');
            $table->char('kode_kelurahan', 10);
            $table->unsignedInteger('jumlah_kpm')->nullable()->default(0);
            $table->unsignedInteger('kuantitas')->nullable()->default(0);
            $table->unsignedInteger('jumlah_bulan')->nullable()->default(1);
            $table->string('satuan')->nullable()->default('Kg');
            $table->double('harga_satuan')->nullable()->default(0);
            $table->double('total_harga')->nullable()->default(0);
            $table->string('status_aktif')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_bantuan');
    }
};
