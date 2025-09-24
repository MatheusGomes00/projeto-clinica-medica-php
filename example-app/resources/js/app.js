import './bootstrap';

// Carregar cliente OAuth quando disponível
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se tem tokens salvos ao carregar a página
    const accessToken = localStorage.getItem('access_token');
    if (accessToken) {
        console.log('Token OAuth encontrado:', accessToken.substring(0, 20) + '...');
    }
});
