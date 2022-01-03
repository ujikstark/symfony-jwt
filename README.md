Symfony App With JWT
=====================================

What's inside
--------------

- [Symfony](https://github.com/symfony/symfony) 5.4.2 
- [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) ~2.14

Get started
------------

Clone the project:
```sh
$ git clone https://github.com/ujikstark/symfony-jwt
$ cd symfony-jwt
$ composer update
```

Create the database schema:
```sh
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

Generate the SSH keys:
```sh
$ mkdir -p config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
```
fill the pass phrase with 'tesapp'. you can change that in .env
```sh
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
Usage
------

Run the web server:
```sh
$ symfony serve
```

Register a new user:
```
$ curl -X POST http://localhost:8000/api/register -d '{"email": "admin@admin.com", "password": "admin"}'
```

Get a JWT token:
```
$ curl -X POST -H "Content-Type: application/json" http://localhost:8000/api/login_check -d '{"email": "admin@admin.com", "password": "admin"}'  
```
it will return the token

Access a secured route:
```
$ curl -H "Authorization: Bearer [TOKEN]" http://localhost:8000/api/list
```
it will return `you get the data` or `invalid json` if wrong token
