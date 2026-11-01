<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('laporan')) {
            Schema::create('laporan', function (Blueprint $table) {
                $table->id();
                $table->string('nama_pelapor');
                $table->string('no_hp', 30);
                $table->string('lokasi');
                $table->string('kecamatan');
                $table->unsignedInteger('tinggi_air');
                $table->text('keterangan')->nullable();
                $table->string('foto');
                $table->string('status')->default('Menunggu');
                $table->unsignedInteger('tinggi_genangan')->nullable();
                $table->date('tanggal_kejadian')->nullable();
                $table->timestamps();
            });

            return;
        }

        $missing = collect([
            'no_hp' => fn (Blueprint $table) => $table->string('no_hp', 30)->default(''),
            'kecamatan' => fn (Blueprint $table) => $table->string('kecamatan')->default(''),
            'tinggi_air' => fn (Blueprint $table) => $table->unsignedInteger('tinggi_air')->default(0),
            'keterangan' => fn (Blueprint $table) => $table->text('keterangan')->nullable(),
            'foto' => fn (Blueprint $table) => $table->string('foto')->default(''),
            'status' => fn (Blueprint $table) => $table->string('status')->default('Menunggu'),
            'tinggi_genangan' => fn (Blueprint $table) => $table->unsignedInteger('tinggi_genangan')->nullable(),
            'tanggal_kejadian' => fn (Blueprint $table) => $table->date('tanggal_kejadian')->nullable(),
        ])->filter(fn ($add, $column) => ! Schema::hasColumn('laporan', $column));

        if ($missing->isNotEmpty()) {
            Schema::table('laporan', function (Blueprint $table) use ($missing) {
                foreach ($missing as $add) {
                    $add($table);
                }
            });
        }

    }

    public function down(): void
    {
    }
};
