@extends('app')

@section('title', 'Processando Autorização OAuth2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">🔄 Processando Autorização OAuth2</h4>
                </div>
                <div class="card-body text-center">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="lead">Finalizando processo de autenticação...</p>
                    <div id="callback-result" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const resultsDiv = document.getElementById('callback-result');

    // Obter parâmetros da URL
    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');
    const state = urlParams.get('state');
    const error = urlParams.get('error');

    if (error) {
        resultsDiv.innerHTML = `
            <div class="alert alert-danger">
                <h5>❌ Erro na Autorização</h5>
                <p><strong>Erro:</strong> ${error}</p>
                <p><strong>Descrição:</strong> ${urlParams.get('error_description') || 'Autorização negada pelo usuário'}</p>
                <a href="/dashboard" class="btn btn-primary">Voltar ao Dashboard</a>
            </div>
        `;
        return;
    }

    if (code && state) {
        // Processar callback via API
        fetch('auth/callback?' + window.location.search, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                resultsDiv.innerHTML = `
                    <div class="alert alert-success">
                        <h5>✅ Autorização Bem-sucedida!</h5>
                        <p><strong>Token obtido:</strong> ${data.access_token.substring(0, 30)}...</p>
                        <p><strong>Expira em:</strong> ${data.expires_in} segundos</p>
                        <div class="mt-3">
                            <button class="btn btn-primary me-2" onclick="testAPI()">Testar API</button>
                            <a href="/oauth/success" class="btn btn-success">Ver Detalhes</a>
                        </div>
                    </div>
                `;

                // Salvar token no localStorage para uso posterior
                localStorage.setItem('oauth_access_token', data.access_token);
                if (data.refresh_token) {
                    localStorage.setItem('oauth_refresh_token', data.refresh_token);
                }

            } else {
                resultsDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <h5>❌ Erro no Callback</h5>
                        <p>${data.error}</p>
                        <a href="/dashboard" class="btn btn-primary">Voltar ao Dashboard</a>
                    </div>
                `;
            }
        })
        .catch(error => {
            resultsDiv.innerHTML = `
                <div class="alert alert-danger">
                    <h5>❌ Erro de Comunicação</h5>
                    <p>${error.message}</p>
                    <a href="/dashboard" class="btn btn-primary">Voltar ao Dashboard</a>
                </div>
            `;
        });
    } else {
        resultsDiv.innerHTML = `
            <div class="alert alert-warning">
                <h5>⚠️ Parâmetros Inválidos</h5>
                <p>Código de autorização não encontrado na URL.</p>
                <a href="/dashboard" class="btn btn-primary">Voltar ao Dashboard</a>
            </div>
        `;
    }
});

async function testAPI() {
    const token = localStorage.getItem('oauth_access_token');
    if (!token) {
        alert('Token não encontrado!');
        return;
    }

    try {
        const response = await fetch('/api/user', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        document.getElementById('callback-result').innerHTML += `
            <div class="alert alert-info mt-3">
                <h6>🧪 Teste da API /user:</h6>
                <pre>${JSON.stringify(data, null, 2)}</pre>
            </div>
        `;

    } catch (error) {
        alert('Erro no teste da API: ' + error.message);
    }
}
</script>
@endpush
