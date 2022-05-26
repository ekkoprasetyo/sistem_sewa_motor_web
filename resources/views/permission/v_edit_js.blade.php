@csrf
<div class="card-body">
    <input type="text" value="{{ $permission->c_permission_id }}" name="txt_permission_id" hidden>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" value="{{ $permission->c_permission_name }}" name="txt_permission_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Display</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-edit-display" value="{{ $permission->c_permission_display }}" name="txt_permission_display">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-edit-description" value="{{ $permission->c_permission_description }}" name="txt_permission_description" readonly>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#permission-edit-display').on('input', function () {
            $('#permission-edit-description').val('Access to ' + $('#permission-edit-display').val());
        });

    });
</script>