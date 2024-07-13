<?php

namespace App\Imports;

use App\Models\Cnpj;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CnpjImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Cnpj([
            'cnpj' => $row['cnpj'],
            'razao_social' => $row['razao_social'],
            'status' => 'pendente',
        ]);
    }
}
