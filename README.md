# Projeto de Gestão de Livros

## Objetivo

O objetivo principal deste projeto é criar um sistema de gestão de livros, onde é possível realizar o CRUD (Criar, Ler, Atualizar e Deletar) de livros, autores e assuntos, além de gerar relatórios de livros por autor e por assunto.

## Funcionalidades

- **CRUD de livros**: Criação, listagem, edição e exclusão de registros de livros.
- **CRUD de autores**: Gerenciamento de autores associados aos livros.
- **CRUD de assuntos**: Gerenciamento de assuntos relacionados aos livros.
- **Relatórios**:
  - Relatório de livros por autor.
  - Relatório de livros por assunto.
- **Geração de PDFs**: Geração de relatórios em formato PDF.

## Tecnologias Utilizadas

- **PHP**: Versão ^8.2
- **Laravel**: Framework PHP para desenvolvimento web.
- **Bootstrap**: Para estilização e design das interfaces.
- **Banco de Dados MySQL**: Para armazenamento das informações dos livros, autores e assuntos.
- **DomPDF**: Para geração de relatórios em formato PDF.
- **Composer**: Gerenciador de dependências do PHP.
- **PHPUnit**: Para testes unitários.

### Dependências e Versões

- `"laravel/framework": "^11.9"`
- `"barryvdh/laravel-dompdf": "^3.0"`
- `"phpunit/phpunit": "^11.0.1"`
- Outras dependências estão especificadas no arquivo `composer.json`.

## Configuração do Projeto

### Pré-requisitos

- PHP 8.2 instalado
- Composer instalado
- Servidor MySQL
- Node.js (opcional para frontend adicional)

### Instalação do Projeto

1. Clone o repositório:

    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    ```

2. Acesse o diretório do projeto:

    ```bash
    cd gestao-livros
    ```

3. Instale as dependências do PHP:

    ```bash
    composer install
    ```

4. Crie o arquivo `.env` com base no `.env.example` e configure suas variáveis de ambiente, principalmente as variáveis do banco de dados:

    ```bash
    cp .env.example .env
    ```

5. Configure as variáveis de ambiente no arquivo `.env`, especialmente para o banco de dados MySQL:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gestao_livros
    DB_USERNAME=root
    DB_PASSWORD=123456
    ```

6. Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

7. Crie o banco de dados `gestao_livros` e execute as migrations:

    ```bash
    php artisan migrate
    ```

8. Para adicionar dados fictícios, rode o seeder:

    ```bash
    php artisan db:seed
    ```

9. Inicie o servidor de desenvolvimento:

    ```bash
    php artisan serve
    ```

10. Acesse o projeto no navegador:

    ```
    http://127.0.0.1:8000
    ```

## Testes

O projeto utiliza o PHPUnit para testes unitários. Para rodar os testes, utilize o comando:

```bash
./vendor/bin/phpunit
