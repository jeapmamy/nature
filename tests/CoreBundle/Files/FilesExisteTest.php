<?php

use PHPUnit\Framework\TestCase;

class FileExistsTest extends TestCase
{
    public function testFileIndex()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\index.html.twig');
    }

    public function testFileObservation()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\observation.html.twig');
    }

    public function testFileListe()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\liste.html.twig');
    }

    public function testFileSaisie()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\saisie.html.twig');
    }

    public function testFileRecherche()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\recherche.html.twig');
    }

    public function testFileAasociation()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\association.html.twig');
    }

    public function testFileContact()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\contact.html.twig');
    }
    
    public function testFileMentions_legales()
    {
        $this->assertFileExists(dirname(__FILE__).'\\..\\..\\..\\src\\CoreBundle\\Resources\\views\\Front\\mentions_legales.html.twig');
    }
    
}