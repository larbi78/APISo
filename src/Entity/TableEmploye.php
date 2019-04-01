<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 19:13
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TableEmploye
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Employe")
     * @ORM\JoinColumn(name="id_Employe", referencedColumnName="id")
     * @var Commande
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="TableClient")
     * @ORM\JoinColumn(name="id_Table_Client", referencedColumnName="id")
     * @var TableClient
     */
    private $produit;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

}