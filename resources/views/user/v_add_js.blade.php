@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Full Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Eko Prasetyo" name="txt_users_full_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">E-Mail</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="eko.prasetyo@railink.co.id" name="txt_users_email">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" placeholder="Password" name="txt_users_password">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Password Confirmation</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" placeholder="Password Confirmation" name="txt_users_password_confirmation">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Role</label>
        <div class="col-sm-9">
            <select class="form-control select2" style="width: 100%;" name="txt_users_role">
                <option value="">-= Select =-</option>
                @if($roles->count() > 0)
                    @foreach($roles as $role)
                        <option value="{{$role->c_role_id}}">{{$role->c_role_display}} - {{$role->c_role_name}}</option>
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
                <option value="1">Active</option>
                <option value="0">Inactive</option>
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
