<?php

namespace Symfony\Cmf\Bundle\RoutingAutoBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Cmf\Bundle\RoutingAutoBundle\Tests\Functional\App\AppKernel;
use Symfony\Cmf\Component\Testing\Functional\BaseTestCase as TestingBaseTestCase;

class BaseTestCase extends TestingBaseTestCase
{
    public function setUp(array $options = array(), $routebase = null)
    {
        $session = $this->getContainer()->get('doctrine_phpcr.session');

        if ($session->nodeExists('/test')) {
            $session->getNode('/test')->remove();
        }

        if (!$session->nodeExists('/test')) {
            $session->getRootNode()->addNode('test', 'nt:unstructured');
        }

        $session->save();
    }

    public function getApplication()
    {
        $application = new Application(self::$kernel);
        return $application;
    }

    public function getDm()
    {
        return $this->db('PHPCR')->getOm();
    }
}

