## Evaluation CT by #CTDesarrallo #Funiber

* Download the files from the repository
```
git clone https://github.com/nicoVillamar-dev/ct-candidates-app
```
* Change branch to the next
```
git checkout feature/nicolle-villamar-task-list
```

* Run Laravel and Vue dependency installations
```
composer install
```
* The Vite version can generate problems, so it is recommended in this case to add the force
```
npm install --force
```
* Make sure you set your environment variables in the .env file according .env.example
* Verify that you are in the project path and run the migrations to create the respective tables.
```
php artisan migrate
```
* Run laravel and node servers
```
npm run build
```
```
php artisan serve
```
* Open the application in the web browser
```
http://127.0.0.1:8000
```
