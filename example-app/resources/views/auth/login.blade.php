@extends('app')

@section('title', 'Login - Sistema Clínica')

@section('content')
<div class="container-fluid vh-100 bg-light">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-5 col-lg-4">
            {{-- Card de Login --}}
            <div class="card shadow-lg border-0 rounded-3">
                {{-- Header com gradiente --}}
                <div class="card-header bg-gradient-primary text-white text-center py-4 border-bottom-0 rounded-top-3">
                    <div class="display-1 mb-2">🏥</div>
                    <h3 class="h4 mb-0 fw-bold">Clínica Médica</h3>
                    <p class="mb-0 opacity-75">Acesso Restrito</p>
                </div>

                <div class="card-body p-4">
                    {{-- Mensagens de Status --}}
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-3">

                            <span class="flex-grow-1">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">⚠️</span>
                                <strong>Erro na autenticação</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulário --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">@</span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror border-start-0"
                                       id="email" name="email" value="{{ old('email') }}"
                                       placeholder="seu@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Senha --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">🗝️</span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror border-start-0"
                                       id="password" name="password"
                                       placeholder="Sua senha" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Lembrar-me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Lembrar-me
                            </label>
                        </div>

                        {{-- Botão Entrar --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold py-2">
                                Entrar no Sistema
                            </button>
                        </div>

                        {{-- Divisor --}}
                        <div class="text-center mb-3">
                            <span class="text-muted bg-white px-3">ou</span>
                            <hr class="mt-0">
                        </div>

                        {{-- Cadastrar Nova Conta --}}
                        <div class="d-grid">
                            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg py-2">
                                Cadastrar Nova Conta
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
    }
    .card {
        border: none;
    }
    .input-group-text {
        border-right: 0;
    }
    .form-control.border-start-0 {
        border-left: 0;
    }
    hr {
        border-top: 1px solid #dee2e6;
        margin-top: -12px;
    }
</style>
@endsection
