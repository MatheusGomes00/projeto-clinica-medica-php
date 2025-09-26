@extends('layouts.oauth')

@section('title', 'Cadastro - Sistema Clínica')

@section('content')
<div class="container-fluid py-4 bg-light min-vh-100">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6">
            {{-- Card de Cadastro --}}
            <div class="card shadow-lg border-0 rounded-3">
                {{-- Header com gradiente --}}
                <div class="card-header bg-gradient-primary text-white text-center py-4 border-bottom-0 rounded-top-3">
                    <h3 class="h4 mb-0 fw-bold">Cadastro de Médico</h3>
                    <p class="mb-0 opacity-75">Clínica Médica</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    {{-- Mensagens de Erro --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Erro no cadastro</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulário --}}
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nome e Especialidade --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>Nome Completo *
                                </label>
                                <input type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Digite seu nome completo" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="especialidade" class="form-label fw-semibold">
                                    <i class="bi bi-briefcase me-1"></i>Especialidade
                                </label>
                                <select class="form-select form-control-lg @error('especialidade') is-invalid @enderror"
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

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-1"></i>Email *
                            </label>
                            <input type="email"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="seu@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Senha e Confirmação --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1"></i>Senha *
                                </label>
                                <input type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       id="password" name="password"
                                       placeholder="Mínimo 8 caracteres" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="bi bi-shield-lock me-1"></i>Confirmar Senha *
                                </label>
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password_confirmation" name="password_confirmation"
                                       placeholder="Repita a senha" required>
                            </div>
                        </div>

                        {{-- Botão Cadastrar --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold py-2">
                                <i class="bi bi-person-plus me-2"></i>
                                Cadastrar Médico
                            </button>
                        </div>

                        {{-- Link para Login --}}
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Já tenho conta - Fazer Login
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Footer --}}
                <div class="card-footer text-center py-3 bg-light rounded-bottom-3">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Campos marcados com * são obrigatórios
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
    }
    .card {
        border: none;
    }
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection
