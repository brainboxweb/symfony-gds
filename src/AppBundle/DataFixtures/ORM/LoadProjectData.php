<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Project;

class LoadProjectData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {


        $project = new Project();
        $project->setSlug('glasses_direct');
        $project->setCompany('Glasses Direct');
        $project->setUrl('http://www.glassesdirect.co.uk/');
        $project->setRole('PHP Developer');
        $project->setSummary('Helped migrate the product catalogue from Procedural code to MVC');

        $content = <<<EOD


Assisted with the migration of the catalogue functionality from procedural to (OO) / MVC
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2008-01-01'));
        $project->setEndDate(new \DateTime('2008-03-01'));
        $manager->persist($project);







        $project = new Project();
        $project->setCompany('Digitas');
        $project->setUrl('http://www.digitas.com/');
        $project->setRole('PHP Developer');
        $project->setSlug('google');
        $project->setSummary('Led the development of a portal website: Nakheel Communities');
        $content = <<<EOD
Led the development of a portal website: Nakheel Communities
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2008-03-01'));
        $project->setEndDate(new \DateTime('2008-06-01'));
        $manager->persist($project);






        $project = new Project();
        $project->setCompany('Google');
        $project->setUrl('http://www.google.com/');
        $project->setRole('PHP Developer / Systems Analyst');
        $project->setSlug('google');
        $project->setSummary('Assisted with the delivery of a Career Development Portal for Google HR');
        $content = <<<EOD
http://www.google.com/

Assisted with the delivery of a Career Development Portal for Google HR.

* Created functional specifications, system specifications, and working prototypes
* Liaised with third parties in Eire (business psychologists) and India (offshore developers)

EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2008-06-01'));
        $project->setEndDate(new \DateTime('2008-09-01'));
        $manager->persist($project);






        $project = new Project();
        $project->setCompany('British Gas');
        $project->setUrl('http://www.britishgas.co.uk/');
        $project->setRole('Senior PHP Developer');
        $project->setSlug('british_gas');
        $project->setSummary('Brought in to assist with the integration of a third party system with British Gas systems');
        $content = <<<EOD
Brought in to assist with the integration of a third party system with British Gas systems (Java).

Close liaison with Cambridge-based AlertMe - http://www.alertme.com/ - to determine detailed functionality
 and fit with the requirements of British Gas

EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2010-10-01'));
        $project->setEndDate(new \DateTime('2011-05-01'));
        $manager->persist($project);



        $project = new Project();
        $project->setCompany('OutsideLine');
        $project->setUrl('http://www.outsideline.co.uk/');
        $project->setRole('PHP Developer');
        $project->setSlug('outsideline');
        $project->setSummary('Development of a CodeIgniter-based website for MediaTrust');
        $content = <<<EOD
Development of http://www.mediatrust.org/, a CodeIgniter-based website.

* Created forms for the Column Idol competition (in association with The Sun newspaper)
* Extended the back-end functionality to match volunteers to charities

EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2010-06-01'));
        $project->setEndDate(new \DateTime('2011-08-01'));
        $manager->persist($project);



        $project = new Project();
        $project->setCompany('Bloomberg New Energy Finance');
        $project->setUrl('http://www.bnef.com/');
        $project->setRole('PHP Developer');
        $project->setSlug('bloomberg_new_energy_finance');
        $project->setSummary('Hired to look after legacy code (Zend Framework)');
        $content = <<<EOD
Hired to look after legacy code (Zend Framework), and to contribute to the development of a new
CodeIgniter-based platform for http://www.bnef.com/
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2009-01-01'));
        $project->setEndDate(new \DateTime('2010-03-01'));
        $manager->persist($project);






        $project = new Project();
        $project->setCompany('BBC Worldwide');
        $project->setUrl('http://www.bbc.com/');
        $project->setRole('Senior PHP Developer');
        $project->setSlug('bbc_worldwide');
        $project->setSummary('Part of the team that delivered bbc.com/Autos in just 8 weeks');
        $content = <<<EOD
Senior PHP Developer working on key BBC.com products:

* http://www.bbc.com/travel
* http://www.bbc.com/future
* http://www.bbc.com/autos
* http://www.bbc.com/culture
* http://www.bbc.com/capital

Achievements
--

* Migration of 6000+ images and metadata from legacy systems
* Part of the team that delivered http://www.bbc.com/autos in just 8 weeks

Technologies
--

* Test Driven Development (TDD) – PHPUnit
* OO PHP – Zend Framework
* HTML5
* JavaScript – jQuery
* NoSQL – Electron
* Search server – Apache Solr
* Caching – memcached, APC

Approach
--

* Weekly sprints (Agile)
* Kanban
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2012-03-01'));
        $project->setEndDate(new \DateTime('2014-02-01'));
        $manager->persist($project);






        $project = new Project();
        $project->setCompany('Sportlobster');
        $project->setUrl('http://www.sportlobster.com/');
        $project->setRole('Senior PHP Developer');
        $project->setSlug('sportlobster');
        $project->setSummary('Helped improve the speed and robustness of the Sportlobster API');
        $content = <<<EOD
Sportlobster is a sports-oriented social media website boasting 1,000,000+ users.

Achievements
--

Helped improve the speed and robustness of the Sportlobster API through:

* Behaviour Drive Development (BDD) - Behat / Test Driven Development (TTD) - PHPUnit
* Caching - memcached
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2014-02-01'));
        $project->setEndDate(new \DateTime('2014-10-01'));
        $manager->persist($project);






        $project = new Project();
        $project->setCompany('IntuDigital');
        $project->setUrl('http://www.intu.co.uk/');
        $project->setRole('Senior PHP/Symfony2 Developer');
        $project->setSlug('intu_digital');
        $project->setSummary('Added affiliate offers: importing/indexing to Elasticsearch; presenting on the website via ESIs (Edge Side Includes)');
        $content = <<<EOD
Intu operates 15+ UK shopping centres.

Achievements
--

* Added affiliate offers to the website (http://intu.co.uk/offers): consuming the feed; importing/indexing to Elasticsearch; presenting on the website via ESIs (Edge Side Includes).

Technologies:
--
* Elasticsearch, Content Repository, PrestaCMS, Memcache, Varnish, ESI
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2014-10-01'));
        $project->setEndDate(new \DateTime('2015-02-01'));
        $manager->persist($project);






        $manager->flush();
    }
}