<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="title" class="col-md-2 col-form-label">
                名称
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" autofocus id="name" value="{{ $name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                类型
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="type" id="type" value="{{ $type }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                长度
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="height" id="height" value="{{ $height }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                宽度
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="width" id="width" value="{{ $width }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label">
                备注
            </label>
            <div class="col-md-10">
                <textarea class="form-control" name="remark" rows="14" id="remark">{{ $remark }}</textarea>
            </div>
        </div>
    </div>
</div>