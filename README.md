# Microservice1 (Have Openapi/Swagger)

This microservice is one of the two that go together in the https://github.com/pegons/microservice_infrastructure repository.
Remember to put it at the same level as the infrastructure level.



# How to Run without infra

Rename .env.example file to .env inside your project root and fill the database information.

```php
DB_CONNECTION = mysql
DB_HOST = 127.0.0.1
DB_PORT = 3306 (This is usually the default)
DB_DATABASE = {Name of the DB}
DB_USERNAME = {DB user}
DB_PASSWORD = {DB password}
```
Open the console and cd your project root directory
Run composer install or php composer.phar install
```bash
Run php artisan key:generate

Run php artisan migrate

Run php artisan db:seed to run seeders
```

# How to testing

- Run `vendor/bin/phpunit` to run all tests.
- If you want to take a look at the rideService put and post endpoints, you have them in the files: PostRideServiceControllerTest, PutRideServiceControllerTest


# DDD STRUCTURE EXPLAINED

-In app is the part coupled to Laravel that we cannot take to core as
controllers, formRequest, and DB models.

- In core, the project is broken down into the three main layers: **Application, Domain and
Infrastructure**.

-In the tests folder, we can see the three possible test suites:

  -**E2E**: That they launch the request on a route, waiting for a response (As if you were using
      postman, you can see the response by debugging the variable $ response).

  -**Unit**: Totally unitary test, with use of Mocks, of the Application services, in this c
      I have only made one to serve as an example.

   -**Integration**: Checking the functions that interact with DB, to see what
      they return what we expect.
      
  # CORE FOLDER
   **DOMAIN**:
              - Inside the Domain folder, you can see both the created value-objects used to define
                the domain, as the domain entities themselves. (Not much domain logic, since
                all endpoint functions are more of a CRUD).
                
  **APPLICATION**: 
              Within Application, we have the application layer that in this case will be in charge of
              receive from the controller the corresponding data or data, interact with the domain, and use the
              interface contracts, which will implement their corresponding repositories for
              persist/query.

  **INFRASTRUCTURE**: 
              Infrastructure has the implementation according to the contract / interface that defines the domain, on
              the repositories.
              
              
# FINALLY THE DATA FLOW IS
      Controller → Application Service → Domain → Application Service → Repository →
      Application Service → Controller → Response.
      
As you can see, it follows the flow of **Hexagonal Architecture**.


