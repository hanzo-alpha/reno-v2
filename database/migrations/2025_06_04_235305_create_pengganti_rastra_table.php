<?php

declare(strict_types=1);

use App\Enums\AlasanEnum;
use App\Models\BantuanRastra;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('pengganti_rastra', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('pengganti_rastra_uuid')->unique()->index();
            $table->foreignId('bantuan_rastra_id')->index()->nullable();
            $table->string('nokk_lama', 20)->nullable();
            $table->string('nik_lama', 20)->nullable();
            $table->string('nama_lama')->nullable();
            $table->text('alamat_lama')->nullable();
            $table->string('nokk_pengganti', 20);
            $table->string('nik_pengganti', 20);
            $table->string('nama_pengganti');
            $table->text('alamat_pengganti');
            $table->string('alasan_dikeluarkan')->nullable()->default(AlasanEnum::PINDAH);
            $table->json('attachment')->nullable();
            $table->foreignId('media_id')->index()->nullable();
            $table->timestamps();
        });
    }
};
