@extends('app')

@section('title', 'Cadastro de Paciente')

@section('content')
<div class="container-fluid py-4 bg-light min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            {{-- Cabeçalho --}}
            <div class="text-center mb-5">
                <div class="mx-auto bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center mb-4"
                     style="width: 80px; height: 80px;">
                    <i class="bi bi-person-plus text-white display-6"></i>
                </div>
                <h1 class="h2 fw-bold text-dark mb-2">Cadastro de Paciente</h1>
                <p class="text-muted lead">Preencha os dados do novo paciente</p>
            </div>

            {{-- Card do formulário --}}
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('cadastrarPaciente') }}">
                        @csrf

                        {{-- Campo Nome --}}
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold">
                                Nome Completo <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nome"
                                   name="nome"
                                   required
                                   class="form-control form-control-lg @error('nome') is-invalid @enderror"
                                   placeholder="Digite o nome completo"
                                   value="{{ old('nome') }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Telefone --}}
                        <div class="mb-4">
                            <label for="telefone" class="form-label fw-semibold">
                                Telefone <span class="text-danger">*</span>
                            </label>
                            <input type="tel"
                                   id="telefone"
                                   name="telefone"
                                   required
                                   class="form-control form-control-lg @error('telefone') is-invalid @enderror"
                                   placeholder="(11) 99999-9999"
                                   value="{{ old('telefone') }}">
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                E-mail
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   placeholder="paciente@exemplo.com"
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Data de Nascimento --}}
                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label fw-semibold">
                                Data de Nascimento <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   id="data_nascimento"
                                   name="data_nascimento"
                                   required
                                   class="form-control form-control-lg @error('data_nascimento') is-invalid @enderror"
                                   value="{{ old('data_nascimento') }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botões --}}
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end pt-3">
                            <button type="button"
                                    onclick="window.history.back()"
                                    class="btn btn-outline-secondary btn-lg flex-md-fill">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancelar
                            </button>
                            <button type="submit"
                                    class="btn btn-primary btn-lg flex-md-fill">
                                <i class="bi bi-check-circle me-2"></i>
                                Cadastrar Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Nota sobre campos obrigatórios --}}
            <div class="text-center mt-4">
                <small class="text-muted">
                    <span class="text-danger">*</span> Campos obrigatórios
                </small>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
    }
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    .bg-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection

@section('scripts')
<script>

</script>
@endsection
