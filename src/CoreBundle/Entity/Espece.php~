<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Espece
 *
 * @ORM\Table(name="espece")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\EspeceRepository")
 */
class Espece
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="PHYLUM", type="string", length=8, nullable=true)
     */
    private $phylum;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASSE", type="string", length=4, nullable=true)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="string", length=19, nullable=true)
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="FAMILLE", type="string", length=17, nullable=true)
     */
    private $famille;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_NOM", type="integer", nullable=true)
     */
    private $cdNom;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_NOM", type="string", length=47, nullable=true)
     */
    private $lbNom;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_AUTEUR", type="string", length=73, nullable=true)
     */
    private $lbAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN", type="string", length=101, nullable=true)
     */
    private $nomVern;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN_ENG", type="string", length=122, nullable=true)
     */
    private $nomVernEng;

    /**
     * @var string
     *
     * @ORM\Column(name="HABITAT", type="string", length=1, nullable=true)
     */
    private $habitat;

    /**
     * @var string
     *
     * @ORM\Column(name="FR", type="string", length=1, nullable=true)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=42, nullable=true)
     */
    private $url;
	
}
