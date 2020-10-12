<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Sobre o Projeto

Para começar a utilizar as funcionalidades do projeto você deve realizar essa sequência de passos

- git clone https://github.com/Wolaci/logistica_products.git
- composer install
- cp .env.example .env
- configurar o .env com seus dados
- php artisan key:generate
- php artisan migrate
- php artisan storage:link


Após isso vamos ligar o servidor com

- php artisan serve

## Utilizando o Projeto

Ao abrir no navegador irá ter três abas, Login, Register e produto teste

## Produto Teste

Clicando nisso terá um crud só com o título do produto e não haverá paginação e nenhum filtro de acordo com o usuário, isso deve-se ao fato de ser um crud experimental para o usuário tentar se cadastrar e usar as demais funcionalidades.

### Menu

Haverá um menu com duas opções de criar um produto novo ou ver todos os produtos criados,ao clicar se não estiver logado o usuário será redirecionado para a tela de login

## Produtos

Ao logar ele irá se deparar com a tela semelhante, mas irá notar diferenças pois só há produtos cadastrados por ele e ele sabe que é dele pois existe uma relação 1->n em que é adquirido o id do usuário, esse id é utilizado para que apenas ele edite ou delete seus respectivos produtos.


## Adição de fatores

Ele utilizando logado terá a adição da paginação, mensagens de retorno e poderá usurfruir do menu.


## Geral

O projeto possui 

- dois CRUDs
- Sistema de login
- Restrição de acesso a usuários logados
- Relacionamento one-to-many
- Menu no template
- Paginação nas listagens
