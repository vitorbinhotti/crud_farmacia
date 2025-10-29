## Enunciado atividade

Cenário Único
A Farmácia Vila Boa precisa controlar seus materiais/insumos (ex.: Dipirona, Seringa 5 ml).
Você deve criar, sozinho, um CRUD em PHP (XAMPP) com um banco simples no MySQL.

Requisitos (mínimos)
Tecnologias: PHP 7+ no XAMPP (Apache+MySQL), PDO + prepared statements e msqli + 

prepared statements  .
Funcionalidades: Criar, Listar (com busca por nome), Editar, Excluir.
Validações: nome, unidade, estoque_atual ≥ 0, preço ≥ 0; mensagens claras.
UX: formulário simples; feedback de sucesso/erro.
Segurança básica: prepared statements, htmlspecialchars na saída.
Documentação: Documente o banco com o D. de Entidade Relacionamento e monte o D. Caso de Uso.
Entrega (individual)
Repositório do Projeto com todos os arquivos + README. [cópias serão desconsideradas]

## Como executar o projeto

1. **Clone o repositório**  
    Faça o download dos arquivos do projeto para sua máquina.

2. **Configure o ambiente**  
    - Instale o [XAMPP](https://www.apachefriends.org/).

3. **Acesse o sistema**  
    - Coloque a pasta do projeto em `htdocs`.
    - No navegador, acesse: `http://localhost/vitor-atividades-php/crud_farmacia/`


## Validações

- Nome e unidade obrigatórios.
- Estoque atual e preço não podem ser negativos.
- Mensagens claras de sucesso ou erro em todas as operações.

## Segurança

- Uso de prepared statements (PDO ou MySQLi) para evitar SQL Injection.
- Saída de dados tratada com `htmlspecialchars`.

