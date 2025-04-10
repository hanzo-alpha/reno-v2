<?php

declare(strict_types=1);

use App\Enums\StatusDtksEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('bantuan_rastra', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('bantuan_rastra_uuid')->nullable()->default(Str::uuid()->toString());
            $table->string('nokk', 20);
            $table->string('nik', 20);
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('dusun')->nullable();
            $table->string('no_rt')->nullable();
            $table->string('no_rw')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->foreignId('jenis_bantuan_id')->index()->default(5)->nullable();
            $table->string('status_verifikasi')->nullable()->default(0);
            $table->tinyInteger('status_aktif')->nullable()->default(0);
            $table->foreignId('media_id')->index()->nullable();
            $table->json('foto_ktp_kk')->nullable();
            $table->year('tahun')->nullable()->default(now()->year);
            $table->tinyInteger('status_rastra')->nullable();
            $table->json('pengganti_rastra')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status_dtks', 30)->nullable()->default(StatusDtksEnum::DTKS);
            $table->timestamps();
            $table->softDeletes();

            $table->string('alamat_lengkap')->virtualAs("CONCAT(alamat, ', ', dusun, ', ',
             'RT. ' ,no_rt, ', ', 'RW. ', no_rw)");
        });
    }
};
