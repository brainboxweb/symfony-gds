

In October 2014, Sensio [introduced] [1] a set of [Best Practices for Symfony] [2].

This website was built as an excuse to work-through the Best Practices.


Starting point: Symfony Standard Edition
-----


Default config:

  * A bundle: AppBundle
  * Twig template engine
  * Doctrine ORM/DBAL
  * Swiftmailer
  * Annotations enabled for everything

Included bundles:

  * FrameworkBundle
  * SensioFrameworkExtraBundle
  * DoctrineBundle
  * TwigBundle
  * SecurityBundle
  * SwiftmailerBundle
  * MonologBundle
  * AsseticBundle
  * WebProfilerBundle
  * SensioDistributionBundle
  * SensioGeneratorBundle


Bundles
---

Just one bundle only: **AppBundle**


Configuration
---

* Infrastructure-related config options held in  **app/config/parameters.yml**
* Application behavior-related config options held in **app/config/config.yml**


Services
---

Services defined with **YAML**


Persistence Layer - Doctrine
----

* `composer require "doctrine/doctrine-fixtures-bundle"`

Annotations used to define the mapping information of the Doctrine entities.

Doctrine Fixtures:

* src/AppBundle/DataFixtures/ORM/LoadProjectData.php

* `php app/console doctrine:schema:update --force`
* `php app/console doctrine:fixtures:load`


Controller
-----

Annotations to configure routing, caching and security. Eg. for routing (in DefaultController):

```php
   /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
    ...
    }
```


Templates
---

Templates live here (NB - *not* in the bundle):

 * app/Resources/views/default/index.html.twig


Adding **Markdown** support

* composer require erusev/parsedown

Wrapper:

* src/AppBundle/Utils/Markdown.php

Twig extension:

* src/AppBundle/Twig/AppExtension.php



Front End
-----

Keeping it simple with [Skeleton] [3]. css installed to web/ as per best practice.

 
For **prod** environment, run this:
 
* `php app/console assetic:dump` 



Doctrine Migrations
----

php composer.phar update

```
#composer.json
{
    "require": {
        "doctrine/migrations": "1.0.*@dev",
        "doctrine/doctrine-migrations-bundle": "2.1.*@dev"
    }
}

```



```
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
    );
}
```



Docker
------

```
docker-compose up
```

Fix  permissions for app/logs, app.cache

```
chown -R 1000 /var/www/gds/app/logs
chmod -R 777 /var/www/gds/app/logs
chown -R 1000 /var/www/gds/app/logs
chmod -R 777 /var/www/gds/app/logs

```

  [1]: http://symfony.com/blog/introducing-the-official-symfony-best-practices "Introducing the Official Symfony Best Practices"
  [2]: http://symfony.com/doc/current/best_practices/index.html "Symfony Best Practices"
  [3]: http://getskeleton.com/ "Skeleton: Responsive CSS Boilerplate"
