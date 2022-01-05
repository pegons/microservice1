# microservice1

This microservice is one of the two that go together in the https://github.com/pegons/microservice_infrastructure repository.
Remember to put it at the same level as the infrastructure level.



# How to Run without infra

Rename .env.example file to .env inside your project root and fill the database information.
Open the console and cd your project root directory
Run composer install or php composer.phar install

Run php artisan key:generate

Run php artisan migrate

Run php artisan db:seed to run seeders


# How to testing

- Run `vendor/bin/phpunit` to run all tests.
- If you want to take a look at the rideService put and post endpoints, you have them in the files: PostRideServiceControllerTest, PutRideServiceControllerTest
