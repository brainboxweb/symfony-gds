-- MySQL dump 10.13  Distrib 5.6.21, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gds
-- ------------------------------------------------------
-- Server version	5.6.21-1~dotdeb.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Page`
--

DROP TABLE IF EXISTS `Page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Page`
--

LOCK TABLES `Page` WRITE;
/*!40000 ALTER TABLE `Page` DISABLE KEYS */;
INSERT INTO `Page` VALUES (43,'How I (like to) work','\nAs a contractor, I don\'t always get to choose how I work.\n\nHere are the things (in no particular order) that tend to make all the difference:\n\n\nVagrant Up\n---\n\nMy two favourite words in the english language are “vagrant up”.\n\nI‘m terrible at system configuration. It just doesn’t interest me. As a result, setting up a development environments\n take me an age. Not fun.\n\n**Vagrant** takes away the pain and suffering. Thank you, [Mitchell Hashimoto] [1].\n\n\nWrite Tests\n---\n\n[Uncle Bob] [2] describes the way that developers become frightened of their own code: frightened to change\nanything in case something breaks.\n\nHow can the developer overcome this fear and regain control? By writing tests.\n\nFor unit tests, my tool of choice is **PHPUnit**. Or **phpspec**.\n\nFor BDD, it has to be **Behat**.\n\n\nWork within a Framework\n---\n\nA framework does not guarantee good quality code: I’ve seen some horrible code built on top of good frameworks.\n(And beautiful code built on no framework at all.)\n\nUsed wisely, a framework can help a group of developers play nicely together.\n\n\n\nBe Agile\n---\n\nI\'ve been lucky enough to work with Agile experts (such as [Agile Kev] [3]). I\'ve seen first hand how that Agile can radically the change the quality and quantity of output.\n\nI’ve worked in **Scrum** teams. I’ve worked in **Kanban** teams. Here’s what I’ve learned:\n* Scrum done well beats Kanban done badly.\n* Kanban done well beats Scrum done badly.\n\nAnd most importantly:\n* Agile can be done in many ways. It’s up to each team to select the aspects that work for them.\n\n\n\n[1]: http://mitchellh.com/\n[2]: http://en.wikipedia.org/wiki/Robert_Cecil_Marti\n[3]: http://itkanban.com/author/agilekev/\n\n\n','approach'),(44,'Senior PHP/Symfony2 Developer','\n\nIn October 2014, Sensio [introduced] [1] a set of [Best Practices for Symfony] [2].\n\nThis website was built as an excuse to work-through the Best Practices.\n\n\nStarting point: Symfony Standard Edition\n-----\n\n\nDefault config:\n\n  * A bundle: AppBundle\n  * Twig template engine\n  * Doctrine ORM/DBAL\n  * Swiftmailer\n  * Annotations enabled for everything\n\nIncluded bundles:\n\n  * FrameworkBundle\n  * SensioFrameworkExtraBundle\n  * DoctrineBundle\n  * TwigBundle\n  * SecurityBundle\n  * SwiftmailerBundle\n  * MonologBundle\n  * AsseticBundle\n  * WebProfilerBundle\n  * SensioDistributionBundle\n  * SensioGeneratorBundle\n\n\nBundles\n---\n\nJust one bundle only: **AppBundle**\n\n\nConfiguration\n---\n\n* Infrastructure-related config options held in  **app/config/parameters.yml**\n* Application behavior-related config options held in **app/config/config.yml**\n\n\nServices\n---\n\nServices defined with **YAML**\n\n\nPersistence Layer - Doctrine\n----\n\n* `composer require \"doctrine/doctrine-fixtures-bundle\"`\n\nAnnotations used to define the mapping information of the Doctrine entities.\n\nDoctrine Fixtures:\n\n* src/AppBundle/DataFixtures/ORM/LoadProjectData.php\n\n* `php app/console doctrine:schema:update --force`\n* `php app/console doctrine:fixtures:load`\n\n\nController\n-----\n\nAnnotations to configure routing, caching and security. Eg. for routing (in DefaultController):\n\n```php\n   /**\n     * @Route(\"/\", name=\"homepage\")\n     */\n    public function indexAction()\n    {\n    ...\n    }\n```\n\n\nTemplates\n---\n\nTemplates live here (NB - *not* in the bundle):\n\n * app/Resources/views/default/index.html.twig\n\n\nAdding **Markdown** support\n\n* composer require erusev/parsedown\n\nWrapper:\n\n* src/AppBundle/Utils/Markdown.php\n\nTwig extension:\n\n* src/AppBundle/Twig/AppExtension.php\n\n\n\nFront End\n-----\n\nKeeping it simple with [Skeleton] [3]. css installed to web/ as per best practice.\n\n \nFor **prod** environment, run this:\n \n* `php app/console assetic:dump` \n\n\n\nDoctrine Migrations\n----\n\nphp composer.phar update\n\n```\n#composer.json\n{\n    \"require\": {\n        \"doctrine/migrations\": \"1.0.*@dev\",\n        \"doctrine/doctrine-migrations-bundle\": \"2.1.*@dev\"\n    }\n}\n\n```\n\n\n\n```\n// app/AppKernel.php\npublic function registerBundles()\n{\n    $bundles = array(\n        //...\n        new Doctrine\\Bundle\\MigrationsBundle\\DoctrineMigrationsBundle(),\n    );\n}\n```\n\n\n\n  [1]: http://symfony.com/blog/introducing-the-official-symfony-best-practices \"Introducing the Official Symfony Best Practices\"\n  [2]: http://symfony.com/doc/current/best_practices/index.html \"Symfony Best Practices\"\n  [3]: http://getskeleton.com/ \"Skeleton: Responsive CSS Boilerplate\"\n','about_this_website'),(45,'Contact','Thank you for your message.','contact_thanks');
/*!40000 ALTER TABLE `Page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authorEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publishedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (1,'My very own title','my_perfect_body','My perfect body','gary@garystraughan.com','2015-02-05 14:55:59');
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
INSERT INTO `Project` VALUES (147,'Glasses Direct','http://www.glassesdirect.co.uk/','glasses_direct','Helped migrate the product catalogue from Procedural code to MVC','\nGlasses Direct is an online retailer based in the United Kingdom that sells spectacles direct to consumers. It was\nfounded by James Murray Wells in 2004 joining the small existing sector of online retailers. (Wikipedia)\n\n\n\nAssisted with the migration of the catalogue functionality from procedural code to Object Oriented / Model-View-Controller','2008-01-01','2008-03-01','PHP Developer'),(148,'Digitas','http://www.digitas.com/','digitas','Led the development of a portal website: Nakheel Communities','\nDigitas, part of Publicis Groupe, is a global digital marketing and technology agency. Digitas merged with LBi\n in February 2013 to become DigitasLBi.\n\nAchievements\n---\n* Led the development of a portal website: Nakheel Communities. The project borrowed heavily from a\nContent Management System that I had developed for **Brainbox** (my hosting and maintenance company).','2008-03-01','2008-06-01','PHP Developer'),(149,'Google','http://www.google.com/','google','Assisted with the delivery of a Career Development Portal for Google HR','\nGoogle... needs no introduction.\n\nAssisted with the delivery of a Career Development Portal for Google Human Resources.\n\n* Created functional specifications, system specifications, and working prototypes\n* Liaised with third parties in Eire (business psychologists) and India (offshore developers)\n','2008-06-01','2008-09-01','PHP Developer / Systems Analyst'),(150,'British Gas','http://www.britishgas.co.uk/','british_gas','Brought in to assist with the integration of AlertMe with British Gas systems','\nBritish Gas is an energy and home services provider in the United Kingdom. It is the trading name of British Gas\nServices Limited and British Gas New Heating Limited, both subsidiaries of Centrica. (Wikipedia)\n\nAlertMe is a UK company that provides energy and home monitoring hardware and services. AlertMe produces\nhardware and software to enable users to monitor and control their home energy use. (Wikipedia)\n\n\nI worked closely with Cambridge-based AlertMe - http://www.alertme.com/ - to determine detailed functionality\n and fit with the requirements of British Gas.\n','2010-10-01','2011-05-01','Senior PHP Developer'),(151,'OutsideLine','http://www.outsideline.co.uk/','outsideline','Development of a CodeIgniter-based website for MediaTrust','\nOutside Line is a full service digital agency based in London. It was acquired by Saatchi ad Saatchi in 2012.\n\n\nDevelopment of http://www.mediatrust.org/, a CodeIgniter-based website.\n\n* Created forms for the **Column Idol** competition (in association with The Sun newspaper)\n* Extended the back-end functionality to allow the matching of volunteers with charities\n','2010-06-01','2011-08-01','PHP Developer'),(152,'Bloomberg New Energy Finance','http://www.bnef.com/','bloomberg_new_energy_finance','Hired to look after legacy code (Zend Framework)','\nBloomberg New Energy Finance provides  analysis, tools and data for decision makers n the energy industry.\n\nHired to look after legacy code (Zend Framework), and to contribute to the development of a new\nCodeIgniter-based platform for http://www.bnef.com/','2009-01-01','2010-03-01','PHP Developer'),(153,'BBC Worldwide','http://www.bbc.com/','bbc_worldwide','Part of the team that delivered bbc.com/Autos in just 8 weeks','\nBBC Worldwide Ltd. is the wholly owned commercial subsidiary of the BBC, formed out of a restructuring of its\npredecessor BBC Enterprises in 1995. Wikipedia\n\n\nSenior PHP Developer working on key BBC.com products:\n\n* http://www.bbc.com/travel\n* http://www.bbc.com/future\n* http://www.bbc.com/autos\n* http://www.bbc.com/culture\n* http://www.bbc.com/capital\n\nAchievements\n--\n\n* Migration of 6000+ images and metadata from legacy systems\n* Part of the team that delivered http://www.bbc.com/autos in just 8 weeks\n\nTechnologies\n--\n\n* Test Driven Development (TDD) – PHPUnit\n* OO PHP – Zend Framework\n* HTML5\n* JavaScript – jQuery\n* NoSQL – Electron\n* Search server – Apache Solr\n* Caching – memcached, APC\n\nApproach\n--\n\n* Srum and (later) Kanban','2012-03-01','2014-02-01','Senior PHP Developer'),(154,'Sportlobster','http://www.sportlobster.com/','sportlobster','Helped improve the speed and robustness of the Sportlobster API','Sportlobster is a sports-oriented social media website boasting 1,000,000+ users.\n\nAchievements\n--\n\nHelped improve the speed and robustness of the Sportlobster API through:\n\n* Behaviour Drive Development (BDD) - Behat / Test Driven Development (TTD) - PHPUnit\n* Caching - memcached\n\nTechnologies:\n--\n* Dev environment: Vagrant\n* Frameworks: Silex, Symfony2\n* Test: Behat for BDD, PHPUnit for TDD\n* Data store: MySQL, MongoDB,\n* Cache: Memcache\n\n\n\n','2014-02-01','2014-10-01','Senior PHP Developer'),(155,'IntuDigital','http://www.intu.co.uk/','intu_digital','Added Affiliate Offers to the Shopping Centre websites via Elasticsearch and ESIs','\nIntu Properties plc, formerly Capital Shopping Centres Group plc, is a British Real Estate Investment Trust,\nlargely focused on shopping centre management and development. Wikipedia\n\n\nAchievements\n--\n\n* Added affiliate offers to the website (http://intu.co.uk/offers): consuming the feed; importing/indexing to Elasticsearch; presenting on the website via ESIs (Edge Side Includes).\n\nTechnologies:\n--\n* Dev environment: Vagrant\n* Frameworks: Symfony2\n* Test: Behat for BDD, phpspec for TDD\n* Data stores: Elasticsearch, Content Repository,\n* Cache: Memcache, Varnish, ESIs\n\n','2014-10-01','2015-02-01','Senior PHP/Symfony2 Developer'),(156,'The Economist','http://www.economist.com/','economist','Details to follow',NULL,'2015-02-01',NULL,'Senior PHP Developer');
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  UNIQUE KEY `UNIQ_2DA17977E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'admin','$2a$10$79cTJmI3S2KTp.eJRFmBGOTBa4hadscZRoVZMrP0XcmrfV8MvCbdS','gary@garystraughan.com',1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-22 20:54:26
