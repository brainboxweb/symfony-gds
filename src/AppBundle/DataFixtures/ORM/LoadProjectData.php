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
        $project->setid(1);
        $project->setTitle('Senior Symfony2 Developer - IntuDigital');
        $project->setSlug('intu_digital');
        $project->setContent('Lorem ipsum');
        $project->setPublishedAt(new \DateTime('2015-01-01'));

        $manager->persist($project);

        $project = new Project();
        $project->setid(2);
        $project->setTitle('Senior PHP Developer - Sportlobster');
        $project->setSlug('sportlobster');


        $content = <<<EOD

This is a bit of Markdown

* A bulleted list
* a second list item



EOD;



        $project->setContent($content);
        $project->setPublishedAt(new \DateTime('2014-12-01'));

        $manager->persist($project);

        $manager->flush();
    }
}