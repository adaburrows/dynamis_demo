INSTALLATION
============

Requirements
------------
Make sure that PHP is recent. Currently PHP 5.2.x runs this, but there are no
plans on keeping it compatible. Install the bleeding edge PHP from source for
full compatibility. ;-)

Basic Setup
-----------
Clone the skeleton app from the repository:

```
git clone git://github.com/adaburrows/dynamis_skeleton.git
cd dynamis_skeleton
git submodule update --init
cp app/config.php.template app/config.php
cp web_root/index.php.template web_root/index.php
```

Dynamis is a submodule in the ```dynamis_skeleleton/dynamis``` directory. When a
new version of dynamis becomes available I will push an updated submodule ref.

The schema file for the database is ```app/models/schema/schema.sql```. Create a
database for it, then import the schema.

Open ```app/config.php``` and make changes as nescessary (i.e. set up the DB,
set up application specific config variables, change the main template, change
the default model, etc.). It's documented to make it easy.

Open ```web_root/index.php``` and change the paths to be absolute paths to where
the file directories actually are. This is an issue that needs to be fixed (the
issue happens to be inside ```index.php```, let me know what it is is you know
what it is!).

Setup a webserver to serve up the ```dynamis_skeleton/web_root``` directory. To
use Apache httpd, copy ```.htaccess.template``` to ```.htaccess```. Make sure
Apache loads the ```.htaccess``` file and uses the mod_rewrite rules specified.
Otherwise, the framework will not run. If this becomes a problem, complain to
me and I'll think about fixing it.

To use nginx, see my nginx config project (put it in another directory):

```
git clone git://github.com/adaburrows/nginx_configs.git
```

It will help simplify the structure of nginx configs.

After it's been set up, go to it's URL and admire it for a bit. Then visit a
special URL (this function should be removed from the app after creating the
user) at http://your_url_here/users/add_default and it will create a user
which has admin rights. To set up new users and change usernames and
passwords visit /users/index.

```php
$email = 'user@example.com';
$password = 'bl4h';
```

WRITING APPS
============

I've included a full blown app with blog, page, and user models. Sure I hate
how the user model is implemented, but it works for now. Check it out and you
be well on your way to writing apps.

But Really...
-------------

I'm going to write docs for this another day, check back later.
