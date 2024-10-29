<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use function PHPSTORM_META\map;

class ItemsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::all()
            ->makeHidden([
                'id',
                'file_name',
                'file_path',
                'created_at',
                'updated_at',
                'deleted_at',
            ]);
    }

    public function headings() :array
    {
        return [
            '作品名',
            '書作者',
            '発売社',
            'シリーズ',
            '作品詳細',
            '出版年月',
            '分類',
            'ISBN等',
            '価格',
            '種別コード',
        ];
    }
}
