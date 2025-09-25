{{-- paciente.blade.php --}}
@extends('app')

@section('title', 'Cadastro de Paciente')

@section('content')
{{-- Container principal com gradiente suave --}}
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8 px-4 sm:px-6 lg:px-8">

    {{-- Container centralizado com largura máxima --}}
    <div class="max-w-lg mx-auto">

        {{-- Cabeçalho com ícone e título --}}
        <div class="text-center mb-8">
            {{-- Ícone circular com gradiente --}}
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>

            {{-- Título e descrição --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Cadastro de Paciente</h1>
            <p class="text-gray-600 text-lg">Preencha os dados do novo paciente</p>
        </div>

        {{-- Card do formulário com sombra e bordas suaves --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">

            {{-- Formulário com espaçamento entre os campos --}}
            <form method="POST" action="{{ route('cadastrarPaciente') }}" class="space-y-6">
                @csrf

                {{-- Campo Nome --}}
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome Completo *
                    </label>
                    <input type="text"
                           id="nome"
                           name="nome"
                           required
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                           placeholder="Digite o nome completo"
                           value="{{ old('nome') }}">
                    {{-- Exibição de erro de validação --}}
                    @error('nome')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Telefone --}}
                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">
                        Telefone *
                    </label>
                    <input type="tel"
                           id="telefone"
                           name="telefone"
                           required
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                           placeholder="(11) 99999-9999"
                           value="{{ old('telefone') }}">
                    @error('telefone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Email (opcional) --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-mail
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                           placeholder="paciente@exemplo.com"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Data de Nascimento --}}
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-2">
                        Data de Nascimento *
                    </label>
                    <input type="date"
                           id="data_nascimento"
                           name="data_nascimento"
                           required
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 text-gray-700"
                           value="{{ old('data_nascimento') }}"
                           max="{{ date('Y-m-d') }}">
                    @error('data_nascimento')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Container dos botões com espaçamento --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">

                    {{-- Botão Cadastrar (primário) --}}
                    <button type="submit"
                            class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center">
                        {{-- Ícone de check --}}
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Cadastrar Paciente
                    </button>

                    {{-- Botão Cancelar (secundário) --}}
                    <button type="button"
                            onclick="window.history.back()"
                            class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center justify-center">
                        {{-- Ícone de x --}}
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>

        {{-- Nota sobre campos obrigatórios --}}
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>* Campos obrigatórios</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para telefone
    const telefoneInput = document.getElementById('telefone');

    telefoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');

        // Aplica máscara para telefones brasileiros
        if (value.length <= 11) {
            if (value.length === 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length === 10) {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }

            e.target.value = value;
        }
    });

    // Validação básica do formulário
    const form = document.querySelector('form');

    form.addEventListener('submit', function(e) {
        const nome = document.getElementById('nome').value.trim();
        const telefone = document.getElementById('telefone').value.trim();
        const dataNascimento = document.getElementById('data_nascimento').value;

        // Validação de campos obrigatórios
        if (!nome) {
            e.preventDefault();
            alert('Por favor, preencha o nome do paciente.');
            document.getElementById('nome').focus();
            return;
        }

        // Remove caracteres não numéricos para validar telefone
        const telefoneLimpo = telefone.replace(/\D/g, '');
        if (!telefoneLimpo || telefoneLimpo.length < 10) {
            e.preventDefault();
            alert('Por favor, preencha um telefone válido.');
            document.getElementById('telefone').focus();
            return;
        }

        if (!dataNascimento) {
            e.preventDefault();
            alert('Por favor, selecione a data de nascimento.');
            document.getElementById('data_nascimento').focus();
            return;
        }
    });
});
</script>
@endsection
