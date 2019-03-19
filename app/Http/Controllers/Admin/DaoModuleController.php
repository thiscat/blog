<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DaoModuleCreateRequest;
use App\Http\Requests\DaoModuleUpdateRequest;
use App\Jobs\PostFormFields;
use App\Models\DaoModule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DaoModuleController extends Controller
{
    protected $fieldList = [
        'name' => '',
        'type' => '',
        'height' => '',
        'width' => '',
        'createTime' => '',
        'updateTime' => "0",
        'isBan' => '',
        'remark' => '',
    ];

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        return view('admin.daoModule.index', ['daoModule' => DaoModule::all()]);
    }

    /**
     * Show the new post form
     */
    public function create()
    {
        $fields = $this->fieldList;

        $when = Carbon::now()->addHour();
        $fields['createTime'] = $when->format('Y-m-d');
        $fields['updateTime'] = $when->format('Y-m-d');

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        $data = $fields;

        return view('admin.daoModule.create', $data);
    }

    /**
     * Store a newly created Post
     *
     * @param PostCreateRequest $request
     */
    public function store(DaoModuleCreateRequest $request)
    {
        $daoModule = DaoModule::create($request->postFillData());

        return redirect()
            ->route('daoModule.index')
            ->with('success', '新文章创建成功.');
    }

    /**
     * Show the post edit form
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fields = $this->fieldsFromModel($id, $this->fieldList);

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $data = $fields;

        return view('admin.daoModule.edit', $data);
    }

    /**
     * 更新文章
     *
     * @param PostUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DaoModuleUpdateRequest $request, $id)
    {
        $daoModule = DaoModule::findOrFail($id);
        $daoModule->fill($request->postFillData());
        $daoModule->save();

        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->with('success', '文章已保存.');
        }

        return redirect()
            ->route('daoModule.index')
            ->with('success', '文章已保存.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
//        $daoModule = DaoModule::findOrFail($id);
//        $daoModule->delete();
        $daoModule = DaoModule::findOrFail($id);
        $daoModule->fill(['isBan' => 1]);
        $daoModule->save();

        return redirect()
            ->route('daoModule.index')
            ->with('success', '文章已删除.');
    }

    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array $fields
     * @return array
     */
    private function fieldsFromModel($id, array $fields)
    {
        $daoModule = DaoModule::findOrFail($id);

        $fieldNames = array_keys($fields);

        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $daoModule->{$field};
        }

        return $fields;
    }
}