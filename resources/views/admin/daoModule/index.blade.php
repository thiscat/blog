@extends('admin.layout')

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>模型 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/daoModule/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 创建新模型
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="posts-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>长度</th>
                        <th>宽度</th>
                        <th>备注</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>长度</th>
                        <th>宽度</th>
                        <th>备注</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($daoModule as $module)
                        <tr>
                            <td data-order="{{ $module->createTime }}">
                                {{ date('Y-m-d', $module->createTime) }}
                            </td>
                            <td data-order="{{ $module->updateTime }}">
                                {{ $module->updateTime > 0 ? date('Y-m-d', $module->updateTime) : '' }}
                            </td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->type }}</td>
                            <td>{{ $module->height }}</td>
                            <td>{{ $module->width }}</td>
                            <td>{{ $module->remark }}</td>
                            <td>
                                <a href="/admin/daoModule/{{ $module->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                {{--<a href="/blog/daoModule/{{ $module->id }}" class="btn btn-xs btn-warning">--}}
                                    {{--<i class="fa fa-eye"></i> 查看--}}
                                {{--</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#posts-table tfoot th').each( function () {
                var title = $('#posts-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="搜索'+title+'" />' );
            } );

            // DataTable
            var table = $('#posts-table').DataTable();

            // Apply the search
            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                        .column( colIdx )
                        .search( this.value )
                        .draw();
                } );
            } );
        } );
    </script>
@stop