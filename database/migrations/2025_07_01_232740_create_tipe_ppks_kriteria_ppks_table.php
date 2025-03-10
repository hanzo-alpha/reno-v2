<?php

declare(strict_types=1);

use App\Models\KriteriaPpks;
use App\Models\TipePpks;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tipe_ppks_kriteria_ppks', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(TipePpks::class)
                ->nullable()
                ->constrained('tipe_ppks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(KriteriaPpks::class)
                ->nullable()
                ->constrained('kriteria_ppks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_ppks_kriteria_ppks');
    }
};
