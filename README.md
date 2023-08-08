## Instalação

Primeiro passo é garantir que a variável "php" esteja disponivel no console. Para isso basta seguir a documentação.

- **[Unix](https://www.php.net/manual/en/install.unix.php)**
- **[Mac](https://www.php.net/manual/en/install.macosx.php)**
- **[Windows](https://www.php.net/manual/en/install.windows.php)**


## Como usar

Depois de instalar a variável PHP. Acesse o root do projeto e rode o seguinte comando.
```
php artisan serve
```

O comando irá resultar em uma url do servidor, neste caso http://127.0.0.1:8000
```
$ php artisan serve

  INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to stop the server
```


>As url do postman estão configuradas para esta, caso apareça alguma oura ou outra porta, favor alterar no postman para a URL que aparecer no comando acima.

## Postman

Dentro do projeto tem uma pasta "Postman", que contem todas as requests do projeto.


## Tecnologias

* PHP 8.2.5
* Laravel 10.17.1
* Sqlite