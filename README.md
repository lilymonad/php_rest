# How to run

## Linux

Install PHP on your machine using your package manager and run:
```bash
php -S localhost:8080 router.php
```

## Windows

- Install PHP using either [PHP For Windows: Binaries and sources Releases](https://windows.php.net/download/)
or [WampServer](https://www.wampserver.com/).
- [Configure your PATH](https://www.architectryan.com/2018/03/17/add-to-the-path-on-windows-10/) to add `php.exe`'s folder
- run `php.exe -S localhost:8080 router.php` inside the repository's root.

# Architecture

The architecture revolves arount one file: `router.php`. [The manual](https://www.php.net/manual/en/features.commandline.webserver.php) tells us that:
> If a PHP file is given on the command line when the web server is started it is treated as a "router" script.

A "router" script is a `php` script file which is ran at **every HTTP request**
regardless of the request's URI. We can use this script to parse the URI
ourselves and send appropriate data.

If the router script executes this instruction:
```php
return false;
```
then it stops executing and the server will treat the request's URI as a regular
file path and reply with the file's content, or error 404 if the file does not
exist.

We can use this behavior to split URI into 2 classes:
- REST API paths (like `/api/cars/10/driver`, or `/api/users/42/videos/56`...)
- File paths (like `style.css`, `index.html`, `super_logo.png`...)

With only this little code:
```php
<?php
if (preg_match('/^/api(\/.*)?/', $_SERVER['REQUEST_URI'])) {
  // here we handle the /api/.... routes
} else {
  // all routes which do not begin with /api are treated as files
  return false;
}
```

# Parsing an API URI

REST URIs are often very simple and consist on a sequence of `nouns` followed by `id`.
We then can split our URI by `/` and `switch` on each crumb:
```php
// '/api/test' becomes [ '', 'api', 'test' ]
$path = explode('/', $_SERVER['REQUEST_URI']);

// since 0 and 1 are '' and 'api', we start the "real path" at 2
switch ($path[2]) {
  case 'ping':
    echo 'pong';
    break;
  default:
    // default case on $path[X] should always raise a 404 error
    // as it represents an unhandled path
    http_response_code('404');
}
```

# Good practices

- In order to parse a longer URI, you should split your project into multiple
files which mimic the data hierarchy whenever possible.
- Try to use [these guidelines](https://restfulapi.net/resource-naming/) for your routes names and other features.
  * plural for collections
  * singular for resources
  * for accessing 1 item of a collection (like a specific "user"), use the collection route followed by the item's ID:
  `/users/{id}` (always use plural for collections, even when accessing items).
