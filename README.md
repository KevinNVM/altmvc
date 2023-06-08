# AltMVC Framework Documentation

> This project is highly under development, Pull Requests and Issues will be very appreciated.

> Some of the functions may change or removed on V2, See [changelog](https://github.com/KevinNVM/altmvc/compare/v1.0.0...main) for details.

> Looking for older PHP version ? [AltMVC Legacy](https://github.com/kevinnvm/altmvc-legacy)

## Todo :

Certain things that i will be doing in the future(hopefully)

1. Implement Model from MVC(Model, View, Controller)

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

The following is the directory structure for this project:

*   .vscode/
*   public/
    *   .htaccess
    *   index.php
*   src/
    *   App/
        *   bootstrap.php
    *   Controllers/
        *   HomeController.php
    *   core/
        *   Commands/
        *   Errors/
            *   Exceptions/
                *   LayoutNotFoundException.php
                *   ViewNotFoundException.php
            *   handler.php
            *   views.php
        *   Http/
            *   Response.php
        *   Models/
        *   Response/
            *   View.php
        *   Router.php
        *   variables.php
    *   Routes/
        *   Routes.php
    *   Views/
        *   layouts/
            *   main/
                *   app.php
        *   index.php
*   .env
*   .env.example
*   alt

## Directory Description
### .vscode/
Contains settings and configurations for Visual Studio Code.
### public/
Contains files that are directly accessible to the public.
*   .htaccess: Configures Apache web server settings.
*   index.php: Entry point for the application.
### src/
Contains the main source code for the application.
#### App/
Contains files related to the application itself.
*   bootstrap.php: Initializes the application.
#### Controllers/
Contains files that handle incoming requests and return responses.
*   HomeController.php: Example controller.
#### core/
Contains files that provide the core functionality for the application.
##### Commands/
Contains files that define command line commands.
##### Errors/
Contains files that handle errors and exceptions.
*   Exceptions/: Contains custom exception classes.
*   handler.php: Error handler function.
*   views.php: Views for error pages.
##### Http/
Contains files related to HTTP requests and responses.
*   Response.php: HTTP response class.
##### Models/
Contains files related to the application's data models.
##### Response/
Contains files related to HTTP responses.
*   View.php: HTTP response view class.
##### Router.php
Class that handles routing of requests.
##### variables.php
Contains global variables used throughout the application.
#### Routes/
Contains files that define the application's routes.
*   Routes.php: Example routes file.
#### Views/
Contains files related to the application's views.
*   layouts/: Contains view layouts.
    *   main/: Example main layout.
        *   app.php: Example app view.
*   index.php: Example index view.
### .env
Environment file containing application-specific settings.
### .env.example
Example environment file.
### alt
Application's CLI

## Command Line Utilities

> CLI Commands is not fully implemented yet, for available commands please look in [cli's file](https://github.com/KevinNVM/altmvc/blob/main/alt)

The AltMVC framework provides a set of command line utilities to help developers perform common tasks such as serving the application, migrating the database, and seeding the database. These utilities can be found in the `src/commands` directory. The following is a list of available commands:

- `php alt serve`: Starts the application on the default port of 8000.
- `php alt db:migrate`: Migrates the database schema.
- `php alt db:rollback`: Clears the database.
- `php alt db:seed`: Seeds the database with sample data.

To use these commands, open a terminal or command prompt and navigate to the root directory of your AltMVC application. Then, run the desired command by typing it in the terminal or command prompt.
