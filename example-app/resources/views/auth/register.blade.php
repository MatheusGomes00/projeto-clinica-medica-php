@extends('layouts.oauth')

@section('title', 'Cadastro - Sistema Clínica')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Cadastro de Médico</h4>
                </div>
                <div class="card-body">
                   @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="especialidade" class="form-label">Especialidade</label>
                                <select class="form-control @error('especialidade') is-invalid @enderror"
                                        id="especialidade" name="especialidade">
                                    <option value="">Selecione uma especialidade</option>
                                    <option value="Cardiologia" {{ old('especialidade') == 'Cardiologia' ? 'selected' : '' }}>Cardiologia</option>
                                    <option value="Pediatria" {{ old('especialidade') == 'Pediatria' ? 'selected' : '' }}>Pediatria</option>
                                    <option value="Dermatologia" {{ old('especialidade') == 'Dermatologia' ? 'selected' : '' }}>Dermatologia</option>
                                    <option value="Ginecologia" {{ old('especialidade') == 'Ginecologia' ? 'selected' : '' }}>Ginecologia</option>
                                    <option value="Ortopedia" {{ old('especialidade') == 'Ortopedia' ? 'selected' : '' }}>Ortopedia</option>
                                    <option value="Neurologia" {{ old('especialidade') == 'Neurologia' ? 'selected' : '' }}>Neurologia</option>
                                    <option value="Psiquiatria" {{ old('especialidade') == 'Psiquiatria' ? 'selected' : '' }}>Psiquiatria</option>
                                    <option value="Urologia" {{ old('especialidade') == 'Urologia' ? 'selected' : '' }}>Urologia</option>
                                    <option value="Geral" {{ old('especialidade') == 'Geral' ? 'selected' : '' }}>Clínico Geral</option>
                                </select>
                                @error('especialidade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control"
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                Já tenho conta - Fazer Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
