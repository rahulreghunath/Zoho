# Zoho
A simple PHP API extension for Zoho CRM for Laravel

Require this package in your composer.json and update composer. This will download the package.

    composer require rahulreghunath/zoho

## Installation

### Laravel

After updating composer, add the ServiceProvider to the providers array in config/app.php

    Rahulreghunath\Zoho\ServiceProvider::class,
    
After adding ServiceProvider run command 
        
        php artisan vendor:publish
        
After that set your Zoho CRM authentication key inside zoho.php file inside config folder and you are goo to go
