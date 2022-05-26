@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Full Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $user->c_user_full_name }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">E-Mail</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $user->c_user_email }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Role</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $user->c_role_display }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            {!! $user->c_user_status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>' !!}
        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
