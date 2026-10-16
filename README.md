# ClientFlow CRM

**ClientFlow CRM** is a web-based Customer Relationship Management (CRM) application built with PHP and CodeIgniter 4. It provides a centralized workspace for managing customer information, monitoring activities, and organizing events.

## Features

- **Dashboard:** View an overview of CRM information.
- **Customer Management:** Create, view, update, and delete customer records.
- **Authentication:** Login, registration, and logout functionality.
- **Activity Feed:** View activity-related information in a dedicated workspace.
- **Calendar:** Create and view scheduled events with dates, times, and descriptions.
- **Database Integration:** Store and retrieve application data using a relational database.
- **Responsive Interface:** Navigate the CRM through a structured application layout.

## Tech Stack

- **Backend:** PHP, CodeIgniter 4
- **Frontend:** HTML, CSS, JavaScript
- **Database:** MariaDB / MySQL
- **Development Tools:** Composer, Git, GitHub, XAMPP

## Project Structure

```text
ClientFlow/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── public/
│   └── assets/
│       ├── css/
│       └── js/
├── tests/
├── writable/
├── vendor/
├── .gitignore
├── composer.json
└── README.md
```

## Requirements

Before running the project, make sure you have:

- PHP 8.2 or a compatible version supported by your installed CodeIgniter release
- Composer
- MySQL or MariaDB
- Required PHP extensions, including `intl` and `mbstring`
- Git (optional, for version control)

## Installation and Setup

### 1. Clone the repository

```bash
git clone https://github.com/priyankabhrdwaj123-lang/ClientFlow-CRM.git
```

### 2. Open the project folder

```bash
cd ClientFlow-CRM
```

### 3. Install dependencies

```bash
composer install
```

### 4. Configure environment settings

Copy the `env` file to `.env` in the project root.

On Windows Command Prompt:

```cmd
copy env .env
```

Open `.env` and configure the application URL and database connection settings according to your local environment.

Example settings:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_database_username
database.default.password = your_database_password
database.default.DBDriver = MySQLi
database.default.port = 3307
```

**Important:** Replace the database name, username, and password with your own configuration. The port above is an example for environments using MariaDB on port `3307`; use the port configured on your computer.

### 5. Create and configure the database

1. Start your database service.
2. Create a database for ClientFlow CRM.
3. Configure the database connection in `.env`.
4. Create or import the database tables required by the application.

Ensure that the required tables and columns match the models and controllers in the project.

### 6. Run the application

From the project root, execute:

```bash
php spark serve
```

Open the application in your browser:

**http://localhost:8080**

## Security Notes

- Do not commit `.env` or other files containing passwords, API keys, or private credentials.
- Use strong credentials for database access.
- Configure the production web server to serve the application through the `public/` directory.
- Do not use development settings or the development server for production hosting.

## Version Control

This project uses Git for version control and GitHub for repository hosting.

To save future changes:

```bash
git add .
git commit -m "Describe your changes"
git push
```

## Project Status

ClientFlow CRM is an ongoing project. Features and improvements may be added as development continues.

## Author

**Priyanka Bhardwaj**

GitHub: [priyankabhrdwaj123-lang](https://github.com/priyankabhrdwaj123-lang)

Repository: [ClientFlow CRM](https://github.com/priyankabhrdwaj123-lang/ClientFlow-CRM)
