@csrf
<div class="card-body">
    <input type="text" value="{{ $role->c_role_id }}" name="txt_role_id" hidden>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Role Permission {{ $role->c_role_display }}</label>
                <select class="duallistbox" multiple="multiple" name="txt_role_permission[]">
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->c_permission_id }}" {{ in_array($permission->c_permission_id, $array_permission) ? 'selected' : '' }}>{{ $permission->c_permission_name }} - {{ $permission->c_permission_display }}</option>
                    @endforeach
                </select>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<script>
    $(function() {
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    });
</script>