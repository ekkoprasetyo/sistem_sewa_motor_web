@csrf
<div class="card-body">
    <input type="text" value="{{ $role->c_role_id }}" name="txt_role_id" hidden>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" value="{{ $role->c_role_name }}" name="txt_role_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Display</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="role-edit-display" value="{{ $role->c_role_display }}" name="txt_role_display">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="role-edit-description" value="{{ $role->c_role_description }}" name="txt_role_description" readonly>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#role-edit-display').on('input', function () {
            $('#role-edit-description').val('As ' + $('#role-edit-display').val());
        });

    });
</script>