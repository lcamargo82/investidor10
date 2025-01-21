# Projeto Comerc

Este projeto é uma API desenvolvida em Laravel. A seguir, estão as instruções para configurar e executar o projeto em um ambiente Docker.

## Pré-requisitos

- Docker
- Docker Compose

## Instruções

### 1. Clone o repositório do GitHub

Clone o repositório para sua máquina local:

```bash
git clone git@github.com:lcamargo82/investidor10.git
```

### 2. Acesse a pasta do projeto

Acesse a pasta do projeto para configurar:

```bash
cd investidor10
```

### 3. Configure o .env

Copie o arquivo env.exemple para .env:

```bash
cp investidor_app/news/.env.example investidor_app/news/.env
```

### 4. Fazer o build e up do container

Faça o buid do container e suba a aplicação:

```bash
docker compose up --build
```

### 5. Instalação das dependências do composer

Instale as dependências da aplicação:

```bash
docker exec -it investidor_app bash -c "cd news && composer install"
```

### 6. Rodar os teste automatizados

Incia os testes unitários:
```bash
docker exec -it investidor_app bash -c "cd news && php artisan migrate --seed"
```

## Observações
- Certifique-se de que suas portas no Docker não estejam em conflito com outras aplicações.
- Configure as variáveis de ambiente no arquivo .env conforme necessário para sua aplicação.