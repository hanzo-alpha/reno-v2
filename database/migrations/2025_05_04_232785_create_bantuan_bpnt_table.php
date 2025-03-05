<?php

declare(strict_types=1);

use App\Enums\StatusDtksEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bantuan_bpnt', static function (Blueprint $table): void {
            $table->id();
            $table->uuid('bantuan_bpnt_uuid')->nullable()->default(Str::uuid()->toString());
            $table->foreignId('jenis_bantuan_id')->index()->default(2)->nullable();
            $table->string('no_nik');
            $table->string('nama_penerima');
            $table->char('provinsi', 2)->nullable();
            $table->char('kabupaten', 5)->nullable();
            $table->char('kecamatan', 7)->nullable();
            $table->char('kelurahan', 10)->nullable();
            $table->string('status_dtks', 30)->nullable()->default(StatusDtksEnum::DTKS);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bantuan_bpnt');
    }
};
