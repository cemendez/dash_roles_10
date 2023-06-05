@extends('layouts.app')

@if (isset($user))
    @php $action = 'Editar' @endphp
@else
    @php $action = 'Crear' @endphp
@endif

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>{{ $action }} usuario</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary" href="{{ route('users.index') }}"> Atrás</a>
            </div>
        </div>
    </div>

    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" novalidate>
        @if (isset($user))
            @method('PATCH')
        @endif
        @csrf

        <div class="mb-3">
            <label class="form-label" for="name">Nombre</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                value="{{ isset($user->name) ? $user->name : old('name') }}" @error('name') autofocus @enderror required>
            @error('name')
                <small class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Correo</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                value="{{ isset($user->email) ? $user->email : old('email') }}" @error('email') autofocus @enderror
                required>
            @error('email')
                <small class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="password" value="{{ old('password') }}" @error('password') autofocus @enderror required>
            @error('password')
                <small class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation">Confirmación de Contraseña</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="roles">Roles</label>
            <select class="form-select @error('roles') is-invalid @enderror" name="roles" id="roles"
                @error('roles') autofocus @enderror required>
                <option value="" disabled selected>Selecciona un Rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" @if (old('roles') === $rol->name || (isset($userRole) ? $userRole[0]->name === $rol->name : '')) selected @endif>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
            @error('roles')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 float-end">
            <button class="btn btn-primary" type="submit">{{ isset($user) ? 'Modificar' : 'Guardar' }}</button>
        </div>
    </form>
@endsection
