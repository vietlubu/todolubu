## Todolubu
[![Build Status](https://travis-ci.org/vietlubu/todolubu.svg?branch=master)](https://travis-ci.org/vietlubu/todolubu)

### Require
- PHP >=7.1
- PHP sqlite extension

### Spec
- MVC
- Using `PHPCS` and `PHPMD` to check code convension
- Apply PHPunit to some functions

### How to run
- clone repo
- cd to root folder
- Run `composer install`
- `cd public/`
- Run `php -S 0.0.0.0:8888`
    ```
    php -S 0.0.0.0:8888
    PHP 7.1.20 Development Server started at Wed Aug 29 16:21:42 2018
    Listening on http://0.0.0.0:8888
    Document root is /Users/vietphamb./Projects/vietlubu/todolubu/public
    Press Ctrl-C to quit.
    ```
- Access http://0.0.0.0:8888 on your browser
- Using form to create or update task.
- Drag and drop to quick update date.

### Image
[![Screenshot](https://raw.githubusercontent.com/vietlubu/todolubu/master/public/img/screenshot.png)]()