<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('lokasi_bantuan', function (Blueprint $table): void {
            $table->id();
            $table->uuid('lokasi_bantuan_uuid')->nullable();
            $table->foreignId('bantuan_rastra_id')->nullable();
            $table->string('lokasi')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_bantuan');
    }
};
