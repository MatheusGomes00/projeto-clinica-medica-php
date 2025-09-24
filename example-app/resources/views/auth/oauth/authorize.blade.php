@extends('app')

@section('title', 'Autorizar Aplicação')

@section('content')
<div class="card" style="max-width: 600px; margin: 2rem auto; padding: 2rem; border: 1px solid #ddd;">
    <h2>Permitir acesso?</h2>
    <p>
        O aplicativo <strong>{{ $client->name }}</strong> está solicitando permissão para acessar sua conta.
    </p>

    @if (count($scopes) > 0)
        <p><strong>Escopos solicitados:</strong></p>
        <ul>
            @foreach ($scopes as $scope)
                <li>{{ $scope->description }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('passport.authorizations.approve') }}">
        @csrf
        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">

        <button type="submit" class="btn btn-success">Autorizar</button>
    </form>

    <form method="POST" action="{{ route('passport.authorizations.deny') }}" style="margin-top: 1rem;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">

        <button type="submit" class="btn btn-danger">Negar</button>
    </form>
</div>
@endsection
