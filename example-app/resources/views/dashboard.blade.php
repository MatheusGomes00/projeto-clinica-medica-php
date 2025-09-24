@extends('app')
@section('title', 'Dashboard - Sistema Clínica')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Conteúdo principal será desenvolvido depois -->
            <div class="alert alert-info">
                <h5>Dashboard em Desenvolvimento</h5>
                <p class="mb-0">Sistema de agendamentos será implementado aqui.</p>
            </div>
        </div>
    </div>
</div>
@endsection
