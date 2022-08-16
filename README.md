# laminas-mvc-skeleton Ajax-POST(CRUD)


1- Get Project 
```bash
$ git clone https://github.com/armineyvazi/Laminas_Doctrine.git 
```
___
2-Go To Data And Copy MySQl Query tabel before That creat DataBase(remember yo can see database config in config/autoload/global )
___
3-Composer Update 
```bash
$ composer i or composr update  
```
___
If Composer is not work remove composer lock and try again.
___
Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
# OR use the composer alias:
$ composer run --timeout 0 serve
```

This will start the cli-server on port 8080, and bind it to all network
interfaces. You can then visit the site at http://localhost:8080/
- which will bring up Laminas MVC Skeleton welcome page.

**Note:** The built-in CLI server is *for development only*.
___
## Development mode

The skeleton ships with [laminas-development-mode](https://github.com/laminas/laminas-development-mode)
by default, and provides three aliases for consuming the script it ships with:

```bash
$ composer development-enable  # enable development mode
$ composer development-disable # disable development mode
$ composer development-status  # whether or not development mode is enabled
```

You may provide development-only modules and bootstrap-level configuration in
`config/development.config.php.dist`, and development-only application
configuration in `config/autoload/development.local.php.dist`. Enabling
development mode will copy these files to versions removing the `.dist` suffix,
while disabling development mode will remove those copies.

Development mode is automatically enabled as part of the skeleton installation process. 
After making changes to one of the above-mentioned `.dist` configuration files you will
either need to disable then enable development mode for the changes to take effect,
or manually make matching updates to the `.dist`-less copies of those files.
___

