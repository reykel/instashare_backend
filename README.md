#  Insta Share System Backend  
 
## Getting Started

Insta Share System Backend is an application based on the [Laravel Framework](https://laravel.com/) and [Laravel Passport](https://laravel.com/docs/11.x/passport) which provides a full OAuth2 server implementation. The system core structure works as a backend component for implementing an API REST solution [Insta Share API REST Solution](https://api.instashare.com/api/). The system is configured to require a secure connection on deployment. Therefore, an SSL certificate must be installed on the destination domain before runs deployment process. Also you are going to require an email provider and [Pusher account](https://pusher.com) configuration to be set and running. 

To get started, clone this repository from GitHub and follow the steps indicated on Application setup session.

## Stage and Features

This project is at an early stage of the development process. As a work-in-progress repository, its content will be increased and adjusted by a periodic succession of commits pushed from the local environment. The set of features currently uploaded are those related to platform management. No business logic has been developed yet, except for modules designed for testing and demonstration purposes. A more extensive explanation will be posted in the wiki session.

## Application setup

1. Clone the sample application repository.
2. Navigate to the root folder of the application in the command line.
3. Run composer install
4. Set environment (.env) file with database credentials
5. Run php artisan key:generate
6. Run php artisan migrate:fresh
7. Run php artisan db:seed --class=ProductionSeeder
7. Run php artisan passport:keys
8. Set environment (.env) file with configuration data
9. Run php artisan serve

Next step navigate to **http://localhost:8000/** to view the application.</p>

## Application testing

1. Change the database name on the .env file to testing database.
2. Set mail service to a sandbox environment like mailtrap.io
3. Navigate to the root folder of the application in the command line.
4. Run vendor/bin/phpunit
5. Change the database name on the .env file to local database.

## License

[MIT](http://opensource.org/licenses/MIT)

Copyright (c) 2024-present, [Insta Share Solutions](https://instashare.com/)
