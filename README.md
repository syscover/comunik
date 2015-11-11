# Comunik App to Laravel 5

## Installation

**1 - After install Laravel framework, insert on file composer.json, inside require object this value**
```
"syscover/comunik": "dev-master"

```
and execute on console:
```
composer update
```

**2 - Register service provider, on file config/app.php add to providers array**

```
Syscover\Comunik\ComunikServiceProvider::class,

```

**3 - To publish package and migrate**

and execute composer update again:
```
composer update
```

**4 - Run seed database**

```
php artisan db:seed --class="ComunikTableSeeder"
```

**4 - Activate package**

Access to Pulsar Panel, and go to Administration -> Permissions -> Profiles, and set all permissions to your profile by clicking on the open lock.
Logout and loging again, to load new permissions and go to Administration -> Packages, edit the package installed and activate it