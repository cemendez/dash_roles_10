@extends('layouts.app')

@if (isset($role))
    @php $action = 'Editar' @endphp
@else
    @php $action = 'Crear' @endphp
@endif

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>{{ $action }} rol</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary" href="{{ route('roles.index') }}"> Atrás</a>
            </div>
        </div>
    </div>

    <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST" novalidate>
        @if (isset($role))
            @method('PATCH')
        @endif
        @csrf

        <div class="mb-3">
            <label class="form-label" for="name">Nombre del Rol:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                value="{{ old('name') ?? @$role->name }}" @error('name') autofocus @enderror required>
            @error('name')
                <small class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="permisos">Permisos para este Rol:</label>
            @error('permission')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @foreach ($permission as $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" id="permiso_{{ $value->id }}"
                        value="{{ $value->id }}"
                        {{ isset($rolePermissions) ? (in_array($value->id, $rolePermissions) ? 'checked' : '') : '' }}>
                    <label class="form-check-label" for="permiso_{{ $value->id }}">
                        {{ $value->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mb-3 float-end">
            <button class="btn btn-primary" type="submit">{{ isset($role) ? 'Modificar' : 'Guardar' }}</button>
        </div>
    </form>
@endsection
