@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" placeholder="users" name="txt_permission_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Display</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-display" placeholder="Index Users" name="txt_permission_display">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="permission-description" value="Access to " name="txt_permission_description" readonly>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#permission-display').on('input', function () {
            $('#permission-description').val('Access to ' + $('#permission-display').val());
        });

    });
</script>