@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Eko Prasetyo" name="txt_motor_rent_renter_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter ID</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="20180801185" name="txt_motor_rent_renter_id">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Phone</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="081210416444" name="txt_motor_rent_renter_phone">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Address</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Jakarta" name="txt_motor_rent_renter_address">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Motorcycle</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="txt_motor_rent_motor">
                <option value="">-= Select =-</option>
                @if(count($available_motors) > 0)
                    @foreach($available_motors as $motor)
                        <option value="{{ $motor->c_master_motor_id }}">{{ $motor->c_master_motor_brand }} - {{ $motor->c_master_motor_series }} ({{ $motor->c_master_motor_number_plate }})</option>
                    @endforeach
                @else
                    <option value="">-= No Data =-</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Note</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" placeholder="Note" name="txt_motor_rent_note"></textarea>
        </div>
    </div>
</div>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
