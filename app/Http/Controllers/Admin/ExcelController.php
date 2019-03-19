<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DaoModuleExport;
use App\Imports\DaoModuleImport;
use App\Models\DaoModule;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;


class ExcelController extends Controller
{
    //Excel文件导出功能 By Laravel学院
    public function export()
    {
        $cellData = [['编号','名称','类型','长度','宽度','创建时间','更新时间','备注']];
        $list = DaoModule::all();
        foreach ($list as $key => $item) {
            $newData = $item->attributesToArray();
            if (empty($newData)) continue;
            unset($newData['isBan']);
            $newData['createTime'] = date('Y-m-d H:i', $newData['createTime']);
            $newData['updateTime'] = date('Y-m-d H:i', $newData['updateTime']);
            $cellData[] = $newData;
        }


        $fileName = '模型';
        return Excel::download(new DaoModuleExport($cellData), $fileName . '.xlsx');
    }

    public function import()
    {
        $file = $_FILES['file'];
        Excel::import(new DaoModuleImport(), $file['tmp_name']);

        return redirect('/admin/daoModule')->with('success', '导入成功!');
    }
}
