# my-tnl-challenge
professional project proposed by tonolucro

para rodar o projeto será necessário configurar o .env, de acordo com o sample presente no mesmo.

temos duas pastas com os dois projetos, onde o nosso "server" está no src na raiz do projeto, e o nosso "cliente" está na pasta docker2>src.

para rodar o projeto em modo de produção, é necessário rodar as migrations utilizando o docker-compose run artisan migrate

o composer será instalado automaticamente ao subir os containers usando docker-compose up --build

qualquer outra duvida basta comentar no projeto.
