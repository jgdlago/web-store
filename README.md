<h2>Soluct web-store</h2>

<ul>
  <h3>Preparação do ambiente</h3>
  <p>Após clonar o projeto abra o terminal na pasta do projeto e execute os seguintes comando:</p>
  
    sail up -d
  <p>Inicia o build e sobe os containers</p>
  
    sail composer install
  <p>Instala as dependencias</p>
  
    sail composer update
  <p>Atualiza as depêndencias, e corrige eventuais problemas na instalação</p>
  
    sail artisan migrate
  <p>Cria o banco de dados</p>
  
    sail artisan db:seed
  <p>Cria os seeders</p>

  <p>O arquivo .env deve conter as definições de E-mail desejadas para o funcionamento correto do sistema.</p>
</ul>
