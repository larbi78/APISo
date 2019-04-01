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
class Produit
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $status;
    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     **/
    private $type;

}