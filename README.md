<h1 align="center">Sistema de Gerenciamento de lojas (SGL)</h1>

<p align="center"><img src="public/img/new_projeto2.png" width="500"></p>

<img src="https://img.shields.io/static/v1?label=Status&message=Concluido&color=54CD26&style=for-the-badge&logo=ghost"/>

## Descrição do Projeto
<p align="justify">Uma aplicação com funcionalidades básicas de gerenciamento onde o usuário poderá cadastrar suas lojas, funcionários e produtos.</p>

## Tópicos

<!--ts-->
   * [Instalação](#instalacao)
      * [Pré Requisitos](#pre_requsito)
      * [Preparando aplicação](#preparando_aplicacao)
<!--te-->

<h2 id="instalacao">Instalação</h2>

<h3 id="pre_requsito" >Pré Requisitos</h3>

- Php 7.3 ou superior
- Banco de dados mysql
- Composer
- Node

<h3 id="preparando_aplicacao" >Preparando aplicação</h3>

- Clone este repositório para um repositório local com comando:

    ` git clone <repositorio>`

- Após isso entre no repositório raiz da aplicação e execute o seguinte comando:

    ` composer install`

- Altere o arquivo `.env.example` para somente `.env` e abra ele,
  crie um banco de dados vazio e o configure neste bloco:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_sgl
    DB_USERNAME=root
    DB_PASSWORD=
    ```
- Fazendo isso use o comando `php artisan migrate` para gerar todas as tabelas no banco que a aplicação precisará
- E ultilize também o comando `php artisan db:seed` para gerar todas as seeders necessárias para o projeto

- Execute a aplicação com o comando:

    `php artisan serve`

- Por padrão, ele irá executar a aplicação em `localhost:8000`, abra o navegador e digite o caminho.
