<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if ( ! Schema::hasColumn('users', 'instansi_code')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->unsignedBigInteger('instansi_code')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('instansi_code');
        });
    }
};
