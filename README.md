## Evaluation CT by #CTDesarrallo #Funiber

* Download the files from the repository
```
$ git clone https://github.com/nicoVillamar-dev/ct-candidates-app
```
* Run Laravel and Vue dependency installations
```
$ composer install
$ npm install
```
* Make sure you set your environment variables in the .env file according .env.template
* Verify that you are in the project path and run the migrations to create the respective tables.
```
$ php artisan migrate
```
* Run wamp and node servers
```
$ npm run build
$ php artisan serve
```
* Open the application in the web browser
```
$ http://127.0.0.1:8000/login
```
