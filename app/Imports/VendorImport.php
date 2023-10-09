<?php

namespace App\Imports;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class VendorImport implements
    ToCollection,
    WithHeadingRow,
//    WithBatchInserts,
//    WithChunkReading,
    WithProgressBar,
    WithValidation,
    SkipsOnError
{
    use Importable;
    use SkipsErrors;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            try {
                Vendor::create([
                    'id' => $row['index'],
                    'vendor_name' => $row['business_name'],
                    'slug' => $row['slug'],
                    'email' => $row['email'],
                    'address' => $row['business_address'],
                    'suburb' => $row['business_address_suburb'],
                    'pc' => $row['pc'],
                    'contact_name' => 'contact_name',
                    'contact_lastname' => 'contact_lastname',
                    'state' => $row['state'],
                    'mobile' => $row['business_phone_number'],
                    'max_stamps' => $row['card_stamps'],
                ]);

            } catch (\Exception $e) {
                continue;
            }
        }
    }

    public function rules(): array
    {
        return [
            'business_phone_number' => 'nullable|numeric',
        ];
    }

    public function prepareForValidation($data, $index)
    {
        //$data['business_phone_number'] this is phone number I want to only get numbers and escape other character write regex for that
        $data['business_phone_number'] = preg_replace('/[^0-9]/', '', $data['business_phone_number']);
        if (!$data['business_phone_number']) {
            $data['business_phone_number'] = null;
        }
        return $data;
    }

    public function isEmptyWhen(array $row): bool
    {
        //return true if business name contains word cafe in it
        return !str_contains(strtolower($row['business_name']), 'cafe');
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
