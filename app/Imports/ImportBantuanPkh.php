<?php

declare(strict_types=1);

namespace App\Imports;

use App\Enums\StatusPkhBpntEnum;
use App\Models\BantuanPkh as DataPkh;
use App\Models\JenisBantuan;
use Auth;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterChunk;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Str;

class ImportBantuanPkh implements ShouldQueue, SkipsEmptyRows, ToModel, WithBatchInserts, WithChunkReading,
    WithHeadingRow, WithUpserts, WithValidation, WithEvents
{
    use Importable;
    use SkipsErrors;
    use SkipsFailures;
    use RegistersEventListeners;

    public static function beforeImport(BeforeImport $event): void
    {
        $user = Auth::user();
        Notification::make('Mulai Mengimpor')
            ->title('Data KPM PKH sedang di impor ke database.')
            ->info()
            ->send()
            ->sendToDatabase($user);
    }

    public static function afterImport(AfterImport $event): void
    {
        $user = Auth::user();
        Notification::make('Impor Berhasil')
            ->title('Data KPM PKH Berhasil di impor.')
            ->success()
            ->send();
    }

    public static function importFailed(ImportFailed $event): void
    {
        $user = Auth::user();
        Notification::make('Import Failed')
            ->title('Gagal Impor KPM PKH '.$event->e->getMessage())
            ->danger()
            ->send()
            ->sendToDatabase($user);
    }

    public static function afterChunk(AfterChunk $event): void
    {
        $user = Auth::user();
        Notification::make('Chunk Berhasil')
            ->title('Berhasil mengimport')
            ->success()
            ->send();
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => [self::class, 'beforeImport'],
            AfterImport::class => [self::class, 'afterImport'],
            ImportFailed::class => [self::class, 'importFailed'],
        ];
    }

    public function model(array $row): Model | DataPkh | null
    {
        $namaProp = isset($row['nama_prop']) ? Str::ucfirst($row['nama_prop']) : null;
        $namaKab = isset($row['nama_kab']) ? Str::ucfirst($row['nama_kab']) : null;
        $namaKec = isset($row['nama_kec']) ? Str::ucfirst($row['nama_kec']) : null;
        $namaKel = isset($row['nama_kel']) ? Str::ucfirst($row['nama_kel']) : null;

        $provinsi = Province::query()->where('name', $namaProp)->first()?->code;
        $kabupaten = City::query()->where('name', $namaKab)->first()?->code;
        $kecamatan = District::query()->where('name', $namaKec)->first()?->code;
        $kelurahan = Village::query()->where('name', $namaKel)->first()?->code;

        $jenisBantuan = JenisBantuan::where('alias', Str::upper($row['bansos']))->first()?->id;

        return new DataPkh([
            'dtks_id' => $row['iddtks'] ?? 'NON DTKS',
            'nokk' => $row['nokk'],
            'nik_ktp' => $row['nik_ktp'],
            'nama_penerima' => $row['nama_penerima'],
            'provinsi' => $provinsi ?? $row['nama_prop'],
            'kabupaten' => $kabupaten ?? $row['nama_kab'],
            'kecamatan' => $kecamatan ?? $row['nama_kec'],
            'kelurahan' => $kelurahan ?? $row['nama_kel'],
            'kode_wilayah' => $row['kode_wilayah'],
            'tahap' => $row['tahap'],
            'bansos' => $row['bansos'],
            'bank' => $row['bank'],
            'jenis_bantuan_id' => $jenisBantuan ?? 2,
            'alamat' => $row['alamat'] ?? 'TIDAK ADA',
            'no_rt' => $row['no_rt'] ?? '001',
            'no_rw' => $row['no_rw'] ?? '002',
            'dusun' => $row['dusun'],
            'dir' => $row['dir'],
            'gelombang' => $row['gelombang'],
            'nominal' => $row['nominal'],
            'status_pkh' => StatusPkhBpntEnum::PKH,
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            'nik_ktp' => Rule::unique('bantuan_pkh', 'nik_ktp'),
            'iddtks' => Rule::unique('bantuan_pkh', 'dtks_id'),

            // Above is alias for as it always validates in batches
            '*.nik_ktp' => Rule::unique('bantuan_pkh', 'nik_ktp'),
            '*.iddtks' => Rule::unique('bantuan_pkh', 'dtks_id'),

            // Can also use callback validation rules
            //            '0' => function ($attribute, $value, $onFailure) {
            //                if ($value !== 'Patrick Brouwers') {
            //                    $onFailure('Name is not Patrick Brouwers');
            //                }
            //            }
        ];
    }

    //    public function onError(Throwable $e)
    //    {
    //        dd($e);
    //    }

    //    public function onFailure(Failure ...$failures)
    //    {
    //        foreach ($failures as $failure) {
    //            $baris = $failure->row();
    //            $errmsg = $failure->errors()[0];
    //            $values = $failure->values();
    //
    //            Notification::make('Failure Import')
    //                ->title('Baris Ke : ' . $baris . ' | ' . $errmsg)
    //                ->body('NIK : ' . $values['nik'] . ' | No.KK : ' . $values['no_kk'] . ' | Nama : ' . $values['nama_lengkap'])
    //                ->danger()
    //                ->sendToDatabase(auth()->user())
    //                ->broadcast(User::where('is_admin', 1)->get());
    //        }
    //    }

    public function uniqueBy(): array
    {
        return ['nik', 'iddtks'];
    }
}
