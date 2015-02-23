<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Project;
use AppBundle\Entity\Page;

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

Glasses Direct is an online retailer based in the United Kingdom that sells spectacles direct to consumers. It was
founded by James Murray Wells in 2004 joining the small existing sector of online retailers. (Wikipedia)



Assisted with the migration of the catalogue functionality from procedural code to Object Oriented / Model-View-Controller
EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2008-01-01'));
        $project->setEndDate(new \DateTime('2008-03-01'));
        $manager->persist($project);







        $project = new Project();
        $project->setCompany('Digitas');
        $project->setUrl('http://www.digitas.com/');
        $project->setRole('PHP Developer');
        $project->setSlug('digitas');
        $project->setSummary('Led the development of a portal website: Nakheel Communities');
        $content = <<<EOD

Digitas, part of Publicis Groupe, is a global digital marketing and technology agency. Digitas merged with LBi
 in February 2013 to become DigitasLBi.

Achievements
---
* Led the development of a portal website: Nakheel Communities. The project borrowed heavily from a
Content Management System that I had developed for **Brainbox** (my hosting and maintenance company).
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

Google... needs no introduction.

Assisted with the delivery of a Career Development Portal for Google Human Resources.

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
        $project->setSummary('Brought in to assist with the integration of AlertMe with British Gas systems');
        $content = <<<EOD

British Gas is an energy and home services provider in the United Kingdom. It is the trading name of British Gas
Services Limited and British Gas New Heating Limited, both subsidiaries of Centrica. (Wikipedia)

AlertMe is a UK company that provides energy and home monitoring hardware and services. AlertMe produces
hardware and software to enable users to monitor and control their home energy use. (Wikipedia)


I worked closely with Cambridge-based AlertMe - http://www.alertme.com/ - to determine detailed functionality
 and fit with the requirements of British Gas.

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

Outside Line is a full service digital agency based in London. It was acquired by Saatchi ad Saatchi in 2012.


Development of http://www.mediatrust.org/, a CodeIgniter-based website.

* Created forms for the **Column Idol** competition (in association with The Sun newspaper)
* Extended the back-end functionality to allow the matching of volunteers with charities

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

Bloomberg New Energy Finance provides  analysis, tools and data for decision makers n the energy industry.

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

BBC Worldwide Ltd. is the wholly owned commercial subsidiary of the BBC, formed out of a restructuring of its
predecessor BBC Enterprises in 1995. Wikipedia


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

* Srum and (later) Kanban
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

Technologies:
--
* Dev environment: Vagrant
* Frameworks: Silex, Symfony2
* Test: Behat for BDD, PHPUnit for TDD
* Data store: MySQL, MongoDB,
* Cache: Memcache




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
        $project->setSummary('Added Affiliate Offers to the Shopping Centre websites via Elasticsearch and ESIs');
        $content = <<<EOD

Intu Properties plc, formerly Capital Shopping Centres Group plc, is a British Real Estate Investment Trust,
largely focused on shopping centre management and development. Wikipedia


Achievements
--

* Added affiliate offers to the website (http://intu.co.uk/offers): consuming the feed; importing/indexing to Elasticsearch; presenting on the website via ESIs (Edge Side Includes).

Technologies:
--
* Dev environment: Vagrant
* Frameworks: Symfony2
* Test: Behat for BDD, phpspec for TDD
* Data stores: Elasticsearch, Content Repository,
* Cache: Memcache, Varnish, ESIs


EOD;
        $project->setContent($content);
        $project->setStartDate(new \DateTime('2014-10-01'));
        $project->setEndDate(new \DateTime('2015-02-01'));
        $manager->persist($project);





    $project = new Project();
    $project->setCompany('The Economist');
    $project->setUrl('http://www.economist.com/');
    $project->setRole('Senior PHP Developer');
    $project->setSlug('economist');
    $project->setSummary('Details to follow');
//    $content = <<<EOD
//
//Intu Properties plc, formerly Capital Shopping Centres Group plc, is a British Real Estate Investment Trust,
//largely focused on shopping centre management and development. Wikipedia
//
//
//Achievements
//--
//
//* Added affiliate offers to the website (http://intu.co.uk/offers): consuming the feed; importing/indexing to Elasticsearch; presenting on the website via ESIs (Edge Side Includes).
//
//Technologies:
//--
//* Dev environment: Vagrant
//* Frameworks: Symfony2
//* Test: Behat for BDD, phpspec for TDD
//* Data stores: Elasticsearch, Content Repository,
//* Cache: Memcache, Varnish, ESIs
//
//
//EOD;
//        $project->setContent($content);
        $project->setStartDate(new \DateTime('2015-02-01'));
//            $project->setEndDate(new \DateTime('2015-02-01'));
        $manager->persist($project);



        $page = new Page();
        $page->setSlug('approach');
        $page->setTitle('How I (like to) work');
        $body = <<<EOD

As a contractor, I don't always get to choose how I work.

Here are the things (in no particular order) that tend to make all the difference:


Vagrant Up
---

My two favourite words in the english language are “vagrant up”.

I‘m terrible at system configuration. It just doesn’t interest me. As a result, setting up a development environments
 take me an age. Not fun.

**Vagrant** takes away the pain and suffering. Thank you, [Mitchell Hashimoto] [1].


Write Tests
---

[Uncle Bob] [2] describes the way that developers become frightened of their own code: frightened to change
anything in case something breaks.

How can the developer overcome this fear and regain control? By writing tests.

For unit tests, my tool of choice is **PHPUnit**. Or **phpspec**.

For BDD, it has to be **Behat**.


Work within a Framework
---

A framework does not guarantee good quality code: I’ve seen some horrible code built on top of good frameworks.
(And beautiful code built on no framework at all.)

Used wisely, a framework can help a group of developers play nicely together.



Be Agile
---

I've been lucky enough to work with Agile experts (such as [Agile Kev] [3]). I've seen first hand how that Agile can radically the change the quality and quantity of output.

I’ve worked in **Scrum** teams. I’ve worked in **Kanban** teams. Here’s what I’ve learned:
* Scrum done well beats Kanban done badly.
* Kanban done well beats Scrum done badly.

And most importantly:
* Agile can be done in many ways. It’s up to each team to select the aspects that work for them.



[1]: http://mitchellh.com/
[2]: http://en.wikipedia.org/wiki/Robert_Cecil_Marti
[3]: http://itkanban.com/author/agilekev/



EOD;
        $page->setBody($body);
        $manager->persist($page);




        $page = new Page();
        $page->setSlug('about_this_website');
        $page->setTitle('Senior PHP/Symfony2 Developer');
        $body = file_get_contents('README.md');
        $page->setBody($body);
        $manager->persist($page);



        $page = new Page();
        $page->setSlug('contact_thanks');
        $page->setTitle('Contact');
        $page->setBody('Thank you for your message.');
        $manager->persist($page);


        $manager->flush();
    }
}