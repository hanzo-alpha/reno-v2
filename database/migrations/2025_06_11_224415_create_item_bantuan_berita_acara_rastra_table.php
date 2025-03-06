<?php

declare(strict_types=1);

use App\Models\BeritaAcaraRastra;
use App\Models\ItemBantuan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('item_bantuan_berita_acara_rastra', static function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(ItemBantuan::class);
            $table->foreignIdFor(BeritaAcaraRastra::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_bantuan_berita_acara_rastra');
    }
};
