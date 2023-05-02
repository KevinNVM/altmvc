# AltMVC Framework Documentation

> Some of the functions may change or removed on V2, See changelogs for details.

AltMVC is a simple PHP framework that follows the Model-View-Controller (MVC) pattern. This framework allows developers to easily create web applications by providing a set of core features such as routing, database integration, and command line utilities. This document provides a brief overview of the AltMVC framework and how to use it.

## Getting Started

To use AltMVC, you will need to have PHP installed on your machine. Once you have PHP installed, you can download the AltMVC framework and extract it to a directory on your local machine.

```bash
git clone https://github.com/KevinNVM/altmvc.git altmvc-project
cd altmvc-project
php alt serve
```

## Overview

The core of the AltMVC framework is divided into three parts:

- Model: This is where the data manipulation and business logic resides.
- View: This is where the presentation layer resides.
- Controller: This is the glue that binds the Model and View together and handles user requests.

In addition, AltMVC also provides a set of utilities that help developers manage the database and perform common tasks from the command line.

## Directory Structure

The following is the directory structure of AltMVC:

*   `public/` : This folder contains all the files that are publicly accessible to the user via the webserver.
    *   `.htaccess`: This file is used to configure Apache web server settings for the application.
    *   `index.php`: This file is the entry point for the application and is responsible for handling all incoming HTTP requests.
*   `src/` : This folder contains all the source code files for the application.
    *   `commands/`: This folder contains PHP files that define CLI commands for the application.
    *   `controllers/`: This folder contains PHP files that define controllers for the application.
    *   `core/`: This folder contains core PHP files for the application.
    *   `database/`: This folder contains PHP files that define the database-related functionality for the application.
    *   `errors/`: This folder contains PHP files that define custom error pages for the application.
    *   `views/`: This folder contains PHP files that define the HTML templates for the application.
    *   `routes.php`: This file defines the URL routes for the application.
*   `alt`: This file is the CLI entry point for the application and is responsible for handling all incoming CLI requests.

## Command Line Utilities

The AltMVC framework provides a set of command line utilities to help developers perform common tasks such as serving the application, migrating the database, and seeding the database. These utilities can be found in the `src/commands` directory. The following is a list of available commands:

- `php alt serve`: Starts the application on the default port of 8000.
- `php alt db:migrate`: Migrates the database schema.
- `php alt db:rollback`: Clears the database.
- `php alt db:seed`: Seeds the database with sample data.

To use these commands, open a terminal or command prompt and navigate to the root directory of your AltMVC application. Then, run the desired command by typing it in the terminal or command prompt.