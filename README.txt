Creation process:

First User auth because authentication is implemented on CRUD of blog
I use a passport,
Installing the package through the terminal
set up through laravel framework
I check through postman if the register and login work - it works - use the token through postman - copy+paste to copy the token during
other CRUD actions on the post.

The next step using Auth from above is to create a blog post and CRUD for logged in users only

Model
Controller
Migration

Make a connection between the User and the Posts so that you know which user created the post

Within the task, there is also filtering by category, but the category is not written in the tasks,
since it is about testing laravel skills, I will assume that you have seen the knowledge about creating CRUD through posts and users with the
relationship one to many user->post

Unit test - tests what functionality within the application does, it is also used when new functionality is added to see if the new functionality works correctly
Testing CRUD with blogs - each of these actions needs a test
I perform some action through the console and look at the test results

I don't know who is reading this, but as it is written in the task in detail, I will describe it step by step,
I apologize if the reader is an advanced php developer

1. To start in the local environment, you can just copy the project to a folder, e.g. if it's a windows environment and the xampp server in the
htdocs folder and import the database through the admin panel
In both cases, the connection to the db should be set in the root/.env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogapi
DB_USERNAME=root
DB_PASSWORD=
and in the same file, access to the email field so that Jobs can do the notification by sending an email when creating a post:
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

There is also a github package link:
process for Installation via git
git clone --link to repo
composer install
composer update
php artisan migrate - creating tables from migrations
uses the postman collection to communicate via postman
Run unit tests with the command: php artisan test
You can test the functionality by importing the Postman Collection, which is in the root folder of the project
First, you register the user by filling in the fields in Postman name, email, password, send a request and copy the obtained token into each subsequent req
in the Authorization tab, select Type "Bearer Token" and paste the token in the token field
Each of the endpoints is named after the function it performs

If there is a question, I can answer it in writing by e-mail or we can have some kind of meeting online,
for example a meet, so that I can explain what is unclear.
Thank you for the opportunity to join the Misija web team
