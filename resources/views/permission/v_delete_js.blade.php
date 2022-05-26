@csrf
<div class="card-body">
    <input type="text" value="{{ $permission->c_permission_id }}" name="txt_permission_id" hidden>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" value="{{ $permission->c_permission_name }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Display</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-edit-display" value="{{ $permission->c_permission_display }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-edit-description" value="{{ $permission->c_permission_description }}" readonly>
        </div>
    </div>
</div>