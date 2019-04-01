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
class CommandeProduit
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumn(name="id_Commande", referencedColumnName="id")
     * @var Commande
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="id_Produit", referencedColumnName="id")
     * @var Produit
     */
    private $produit;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     **/
    private $status;

}