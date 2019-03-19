<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;    // 导出集合

class DaoModuleExport implements FromCollection
{
    public $data;
    public $payways;

    public function __construct(array $data)
    {
        $this->data     = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
}