<?php

declare(strict_types=1);

use App\Models\MutasiBpjs;
use App\Models\PesertaBpjs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('mutasi_bpjs', function (Blueprint $table): void {
            $table->foreignIdFor(MutasiBpjs::class);
            $table->foreignIdFor(PesertaBpjs::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_bpjs');
    }
};
