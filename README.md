# A CRUD using ZF3, DataTables, Bootstrap and jQuery

## Introduction

A simple CRUD web application using Zend Framework 3 including DataTables, Bootstrap, and jQuery. This application has the following features: 

* Registers new user 
* Updates user details
* Deletes user details
* Validates data from server
* Actions are done via AJAX
* Server-side processing of DataTables
* Uses Bcrypt for password encryption

## Screenshots

Check out images inside `/data/screenshots` directory or <a href="https://github.com/unclexo/zf3-datatables-crud/tree/master/data/screenshots">click here</a>.

## Installation

Just clone the repository and run `composer` as follows:

```bash
$ cd path/to/project/dir
$ git clone git://github.com/unclexo/zf3-datatables-crud.git
$ cd server
$ php composer.phar install
```

Alternately, download the repo to some directory and run `composer` as follows:

```bash
$ cd path/to/project/dir
$ php composer.phar install
```

## Web Server Setup

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project. It should look something like below:

```apache
<VirtualHost *:80>
  DocumentRoot /path/to/zf3-datatables-crud/public
  <Directory /path/to/zf3-datatables-crud/public>
    DirectoryIndex index.php
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```
Now you should be able to see a list of users if you visit this link <a href="http://localhost/users">http://localhost/users</a>

## Database table:

Database table is shipped with this repo in the `data` directory. Otherwise, you may get the sql file from <a href="https://github.com/unclexo/server/blob/master/data/zf3-datatables-crud.sql">here</a>.

## License

**zf3-datatables-crud** is provided under the MIT license.


## Contributing

If you found a mistake or a bug, please report it using the <a href="https://github.com/unclexo/zf3-datatables-crud/issues">Issues</a> page. Your feedback is highly appreciated.