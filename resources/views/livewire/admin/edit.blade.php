@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <!-- Aquí incluir los campos del formulario con los valores actuales del usuario -->

        <button type="submit">Guardar cambios</button>
    </form>
@endsection