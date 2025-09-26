@extends('app')
@section('title', 'Dashboard - Clínica Médica')

@section('content')
<div class="container-fluid py-4">

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Botões superiores --}}
    <div class="d-flex gap-3 mb-4">
        <button type="button"
                class="btn btn-secondary disabled opacity-75 d-flex align-items-center gap-2"
                title="Cadastro ainda não disponível">
            <span>Cadastro</span>
        </button>

        <a href="{{ route('buscarPacientes') }}"
           class="btn btn-primary d-flex align-items-center gap-2">
            <span>Pacientes</span>
        </a>

        <a href="{{ route('cadastrarPaciente') }}"
           class="btn btn-success d-flex align-items-center gap-2">
            <span>+ Cadastrar Paciente</span>
        </a>
    </div>

    {{-- Área do calendário --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h2 class="h4 mb-0 text-dark d-flex align-items-center gap-2">
                <span>Calendário</span>
            </h2>
        </div>

        <div class="card-body p-4">
            <div id="calendar" class="border rounded-3 bg-light" style="height: 600px;">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                    <div class="display-1 mb-3">⏳</div>
                    <p class="h5 mb-2">Calendário em desenvolvimento...</p>
                    <p class="text-muted">Em breve disponível!</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
