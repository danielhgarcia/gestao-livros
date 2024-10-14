# Documentação do Banco de Dados - Gestão de Livros

## Estrutura Geral

O banco de dados utilizado é o MySQL, e contém as seguintes tabelas:

---

## 1. Tabela `assuntos`

Armazena os assuntos relacionados aos livros.

| Campo        | Tipo            | Descrição                                    |
|--------------|-----------------|----------------------------------------------|
| `id`         | bigint unsigned | Chave primária, auto-incrementada             |
| `codigo`     | int             | Código único do assunto                      |
| `descricao`  | varchar(20)     | Descrição do assunto                         |
| `created_at` | timestamp       | Data de criação                              |
| `updated_at` | timestamp       | Data da última atualização                   |

**Índices**:
- `PRIMARY KEY (id)`
- `UNIQUE KEY (codigo)`

---

## 2. Tabela `autores`

Armazena os autores dos livros.

| Campo        | Tipo            | Descrição                                    |
|--------------|-----------------|----------------------------------------------|
| `id`         | bigint unsigned | Chave primária, auto-incrementada             |
| `codigo`     | int             | Código único do autor                        |
| `nome`       | varchar(40)     | Nome do autor                                |
| `created_at` | timestamp       | Data de criação                              |
| `updated_at` | timestamp       | Data da última atualização                   |

**Índices**:
- `PRIMARY KEY (id)`
- `UNIQUE KEY (codigo)`

---

## 3. Tabela `livros`

Armazena informações dos livros.

| Campo            | Tipo            | Descrição                                    |
|------------------|-----------------|----------------------------------------------|
| `id`             | bigint unsigned | Chave primária, auto-incrementada             |
| `codigo`         | int             | Código único do livro                        |
| `titulo`         | varchar(40)     | Título do livro                              |
| `editora`        | varchar(40)     | Nome da editora                              |
| `edicao`         | int             | Número da edição                             |
| `ano_publicacao` | varchar(4)      | Ano de publicação                            |
| `valor`          | decimal(8,2)    | Valor monetário do livro                     |
| `created_at`     | timestamp       | Data de criação                              |
| `updated_at`     | timestamp       | Data da última atualização                   |

**Índices**:
- `PRIMARY KEY (id)`
- `UNIQUE KEY (codigo)`

---

## 4. Tabela `livro_assunto`

Tabela intermediária que relaciona livros e assuntos (muitos-para-muitos).

| Campo         | Tipo            | Descrição                                    |
|---------------|-----------------|----------------------------------------------|
| `livro_id`    | bigint unsigned | Chave estrangeira para a tabela `livros`     |
| `assunto_id`  | bigint unsigned | Chave estrangeira para a tabela `assuntos`   |
| `created_at`  | timestamp       | Data de criação                              |
| `updated_at`  | timestamp       | Data da última atualização                   |

**Índices**:
- `PRIMARY KEY (livro_id, assunto_id)`
- `FOREIGN KEY (livro_id)` referencia `livros(id)`
- `FOREIGN KEY (assunto_id)` referencia `assuntos(id)`

---

## 5. Tabela `livro_autor`

Tabela intermediária que relaciona livros e autores (muitos-para-muitos).

| Campo         | Tipo            | Descrição                                    |
|---------------|-----------------|----------------------------------------------|
| `livro_id`    | bigint unsigned | Chave estrangeira para a tabela `livros`     |
| `autor_id`    | bigint unsigned | Chave estrangeira para a tabela `autores`    |
| `created_at`  | timestamp       | Data de criação                              |
| `updated_at`  | timestamp       | Data da última atualização                   |

**Índices**:
- `PRIMARY KEY (livro_id, autor_id)`
- `FOREIGN KEY (livro_id)` referencia `livros(id)`
- `FOREIGN KEY (autor_id)` referencia `autores(id)`

---

## 6. Views

### View `view_livros_por_assunto`

Esta view exibe informações de livros agrupados por assunto.

| Campo                | Tipo            | Descrição                                    |
|----------------------|-----------------|----------------------------------------------|
| `livro_id`           | bigint unsigned | ID do livro                                 |
| `titulo`             | varchar(40)     | Título do livro                             |
| `editora`            | varchar(40)     | Nome da editora                             |
| `ano_publicacao`     | varchar(4)      | Ano de publicação                           |
| `assunto_descricao`  | varchar(20)     | Descrição do assunto                        |
| `autor_nome`         | varchar(40)     | Nome do autor                               |

### View `view_livros_por_autor`

Esta view exibe informações de livros agrupados por autor.

| Campo                | Tipo            | Descrição                                    |
|----------------------|-----------------|----------------------------------------------|
| `livro_id`           | bigint unsigned | ID do livro                                 |
| `titulo`             | varchar(40)     | Título do livro                             |
| `editora`            | varchar(40)     | Nome da editora                             |
| `ano_publicacao`     | varchar(4)      | Ano de publicação                           |
| `autor_nome`         | varchar(40)     | Nome do autor                               |
| `assunto_descricao`  | varchar(20)     | Descrição do assunto                        |

---

## Relacionamentos

- **Livros e Assuntos**: A relação é de muitos para muitos, feita através da tabela intermediária `livro_assunto`.
- **Livros e Autores**: A relação é de muitos para muitos, feita através da tabela intermediária `livro_autor`.

## Migrations

O banco de dados é configurado e gerenciado através de migrations. Para gerar e atualizar as tabelas, execute as migrations com o comando:
```bash
php artisan migrate
