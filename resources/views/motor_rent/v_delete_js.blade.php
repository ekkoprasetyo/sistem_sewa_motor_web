@include('motor_rent.v_detail_js')
@csrf
<input type="text" value="{{ $motor_rent->c_motor_rent_id }}" name="txt_motor_rent_id" hidden="hidden">
