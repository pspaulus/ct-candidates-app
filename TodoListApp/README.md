# Laravel API + React

Este proyecto es un ejemplo de una aplicación de lista de tareas (Todo List) que utiliza Laravel para el backend y React para el frontend. La aplicación permite a los usuarios registrarse, iniciar sesión, ver, agregar, editar y eliminar tareas.

<img width="100%" alt="Screenshot" src="https://i.postimg.cc/0jQNrX4S/Captura-de-pantalla-2024-06-11-202419.png">

# Instrucciones

Para ejecutar la aplicación, siga los pasos a continuación:

1. Clone el repositorio en su máquina local.

```bash
git clone https://github.com/christianldev/ct-candidates-app.git
```

2. Navegue a la carpeta del proyecto.

```bash
cd ct-candidates-app
```

3. Instale las dependencias del backend.

```bash
cd backend
composer install
```

4. Copie el archivo de configuración de ejemplo y configure su base de datos.

```bash
cp .env.example .env
```

5. Genere una clave de aplicación.

```bash
php artisan key:generate
```

6. Ejecute las migraciones.

```bash
php artisan migrate
```

7. Instale las dependencias del frontend.

```bash
cd ../frontend
npm install
```

8. Inicie el servidor de desarrollo.

```bash
npm run dev
```

9. Abra su navegador y visite `http://localhost:3000` para ver la aplicación.

# Descripción

El proyecto consta de dos directorios principales:

1. **Backend**: Este directorio contiene el código para el backend de la aplicación. Utiliza Laravel para proporcionar una API RESTful que maneja las operaciones CRUD para las tareas y la autenticación de los usuarios.

2. **Frontend**: Este directorio contiene el código para el frontend de la aplicación. Utiliza React para proporcionar una interfaz de usuario interactiva que permite a los usuarios registrarse, iniciar sesión, ver, agregar, editar y eliminar tareas.

# Características

- Vite: La aplicación frontend está configurada con Vite, un entorno de desarrollo rápido para aplicaciones web modernas.
- React: La aplicación frontend está construida con React, una biblioteca de JavaScript para crear interfaces de usuario interactivas.
- TypeScript: El frontend está escrito en TypeScript, un superconjunto de JavaScript que agrega tipos estáticos opcionales a la sintaxis de JavaScript.
- Tailwind CSS: El frontend utiliza Tailwind CSS, un marco de diseño utilitario de bajo nivel para crear diseños personalizados rápidamente.
- React Router: La aplicación frontend utiliza React Router, una biblioteca de enrutamiento para React que mantiene sincronizada la URL con la interfaz de usuario.
- Laravel: El backend de la aplicación está construido con Laravel, un popular marco de aplicación web de PHP que sigue el patrón de arquitectura MVC.
