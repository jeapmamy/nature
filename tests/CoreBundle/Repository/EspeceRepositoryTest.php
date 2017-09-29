<?php

namespace Tests\Morad\BilleterieBundle;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


//Vérifie si il l'id existe = envoi une erreur
class CoordonneesRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchEspeceById()
    {
        $espece = $this->em
            ->getRepository('CoreBundle:Espece')
            ->searchBird('5000')
        ;
        $this->assertTrue(count($espece) != 0);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; 
    }

}