# lumen55-rest-api-demo

This is a demo for lumen 5.5 REST api. 

For frontend example, im using [Vuejs 2.2](https://github.com/chrissetyawan/vuejs2-hybrid/) hybrid

## FEATURE

```

- Login, Logout, Register
- CRUD example
- JWT-Auth - tymon/jwt-auth
- Dingo API - dingo/api
- Laravel-CORS barryvdh/laravel-cors

```


## USAGE

```
$ composer install
$ cp .env.example .env
$ vim .env
        DB_*
            config  uration your database
	    JWT_SECRET
            php artisan jwt:secret
	    APP_KEY
            key:generate is abandoned in lumen, please use 
            md5(uniqid())，str_random(32) etc.，maybe use jwt:secret and copy it

$ php artisan migrate
$ php artisan db:seed


```
## REST API DESIGN

just a demo for rest api design

```
    demo： user, post
    
    post   /api/auth              	 create token
    post   /api/register              	 register a new user
    post   /api/login              	 login
    put    /api/authorizations           refresh token
    delete /api/logout            	 logout
    
    post   /api/posts              	 create a post
    get    /api/posts/5            	 post detail
    put    /api/posts/5            	 replace a post
    patch  /api/posts/5            	 update part of a post
    delete /api/posts/5            	 delete a post
    get    /api/users/4/posts            post list of a user
    get    /api/user/posts               post list of current user
```

