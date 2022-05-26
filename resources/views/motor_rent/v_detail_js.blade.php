@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $motor_rent->c_motor_rent_renter_name }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter ID</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $motor_rent->c_motor_rent_renter_id }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Phone</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $motor_rent->c_motor_rent_renter_phone }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Renter Address</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ $motor_rent->c_motor_rent_renter_address }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Motorcycle</label>
        <div class="col-sm-9">
            <select class="form-control select2" disabled>
                <option value="">-= Select =-</option>
                @if(count($available_motors) > 0)
                    @foreach($available_motors as $motor)
                        <option value="{{ $motor->c_master_motor_id }}" {{ $motor_rent->c_motor_rent_motor == $motor->c_master_motor_id ? 'selected="selected"' : '' }}>{{ $motor->c_master_motor_brand }} - {{ $motor->c_master_motor_series }} ({{ $motor->c_master_motor_number_plate }})</option>
                    @endforeach
                @else
                    <option value="">-= No Data =-</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Start Rent Date</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="{{ date_format(date_create($motor_rent->c_motor_rent_start_rent_date) ,"m/d/Y") }}" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">End Rent Date</label>
        <div class="col-sm-9">
            <div class="input-group date" id="end-rent-date" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#end-rent-date" value="{{ $motor_rent->c_motor_rent_start_rent_date ? date_format(date_create($motor_rent->c_motor_rent_end_rent_date) ,"m/d/Y") : '' }}" disabled/>
                <div class="input-group-append" data-target="#end-rent-date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    @if($motor_rent->c_motor_rent_duration)
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Duration</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ $motor_rent->c_motor_rent_duration }} day(s)" disabled>
            </div>
        </div>
    @endif
    @if($motor_rent->c_motor_rent_total_price)
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Total Price</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ 'IDR. '.number_format($motor_rent->c_motor_rent_total_price).',-' }}" disabled>
            </div>
        </div>
    @endif
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Note</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" placeholder="Note" disabled>{{ $motor_rent->c_motor_rent_renter_address }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            <select class="form-control select2" disabled>
                <option value="">-= Select =-</option>
                <option value="1" {{ $motor_rent->c_motor_rent_status == 1 ? 'selected="selected"' : '' }}>RENTED</option>
                <option value="2" {{ $motor_rent->c_motor_rent_status == 2 ? 'selected="selected"' : '' }}>DONE</option>
            </select>
        </div>
    </div>
</div>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        $('#end-rent-date').datetimepicker({
            allowInputToggle : true,
            format: 'L'
        });
    });
</script>
