@csrf
<div class="card-body">
    <input type="text" value="{{ $user->c_user_id }}" name="txt_users_id" hidden="hidden">
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
        <label class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" placeholder="New Password" name="txt_users_password">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Password Confirmation</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" placeholder="New Password Confirmation" name="txt_users_password_confirmation">
        </div>
    </div>
</div>
