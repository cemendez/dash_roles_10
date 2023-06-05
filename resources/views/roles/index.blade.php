@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="float-start">
                <h2>Gestión de Roles</h2>
            </div>
            <div class="float-end">
                @can('crear-rol')
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}"> Crear nuevo rol</a>
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

    <table class="table table-striped table-users" id="table-roles">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('editar-rol')
                            <a class="btn btn-success btn-sm" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                        @endcan
                        @can('borrar-rol')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline"
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
        const dataTable = new simpleDatatables.DataTable("#table-roles")
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
