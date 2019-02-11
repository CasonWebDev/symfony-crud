# CRUD utilizando Symfony

Teste de CRUD de uma aplicação de venda de serviços utilizando o framework Symfony 

### Instalação

Clonar o repositório através do comando
> git clone https://github.com/CasonWebDev/symfony-crud.git

Dentro da pasta do projeto executar
> composer install

Configure o arquivo .env para alterar o acesso ao banco de dados na seguinte linha
> DATABASE_URL=mysql://root:root@127.0.0.1:3306/services

Para rodar o servidor local é necessário atribuir environment dev no arquivo .env
> APP_ENV=dev

Crie as tabelas via Doctrine
> php bin/console doctrine:schema:create

Rode o servidor local
> php bin/console server:run

E voilá!
