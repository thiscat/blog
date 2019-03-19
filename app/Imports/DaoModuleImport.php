<?php

namespace App\Imports;

use App\Models\DaoModule;
use Maatwebsite\Excel\Concerns\ToModel;

class DaoModuleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DaoModule([
            'name' => $row[0],
            'type' => $row[1],
            'height' => $row[2],
            'width' => $row[3],
            'remark' => $row[4],
            'createTime' => time(),
            'updateTime' => time()
        ]);
    }
}
