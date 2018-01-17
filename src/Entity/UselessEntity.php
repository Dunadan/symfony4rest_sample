<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="useless_entities")
 * @ORM\Entity(repositoryClass="App\Repository\UselessRepository")
 */
class UselessEntity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Your MEH must be at least {{ limit }} characters long",
     *      maxMessage = "Your MEH cannot be longer than {{ limit }} characters"
     * )
     */
    protected  $meh;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Your WHATEVER must be at least {{ limit }} characters long",
     *      maxMessage = "Your WHATEVER cannot be longer than {{ limit }} characters"
     * )
     */
    protected  $whatever;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) : void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMeh()
    {
        return $this->meh;
    }

    /**
     * @param string $meh
     */
    public function setMeh($meh): void
    {
        $this->meh = $meh;
    }

    /**
     * @return string
     */
    public function getWhatever()
    {
        return $this->whatever;
    }

    /**
     * @param string $whatever
     */
    public function setWhatever($whatever): void
    {
        $this->whatever = $whatever;
    }



}