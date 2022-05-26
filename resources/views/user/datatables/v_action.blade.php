<button type="button" onclick="detailModal('{{ $users->c_user_id }}','{{route('user.detail')}}')" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></button>
<button type="button" onclick="editModal('{{ $users->c_user_id }}','{{route('user.edit')}}')" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
<button type="button" onclick="changeUserPassword('{{ $users->c_user_id }}','{{route('user.edit-password')}}')" class="btn btn-warning btn-sm"><i class="fas fa-key"></i></button>
<button type="button" onclick="deleteModal('{{ $users->c_user_id }}','{{route('user.delete')}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
