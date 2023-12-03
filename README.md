# Todo List App

## Prerequisites

Make sure you have the following prerequisites installed before getting started:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/)
- [XAMPP](https://www.apachefriends.org/)

## Steps to Start the Application

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/pspaulus/ct-candidates-app
    ```
2. **Configure the .env File:**

    Copy the .env.example file to a new file named .env.
    ```bash
   cp .env.example .env
   ```

3. **Generate Keys for the .env File:**
    ```bash
   php artisan key:generate
   ```
4. **Run Migrations:**
    ```bash
   php artisan migrate
   ```
5. **Start the Artisan Server:**
    ```bash
   php artisan serve
   ```
6. **Compile NPM Resources:**
    ```bash
    npm install
    npm run dev
   ```

7. **Open the Application:**

   Open your web browser and visit http://localhost:8000
