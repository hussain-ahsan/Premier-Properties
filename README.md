Premier Properties
------------------

### Local setup
1. Clone repo to local computer git clone <repo address>
2. Need to have laravel installed globally
3. Need to have node installed globally
4. Need to Run ```Composer install``` and ```npm install``` to install required dependencies
5. Need to Run ```gulp``` to compile the css, less and fonts in public folder
6. Need to run ```composer dump-autoload``` and ```php artisan clear-compiled``` 
7. Need to run ```php artisan serve``` to run the project

### Configure ```.env``` on root folder
1. Update database configuration 
2. Configure ```SMTP``` email configuration i.e. ```sendgrid```
3. Configure ```RECEIVER_EMAIL``` with the email address on which contact us email will be sent
4. Configure all the upload path related variables by looking in ```.env.example```, i.e. ```USER_RESUME_UPLOAD_PATH```
5. Configure all the permission related  and other variables by looking in ```.env.example```, i.e. ```permission_for_properties```

### Configure ```database```

1. Needs to run ```php artisan migrate:refresh --seed``` to create database and populate with sample data
2. A admin user will be created by default in the database with default credentials 


  
