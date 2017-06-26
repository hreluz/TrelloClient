<div class="form-group">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ isset($list) ? $list->name : old('name') }}" autofocus="">
    </div>
</div>