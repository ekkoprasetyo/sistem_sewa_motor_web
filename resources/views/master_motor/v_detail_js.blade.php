@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Brand</label>
        <div class="col-sm-9">
            <select class="form-control select2" disabled>
                <option value="">-= Select =-</option>
                <option value="YAMAHA" {{ $master_motor->c_master_motor_brand == 'YAMAHA' ? 'selected="selected"' : '' }}>YAMAHA</option>
                <option value="HONDA" {{ $master_motor->c_master_motor_brand == 'HONDA' ? 'selected="selected"' : '' }}>HONDA</option>
                <option value="SUZUKI" {{ $master_motor->c_master_motor_brand == 'SUZUKI' ? 'selected="selected"' : '' }}>SUZUKI</option>
                <option value="KAWASAKI" {{ $master_motor->c_master_motor_brand == 'KAWASAKI' ? 'selected="selected"' : '' }}>KAWASAKI</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Series</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $master_motor->c_master_motor_series }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Number Plate</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $master_motor->c_master_motor_number_plate }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Price</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $master_motor->c_master_motor_price }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" disabled>{{ $master_motor->c_master_motor_description }}</textarea>
        </div>
    </div>
</div>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
