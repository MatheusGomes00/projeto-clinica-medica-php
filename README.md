# Clínica Médica - Sistema para Agendamento de Consultas

Este projeto é um sistema web de clínica médica, para gerenciamento de médicos, pacientes e agendamentos.

## Tecnologias Utilizadas

- PHP 8.4.12
- Composer
- Laravel 12.x
- Laravel Passport
- Laravel Sail
- MySQL
- Blade Templates
- Bootstrap 5

## Funcionalidades

- Cadastro e login de Médicos/Users
- Cadastro e listagem de pacientes
- Autenticação por sessão
- Painel de dashboard (em desenvolvimento)
- Busca parametrizada e edição de pacientes (em desenvolvimento)
- Gerenciamento de agendamentos (em desenvolvimento)
- Edição de cadastro de médicos (em desenvolvimento)
- Segurança, autenticação e autorização de usuários com Laravel Passport (em desenvolvimento)
- Containerização utilizando Laravel Sail (em desenvolvimento)

## Instalação e Execução

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/MatheusGomes00/projeto-clinica-medica-php.git
   cd seu-repo
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configure o ambiente:**
   - Copie `.env.example` para `.env` e ajuste as variáveis de banco, mail, etc.

4. **Configure o Passport:**
   ```bash
   php artisan migrate
   php artisan install:api --passport
   php artisan passport:keys
   ```

5. **Ajuste as variáveis OAuth2 no `.env`:**
    - Inicie um novo Client do Passport
    ``` 
    php artisan passport:client
    ```
    - Depois copie as variáveis passadas para o `.env`
   ```
   PASSPORT_CLIENT_ID=seu_client_id
   PASSPORT_CLIENT_SECRET=seu_client_secret
   PASSPORT_REDIRECT_URI=http://localhost:8000/auth/callback
   ```

6. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```

7. **Acesse em:**  
   [http://localhost:8000](http://localhost:8000)

## Fluxo de Autenticação

1. Usuário acessa a tela de login e envia as credenciais.
2. O frontend chama `OAuthClient.authorize()`, iniciando o fluxo OAuth2.
3. Usuário aprova o acesso na tela de autorização.
4. O Passport redireciona para `/auth/callback` com o código de autorização.
5. O frontend troca o código por tokens e armazena no navegador.
6. Usuário é redirecionado para o dashboard.

## Observações

- Os tokens são salvos no `localStorage` via JS para uso em chamadas autenticadas à API.
- O backend nunca armazena tokens manualmente; o Passport faz isso automaticamente.
- O dashboard e demis telas estão em desenvolvimento.
