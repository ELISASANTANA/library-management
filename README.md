# 📚 Library Management

Este repositório contém um sistema de gerenciamento de biblioteca. Siga as etapas abaixo para configurar e iniciar o projeto corretamente.

## 🚀 Como iniciar o projeto

### 1️⃣ Clonar o repositório
Abra o terminal e execute o seguinte comando para clonar o projeto:
```bash
git clone https://github.com/ELISASANTANA/library-management.git
```

### 2️⃣ Acesse a pasta do projeto
```bash
cd library-management
```

### 3️⃣ Instale as dependências
O projeto utiliza Node.js e Composer, então certifique-se de que ambos estejam instalados antes de prosseguir.

Instale as dependências do Node.js:
```bash
npm install
```

Instale as dependências do PHP via Composer:
```bash
composer install
```

### 4️⃣ Configurar o ambiente (.env)

1. Copie o arquivo de configuração exemplo:
```bash
cp .env.example .env
```
2. Abra o arquivo `.env` e configure as credenciais do banco de dados local.

Exemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

3. Gere a chave da aplicação:
```bash
php artisan key:generate
```

### 5️⃣ Rodar as migrações e popular o banco de dados
```bash
php artisan migrate --seed
```
Este comando cria as tabelas e adiciona dados iniciais ao banco.

### 6️⃣ Iniciar o servidor
Para rodar o projeto, execute:
```bash
php artisan serve
```
O servidor estará disponível em: `http://127.0.0.1:8000`

### 7️⃣ Compilar os assets do frontend
Antes de usar a interface, é necessário construir os arquivos do frontend:
```bash
npm run build
```

## 🎯 Resumo dos Comandos

```bash
git clone https://github.com/ELISASANTANA/library-management.git
cd library-management
npm install
composer install
cp .env.example .env
php artisan key:generate
# Edite o .env e configure o banco de dados
php artisan migrate --seed
php artisan serve
npm run build
```

Projeto está pronto! 🚀