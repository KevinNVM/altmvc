# AltMVC Framework Documentation

AltMVC is a simple PHP framework that follows the Model-View-Controller (MVC) pattern. This framework allows developers to easily create web applications by providing a set of core features such as routing, database integration, and command line utilities. This document provides a brief overview of the AltMVC framework and how to use it.

## Getting Started

To use AltMVC, you will need to have PHP installed on your machine. Once you have PHP installed, you can download the AltMVC framework and extract it to a directory on your local machine.

## Overview

The core of the AltMVC framework is divided into three parts:

- Model: This is where the data manipulation and business logic resides.
- View: This is where the presentation layer resides.
- Controller: This is the glue that binds the Model and View together and handles user requests.

In addition, AltMVC also provides a set of utilities that help developers manage the database and perform common tasks from the command line.

## Directory Structure

The following is the directory structure of AltMVC:

*   public/ : This folder contains all the files that are publicly accessible to the user via the webserver.
    *   .htaccess: This file is used to configure Apache web server settings for the application.
    *   index.php: This file is the entry point for the application and is responsible for handling all incoming HTTP requests.
*   src/ : This folder contains all the source code files for the application.
    *   commands/: This folder contains PHP files that define CLI commands for the application.
        *   db.php: This file contains the database-related CLI commands for the application.
    *   controllers/: This folder contains PHP files that define controllers for the application.
        *   controller.php: This file contains the base controller class for the application.
        *   home.php: This file contains the controller for the home page.
    *   core/: This folder contains core PHP files for the application.
        *   autoload.php: This file is responsible for automatically loading PHP classes as they are needed.
        *   env.php: This file is responsible for setting up the environment variables for the application.
        *   functions.php: This file contains various utility functions that are used throughout the application.
        *   variables.php: This file contains various global variables that are used throughout the application.
    *   database/: This folder contains PHP files that define the database-related functionality for the application.
        *   conn.php: This file contains the database connection details for the application.
        *   db.php: This file contains functions for executing SQL queries and interacting with the database.
    *   errors/: This folder contains PHP files that define custom error pages for the application.
    *   views/: This folder contains PHP files that define the HTML templates for the application.
        *   partials/: This folder contains reusable template components that are included in other views.
            *   footer.php: This file contains the HTML code for the footer.
            *   header.php: This file contains the HTML code for the header.
            *   navbar.php: This file contains the HTML code for the navigation bar.
        *   about.php: This file contains the HTML code for the about page.
        *   home.php: This file contains the HTML code for the home page.
    *   routes.php: This file defines the URL routes for the application.
*   vendor/: This folder contains the third-party libraries and dependencies that the application relies on.
*   .gitignore: This file specifies the files and folders that should be ignored by Git version control.
*   alt: This file is the CLI entry point for the application and is responsible for handling all incoming CLI requests.
*   composer.json: This file contains the project dependencies and metadata for the application.
*   readme.md: This file contains the documentation for the application.

## Command Line Utilities

The AltMVC framework provides a set of command line utilities to help developers perform common tasks such as serving the application, migrating the database, and seeding the database. These utilities can be found in the `src/commands` directory. The following is a list of available commands:

- `php alt serve`: Starts the application on the default port of 8000.
- `php alt db:migrate`: Migrates the database schema.
- `php alt db:rollback`: Clears the database.
- `php alt db:seed`: Seeds the database with sample data.

To use these commands, open a terminal or command prompt and navigate to the root directory of your AltMVC application. Then, run the desired command by typing it in the terminal or command prompt.
