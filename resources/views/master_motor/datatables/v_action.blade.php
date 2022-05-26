<button type="button" onclick="detailModal('{{ $master_motor->c_master_motor_id }}','{{route('master-motor.detail')}}')" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></button>
<button type="button" onclick="editModal('{{ $master_motor->c_master_motor_id }}','{{route('master-motor.edit')}}')" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
<button type="button" onclick="deleteModal('{{ $master_motor->c_master_motor_id }}','{{route('master-motor.delete')}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
