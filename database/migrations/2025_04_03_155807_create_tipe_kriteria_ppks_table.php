<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tipe_kriteria_ppks', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tipe_ppks_id')->index()->nullable();
            $table->foreignId('kriteria_ppks_id')->index()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_kriteria_ppks');
    }
};
