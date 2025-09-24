class OAuthClient {
    constructor(baseURL = 'http://localhost:8000') {
        this.baseURL = baseURL;
        this.accessToken = localStorage.getItem('access_token');
        this.refreshToken = localStorage.getItem('refresh_token');
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    }

    // Iniciar fluxo de autorização OAuth2
    authorize() {

        window.location.href = `${this.baseURL}/auth/redirect`;
        console.log('Iniciando fluxo OAuth2...');
    }

    // Processar callback após autorização
    async handleCallback() {
        const urlParams = new URLSearchParams(window.location.search);
        const code = urlParams.get('code');
        const error = urlParams.get('error');

        if (error) {
            this.showError(`Erro OAuth: ${error}`);
            return;
        }

        if (code && window.location.pathname.includes('/callback')) {
            await this.exchangeCodeForToken();
        }
    }

    // Trocar código por token
    async exchangeCodeForToken() {
        try {
            const response = await fetch(`${this.baseURL}/auth/callback${window.location.search}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();

            if (data.access_token) {
                this.saveTokens(data);
                this.showSuccess('Autorização realizada com sucesso!');

                // Redirecionar após 2 segundos
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 2000);
            } else {
                throw new Error('Token não recebido na resposta');
            }
        } catch (error) {
            console.error('Erro no callback:', error);
            this.showError(`Erro no callback: ${error.message}`);
        }
    }

    // Salvar tokens no localStorage
    saveTokens(tokenData) {
        localStorage.setItem('access_token', tokenData.access_token);
        if (tokenData.refresh_token) {
            localStorage.setItem('refresh_token', tokenData.refresh_token);
        }

        this.accessToken = tokenData.access_token;
        this.refreshToken = tokenData.refresh_token;

        console.log('Tokens salvos:', {
            access_token: tokenData.access_token.substring(0, 20) + '...',
            expires_in: tokenData.expires_in
        });
    }

    // Fazer chamada autenticada para API
    async apiCall(endpoint, options = {}) {
        if (!this.accessToken) {
            throw new Error('Token de acesso não encontrado. Faça login primeiro.');
        }

        try {
            const response = await fetch(`${this.baseURL}${endpoint}`, {
                ...options,
                headers: {
                    'Authorization': `Bearer ${this.accessToken}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    ...options.headers,
                },
            });

            // Token expirado - tentar refresh
            if (response.status === 401) {
                console.log('Token expirado, tentando refresh...');
                const refreshSuccess = await this.refreshAccessToken();

                if (refreshSuccess) {
                    // Repetir a chamada com novo token
                    return this.apiCall(endpoint, options);
                } else {
                    // Refresh falhou - redirecionar para login
                    this.clearTokens();
                    this.authorize();
                    return null;
                }
            }

            if (!response.ok) {
                throw new Error(`API Error: ${response.status} ${response.statusText}`);
            }

            return response;
        } catch (error) {
            console.error('Erro na chamada API:', error);
            throw error;
        }
    }

    // Refresh do token de acesso
    async refreshAccessToken() {
        if (!this.refreshToken) {
            console.log('Refresh token não disponível');
            return false;
        }

        try {
            const response = await fetch(`${this.baseURL}/api/auth/refresh`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    refresh_token: this.refreshToken
                }),
            });

            if (response.ok) {
                const tokens = await response.json();
                this.saveTokens(tokens);
                console.log('Token refreshed com sucesso');
                return true;
            } else {
                console.log('Falha no refresh do token');
                return false;
            }
        } catch (error) {
            console.error('Erro no refresh:', error);
            return false;
        }
    }

    // Fazer logout
    async logout() {
        try {
            if (this.accessToken) {
                await this.apiCall('/logout', { method: 'POST' });
            }
        } catch (error) {
            console.error('Erro no logout via API:', error);
        } finally {
            this.clearTokens();
            window.location.href = '/login';
        }
    }

    // Limpar tokens
    clearTokens() {
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');
        this.accessToken = null;
        this.refreshToken = null;
    }

    // Verificar se está autenticado
    isAuthenticated() {
        return !!this.accessToken;
    }

    // Obter dados do usuário atual
    async getCurrentUser() {
        try {
            const response = await this.apiCall('/user');
            return response ? await response.json() : null;
        } catch (error) {
            console.error('Erro ao obter usuário:', error);
            return null;
        }
    }

    // Testar conexão com a API
    async testApiConnection() {
        const resultsDiv = document.getElementById('api-results');
        if (!resultsDiv) return;

        resultsDiv.innerHTML = '<p>Testando conexão com API...</p>';

        try {
            if (!this.isAuthenticated()) {
                resultsDiv.innerHTML = '<div class="alert alert-warning">Token não encontrado. Inicie o fluxo OAuth primeiro.</div>';
                return;
            }

            const response = await this.apiCall('/user');
            const userData = await response.json();

            resultsDiv.innerHTML = `
                <div class="alert alert-success">
                    <h6>Conexão API bem-sucedida!</h6>
                    <p><strong>Usuário:</strong> ${userData.name}</p>
                    <p><strong>Email:</strong> ${userData.email}</p>
                    <p><strong>Token válido:</strong> ✅</p>
                </div>
            `;
        } catch (error) {
            resultsDiv.innerHTML = `
                <div class="alert alert-danger">
                    <h6>Erro na API:</h6>
                    <p>${error.message}</p>
                </div>
            `;
        }
    }

    // Métodos de UI auxiliares
    showSuccess(message) {
        this.showMessage(message, 'success');
    }

    showError(message) {
        this.showMessage(message, 'danger');
    }

    showMessage(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Inserir no container de resultados ou no body
        const container = document.getElementById('api-results') || document.body;
        container.insertBefore(alertDiv, container.firstChild);

        // Auto-remover após 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Debug: mostrar status dos tokens
    debugTokenStatus() {
        console.log('OAuth Client Debug:', {
            hasAccessToken: !!this.accessToken,
            hasRefreshToken: !!this.refreshToken,
            accessTokenPreview: this.accessToken ?
                this.accessToken.substring(0, 20) + '...' : 'null',
            isAuthenticated: this.isAuthenticated()
        });
    }
}

// Disponibilizar globalmente
window.OAuthClient = OAuthClient;
