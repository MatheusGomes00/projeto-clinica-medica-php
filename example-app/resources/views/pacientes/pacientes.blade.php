@extends('app')

@section('content')
<div class="container-fluid py-4">

    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-dark mb-1">Lista de Pacientes</h1>
            <p class="text-muted mb-0">Gerencie os pacientes do sistema</p>
        </div>

        {{-- Botão cadastrar --}}
        <a href="{{ route('cadastrarPaciente') }}"
           class="btn btn-primary btn-lg fw-semibold px-4 py-2 shadow-sm">
            <i class="bi bi-person-plus me-2"></i>
            Cadastrar Paciente
        </a>
    </div>

    {{-- Formulário de pesquisa --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('buscarPacientes') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label for="busca" class="form-label fw-semibold">Pesquisar paciente</label>
                    <input type="text" name="busca" value="{{ request('busca') }}"
                           placeholder="Digite o nome, email ou telefone do paciente..."
                           class="form-control form-control-lg">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-dark btn-lg w-100 fw-semibold">
                        <i class="bi bi-search me-2"></i>
                        Pesquisar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Listagem de pacientes --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="card-title mb-0 fw-semibold">
                <i class="bi bi-people me-2"></i>
                Pacientes Cadastrados
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3 fw-semibold border-0">Nome</th>
                            <th class="px-4 py-3 fw-semibold border-0">Email</th>
                            <th class="px-4 py-3 fw-semibold border-0">Telefone</th>
                            <th class="px-4 py-3 fw-semibold border-0">Data de Nascimento</th>
                            <th class="px-4 py-3 fw-semibold border-0 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pacientes as $paciente)
                            <tr class="align-middle">
                                <td class="px-4 py-3 border-0">
                                    <div class="fw-semibold text-dark">{{ $paciente->nome }}</div>
                                </td>
                                <td class="px-4 py-3 border-0 text-muted">{{ $paciente->email }}</td>
                                <td class="px-4 py-3 border-0">
                                    <span class="badge bg-light text-dark border">{{ $paciente->telefone }}</span>
                                </td>
                                <td class="px-4 py-3 border-0">
                                    <span class="text-muted">{{ $paciente->data_nascimento }}</span>
                                </td>
                                <td class="px-4 py-3 border-0 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-people display-4 d-block mb-3"></i>
                                        <h5 class="fw-semibold">Nenhum paciente encontrado</h5>
                                        <p class="mb-0">Utilize o campo de pesquisa para encontrar pacientes.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Paginação --}}
    @if($pacientes->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Navegação de pacientes">
                {{ $pacientes->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    @endif

</div>

<style>
    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        border-radius: 0.375rem;
        margin: 0 2px;
    }
    .card {
        border-radius: 0.75rem;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

@endsection
