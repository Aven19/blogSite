## About Blog Website
Create a unique and beautiful blog easily, The best CMS platforms for blogging. 

### Tech Stack
1. [PHP](https://www.php.net/): PHP is a popular general-purpose scripting language that is especially suited to web development.
2. [PHP-FPM](https://www.php.net/manual/en/install.fpm.php): PHP-FPM is an efficient method on how to minimize the memory consumption and rise the performance for the websites with heavy traffic.
3. [MySQL](https://www.mysql.com/): MySQL is a relational database management system based on the Structured Query Language. MySQL is open-source and free software under the GNU license.
4. [Laravel](https://laravel.com/): Laravel is a web application framework with expressive, elegant syntax.
5. [Node.js](https://nodejs.org/en/): Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that runs on the V8 engine and executes JavaScript code outside a web browser.
6. [npm](https://www.npmjs.com/): npm is the default package manager for the JavaScript runtime environment Node.js.
7. [Git](https://git-scm.com/): Git is a free and open source distributed version control system designed to handle everything from small to very large projects with speed and efficiency.
8. [Composer](https://getcomposer.org/): Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries.
9. [Nginx](https://www.nginx.com/): Nginx is a web server that can also be used as a reverse proxy, load balancer, mail proxy and HTTP cache.
10. [Ubuntu](https://ubuntu.com/): Ubuntu is a Linux distribution based on Debian and composed mostly of free and open-source software.


### Prerequisite
1. Ubuntu 18.04 or higher.
2. Php version 8.1
3. MySql version 5.7
4. Laravel Framework 9
5. Node.js version 14.*
6. npm version 6.*
7. Git version 2.*
8. Composer version 2.*

### Production Deployment
#### Install and setup Nginx, Php, Php-Fpm
Follow below [link](https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/Nginx-PHP-FPM-config-example) to install and setup PHP 8.1 With Nginx on Ubuntu >= 18.04

#### Setup nginx server block
* To set up nginx server blocks on Ubuntu refer [here](https://linuxize.com/post/how-to-set-up-nginx-server-blocks-on-ubuntu-20-04/). 
  * Nginx sample server block file:
```
server {
    location = /favicon.ico { log_not_found off; access_log off; }
    location = /robots.txt { log_not_found off; access_log off; allow all; }
    location ~* \.(css|gif|ico|jpeg|jpg|js|png)$ {
        expires max;
        log_not_found off;
        add_header Pragma public;
        add_header Cache-Control "public, max-age=86400";
    }
    root <project_directory>;

    # Add index.php to the list if you are using PHP
    index index.php index.html index.htm index.nginx-debian.html;
    server_name <domain>;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
server {
	listen 80;
    server_name <domain>;
}
```

* To generate SSL certificate refer [here](https://www.digitalocean.com/community/tutorials/how-to-secure-nginx-with-let-s-encrypt-on-ubuntu-20-04)


#### Setup project directory
```bash
Clone the repository.
```
```bash
Navigate to project root directory.
```

#### Install NPM dependencies
* Run command
```
npm install
```
* If you do not have NPM, install it from `https://nodejs.org/en/` read further instructions on Internet.


#### Install Composer Dependencies
* Run command (make sure you have PHP version = 8.1)
```
composer install
```

* If you do not have composer installed go to `https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04` and install it.


#### Set up .env file for project
This package ships with a .env.example file in the root of the project. You must copy this file to .env
* Run Command
```
cp .env.example .env
```
#### Set up .env variables
```
APP_NAME="Blog Webite"
APP_ENV=production
APP_URL=<production_url>
APP_DEBUG=false
```

### Create Database
Make a database in mysql named `blog_site` or whatever it is named in the .env file (the default name is `laravel` if you haven't changed it.
```
mysql -u root -p
CREATE DATABASE blog_site;
```

Or you can also create it from within phpMyAdmin*

You must create your database on your server and on your .env file update the following lines:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_site
DB_USERNAME=root
DB_PASSWORD=secret
```

Change these lines to reflect your new database settings.

### Install phpMyAdmin(OPTIONAL)
For intuitive WEB interface go to `https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-20-04`


#### Artisan Commands
The first thing we are going to do is set the key that Laravel will use when doing encryption.

#### Generate Key
```
php artisan key:generate
```

You should see a green message stating your key was successfully generated. As well as you should see the APP_KEY variable in your .env file reflected.

#### Migrate
It's time to see if your database credentials are correct. We are going to run the built-in migrations to create the database tables:
```
php artisan migrate
```

You should see a message for each table migrated, if you don't and see errors, than your credentials are most likely not correct.

#### Admin Panel links

- Project URL -               : https://noob-blog-website.herokuapp.com

#### NPM run '*'
Now that you have the setup ready, you need to build the styles and scripts.

These files are generated using [Laravel Vite](https://laravel.com/docs/9.x/vite), which is a wrapper around many tools, and works off the **vite.config.js** in the root of the project.

You can build with:
```
npm run build
```

The available commands are listed at the top of the package.json file under the 'scripts' key.

You will see a lot of information flash on the screen and then be provided with a table at the end explaining what was compiled and where the files live.


At this point you are done, you should be able to hit the production url in your browser and see the website.

### Third Party Libraries Used
- **[Laravel UI](https://github.com/laravel/ui.git)** is a basic starting point using Bootstrap, React, and / or Vue that will be helpful for many applications. By default, Laravel uses NPM to install both of these frontend packages.

    ```
    php artisan clear
    php artisan view:clear
    php artisan route:clear
    php artisan cache:clear
    php artisan config:clear

### Front-end Validations
- **[jQuery Validation Plugin](https://jqueryvalidation.org/)** is a simple clientside form validation.