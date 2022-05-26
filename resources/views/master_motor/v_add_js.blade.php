@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Brand</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="txt_master_motor_brand">
                <option value="">-= Select =-</option>
                <option value="YAMAHA">YAMAHA</option>
                <option value="HONDA">HONDA</option>
                <option value="SUZUKI">SUZUKI</option>
                <option value="KAWASAI">KAWASAKI</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Series</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Aerox 155" name="txt_master_motor_series">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Number Plate</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="B1234XYZ" name="txt_master_motor_number_plate">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Price</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="100000" name="txt_master_motor_price">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" placeholder="Description" name="txt_master_motor_description"></textarea>
        </div>
    </div>
</div>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
