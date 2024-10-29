<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ItemsImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'title' => $row[0],
            'author' => $row[1],
            'publisher' => $row[2],
            'series' => $row[3],
            'detail' => $row[4],
            'published_on' => $row[5],
            'classification' => $row[6],
            'code' => $row[7],
            'price' => $row[8],
            'type_code' => $row[9],
            'file_name' => $row[10],
            'file_path' => $row[11],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
