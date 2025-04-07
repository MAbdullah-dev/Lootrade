
# Ghitloot 🎮💰

Welcome to the **Ghitloot** project! This is a Laravel-based web application designed for [brief project description, e.g., gaming, e-commerce, etc.]. Follow the instructions below to set up your local development environment. 🚀

---

## Getting Started 🚀

To get started with the **Ghitloot** project, follow these steps:

### 1. Clone the Repository 📂

First, clone the repository to your local machine:

```bash
git clone https://github.com/MAbdullah-dev/Ghitloot.git
```

### 2. Setup Environment File 🌱

After cloning the repo, navigate to the root of the project and create a new `.env` file. You can copy the contents from the `.env.example` file, or you can generate one using ChatGPT.

```bash
cp .env.example .env
```

Now, open the `.env` file and configure the necessary environment variables. At a minimum, you should set the following:

- **Database Connection**:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

You can set any other environment variables based on your specific setup. 🛠️

---

### 3. Install PHP Dependencies 📦

Run the following command to install all PHP project dependencies:

```bash
composer install
```

---

### 4. Install Frontend Dependencies 📦

If your project has frontend dependencies, navigate to the project’s frontend directory (if separate) and run:

```bash
npm install
```

---

### 5. Build Assets 🏗️

After installing the necessary Node.js dependencies, you need to build the frontend assets for production:

```bash
npm run build
```

---

### 6. Run Development Server 💻

To run the application in development mode with hot-reloading:

```bash
npm run dev
```

This will start the development server, allowing you to see live updates as you make changes.

---

### 7. Generate Application Key 🔑

Next, generate the Laravel application key:

```bash
php artisan key:generate
```

This will set a random key in your `.env` file for securing user sessions and other encrypted data.

---

### 8. Setup Storage Link 🗄️

Run this command to create a symbolic link for storage:

```bash
php artisan storage:link
```

This allows you to store public assets in the `storage` directory.

---

### 9. Run Migrations and Seeders 🛠️

Now, run the database migrations to set up your database structure:

```bash
php artisan migrate
```

You will be prompted with `Do you wish to continue? [y/N]`. Type `y` and press enter.

After migrating, you can seed your database with sample data (optional but recommended):

```bash
php artisan db:seed
```

If you have a specific seeder, you can run it like this:

```bash
php artisan db:seed --class=YourSeederClass
```

---

### 10. Run the Application 🖥️

Finally, start the Laravel development server:

```bash
php artisan serve
```

Your application will now be live at [http://localhost:8000](http://localhost:8000). 🎉

---

## Troubleshooting ⚠️

- **Missing `.env` file**: Make sure you create the `.env` file from `.env.example` before proceeding.
- **Database issues**: Ensure the database details in your `.env` file are correct.
- **Composer errors**: If you run into issues with Composer, try running `composer update` or `composer install` again.
- **NPM errors**: If you encounter issues with NPM, try running `npm install` again, or check for missing dependencies.

---

## Additional Notes 📝

- If you need any custom configuration, such as queue or cache settings, you can modify the `.env` file accordingly.
- For more advanced setups (like deployment or CI/CD), refer to the official [Laravel Documentation](https://laravel.com/docs).
- Ensure your PHP version is compatible with the Laravel version in this project. Check the PHP version with `php -v`.

---

## License 🛡️

This project is open source and available under the [MIT License](LICENSE).

---

## Contributing 🤝

We welcome contributions to improve **Ghitloot**. If you have suggestions or bug fixes, feel free to fork the repo and submit a pull request. Please follow the [Code of Conduct](CODE_OF_CONDUCT.md) and adhere to the project's [contribution guidelines](CONTRIBUTING.md).

---

**Enjoy coding with Ghitloot!** Happy developing! 💻🎮
