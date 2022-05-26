<button type="button" onclick="detailModal('{{ $motor_rent->c_motor_rent_id }}','{{route('motor-rent.detail')}}')" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></button>
<button type="button" onclick="editModal('{{ $motor_rent->c_motor_rent_id }}','{{route('motor-rent.edit')}}')" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
<button type="button" onclick="deleteModal('{{ $motor_rent->c_motor_rent_id }}','{{route('motor-rent.delete')}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
