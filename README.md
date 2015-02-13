

In October 2014, Sensio [introduced] [1] a set of [Best Practices for Symfony] [2].

This website was built as an excuse to work-through the Best Practices.


Starting point: Symfony Standard Edition
-----


Default config:

  * A bundle: AppBundle
  * Twig template engine;
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





  [1]: http://symfony.com/blog/introducing-the-official-symfony-best-practices "Introducing the Official Symfony Best Practices"
  [2]: http://symfony.com/doc/current/best_practices/index.html "Symfony Best Practices"
  [3]: http://getskeleton.com/ "Skeleton: Responsive CSS Boilerplate"



============


Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  http://symfony.com/doc/2.6/book/installation.html
[6]:  http://symfony.com/doc/2.6/bundles/SensioFrameworkExtraBundle/index.html
[7]:  http://symfony.com/doc/2.6/book/doctrine.html
[8]:  http://symfony.com/doc/2.6/book/templating.html
[9]:  http://symfony.com/doc/2.6/book/security.html
[10]: http://symfony.com/doc/2.6/cookbook/email.html
[11]: http://symfony.com/doc/2.6/cookbook/logging/monolog.html
[12]: http://symfony.com/doc/2.6/cookbook/assetic/asset_management.html
[13]: http://symfony.com/doc/2.6/bundles/SensioGeneratorBundle/index.html




