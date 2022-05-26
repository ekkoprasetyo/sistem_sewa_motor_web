<button type="button" onclick="detailModal('{{ $role->c_role_id }}','{{route('role.detail')}}')" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></button>
<button type="button" onclick="editPermissionRole('{{ $role->c_role_id }}','{{route('role.edit-permission')}}')" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></button>
<button type="button" onclick="editModal('{{ $role->c_role_id }}','{{route('role.edit')}}')" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
<button type="button" onclick="deleteModal('{{ $role->c_role_id }}','{{route('role.delete')}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
