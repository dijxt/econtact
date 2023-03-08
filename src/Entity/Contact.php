<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    public $id_nom;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    public $id_contact;
}