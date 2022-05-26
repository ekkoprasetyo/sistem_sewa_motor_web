@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control is-warning" placeholder="administrator" name="txt_role_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Display</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="role-display" placeholder="Administrator" name="txt_role_display">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="role-description" value="As " name="txt_role_description" readonly>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#role-display').on('input', function () {
            $('#role-description').val('As ' + $('#role-display').val());
        });

    });
</script>