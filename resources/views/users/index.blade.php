@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="float-start">
                <h2>Gestión de Usuarios</h2>
            </div>
            <div class="float-end">
                @can('crear-usuario')
                    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        </script>
    @endif

    <table class="table table-striped table-users" id="table-users">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $rolName)
                                <label class="badge text-bg-warning">{{ $rolName }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('editar-usuario')
                            <a class="btn btn-success btn-sm" href="{{ route('users.edit', $user->id) }}">Editar</a>
                        @endcan
                        @can('borrar-usuario')
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                id="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        const dataTable = new simpleDatatables.DataTable("#table-users")
        document.addEventListener("submit", (e) => {
            e.preventDefault()
            Swal.fire({
                title: "¿Estás seguro de eliminarlo?",
                text: "¡No se podrán revertir los cambios!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, borralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit()
                }
            })
        })
    </script>
@endsection
