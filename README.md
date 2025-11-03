# Books Library App

## Overview

The Books Library App is a web application built using Laravel that allows users to create, view, and manage a personal library of books. Authenticated users can add new books, categorize them by genre, and view detailed information about each book, including the author, year of publication, number of pages, and optional cover images.

## Features

- **User Authentication:** Secure access to the application, allowing users to manage their personal library.
- **Book Management:** Create, view, update, and delete books in the library.
- **Genre Management:** Assign genres to books for easy categorization.
- **Search and Filter:** Search for books by title, author, or genre.
- **Pagination:** Books are paginated for easier navigation.
- **Dynamic Badges:** Display genres with visually distinct badges based on their names.
- **Optional Cover Images:** Upload and display book cover images.

## Installation

### Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP >= 8.2
- Composer
- Node.js and npm
- Laravel
- A database (MySQL, PostgreSQL, etc.)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Volodymyr0587/laravel-books-library
   cd laravel-books-library
   ```
2. **Install dependencies**
    ```bash
    composer install
    npm install
    ```
3. **Set up environment variables**
    ```bash
    cp .env.example .env
    ```
    Update the .env file with your database credentials and other necessary configurations.
4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```
5. **Run Migrations and Seeders Set up the database by running migrations**
    ```bash
    php artisan migrate --seed
    ```
6. **Link Storage** Create a symbolic link from ```public/storage``` to ```storage/app/public```

7. **Build Assets**
    ```bash
    npm run dev
    ```
8. **Serve the Application**
    ```bash
    php artisan serve
    ```

## Usage

### Authentication

Register a new user or log in with existing credentials. Only authenticated users can manage books and genres.

### Book Management

- **Create a Book:** Navigate to the "Create Book" page, fill out the form, and submit.
- **View Books:** Browse through the list of books on the homepage.
- **Update or Delete Books:** Edit or remove books directly from their details page.

### Genre Management

- **Assign Genres:** Add genres to books during creation or editing.
- **View Genres:** Display genres as badges with dynamic colors based on their names.

### Search and Filter

- Use the search bar to find books by title or author.
- Filter books by genres from the genres list.

## Additional Notes

- Use the .env file to configure application settings, such as the database connection and storage paths.
- Follow best practices for securing sensitive environment variables.


