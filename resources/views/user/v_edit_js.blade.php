@csrf
<div class="card-body">
    <input type="text" value="{{ $user->c_user_id }}" name="txt_users_id" hidden>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Full Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $user->c_user_full_name }}" name="txt_users_full_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">E-Mail</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $user->c_user_email }}" name="txt_users_email">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Role</label>
        <div class="col-sm-9">
            <select class="form-control select2" style="width: 100%;" name="txt_users_role" id="select-role">
                <option value="">-= Select =-</option>
                @if($roles->count() > 0)
                    @foreach($roles as $role)
                        <option value="{{ $role->c_role_id }}" {{ $user->c_user_role == $role->c_role_id ? 'selected' : '' }}>{{$role->c_role_display}} - {{$role->c_role_name}}</option>
                    @endForeach
                @else
                    <option value="">No Data</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="txt_users_status">
                <option value="">-= Select =-</option>
                <option value="1" {{ $user->c_user_status == "1" ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $user->c_user_status == "0" ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
