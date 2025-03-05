<?php

declare(strict_types=1);

use App\Enums\StatusDtksEnum;
use App\Models\HubunganKeluarga;
use App\Models\JenisPekerjaan;
use App\Models\PendidikanTerakhir;
use App\Models\TipePpks;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('bantuan_ppks', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('bantuan_ppks_uuid')->nullable()->default(Str::uuid()->toString());
            $table->string('nokk', 20);
            $table->string('nik', 20);
            $table->string('nama_lengkap');
            $table->string('tempat_lahir', 50);
            $table->dateTime('tgl_lahir');
            $table->string('notelp', 18);
            $table->string('nama_ibu_kandung');
            $table->unsignedBigInteger('jenis_bantuan_id')->default(4)->nullable();
            $table->foreignIdFor(PendidikanTerakhir::class)->index()->constrained('pendidikan_terakhir')->cascadeOnUpdate();
            $table->foreignIdFor(HubunganKeluarga::class)->index()->constrained('hubungan_keluarga')->cascadeOnUpdate();
            $table->foreignIdFor(JenisPekerjaan::class)->index()->constrained('jenis_pekerjaan')->cascadeOnUpdate();
            $table->tinyInteger('status_kawin')->nullable()->default(1);
            $table->tinyInteger('jenis_kelamin')->nullable()->default(1);
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('dusun')->nullable();
            $table->string('no_rt')->nullable();
            $table->string('no_rw')->nullable();
            $table->json('bukti_foto')->nullable();
            $table->foreignId('media_id')->index()->nullable();
            $table->foreignId('tipe_ppks_id')->index()->nullable();
            $table->json('kriteria_ppks')->nullable();
            $table->integer('penghasilan_rata_rata')->default(0)->nullable();
            $table->json('detail_bantuan')->nullable();
            $table->foreignId('detail_bantuan_id')->index()->nullable();
            $table->unsignedtinyInteger('status_rumah_tinggal')->nullable();
            $table->string('status_kondisi_rumah')->nullable();
            $table->string('status_dtks')->nullable()->default(StatusDtksEnum::DTKS);
            $table->string('status_verifikasi')->nullable()->default(0);
            $table->unsignedTinyInteger('status_aktif')->nullable()->default(0);
            $table->text('keterangan')->nullable();
            $table->foreignId('penandatangan_id')->index()->nullable();
            $table->dateTime('tgl_ba')->default(now())->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
