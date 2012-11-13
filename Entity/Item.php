<?php

namespace DW\SlideShowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DW\SlideShowBundle\Entity\Item
 *
 * @ORM\Table(name="dw_item")
 * @ORM\Entity(repositoryClass="DW\SlideShowBundle\Entity\ItemRepository")
 */
class Item
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $ref
     *
     * @ORM\Column(name="ref", type="string", length=255)
     */
    private $ref;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $definition_short
     *
     * @ORM\Column(name="definition_short", type="string", length=500)
     */
    private $definition_short;

    /**
     * @var string $definition
     *
     * @ORM\Column(name="definition", type="string", length=2000)
     */
    private $definition;

    


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ref
     *
     * @param string $ref
     * @return Item
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    
        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set definition_short
     *
     * @param string $definitionShort
     * @return Item
     */
    public function setDefinitionShort($definitionShort)
    {
        $this->definition_short = $definitionShort;
    
        return $this;
    }

    /**
     * Get definition_short
     *
     * @return string 
     */
    public function getDefinitionShort()
    {
        return $this->definition_short;
    }

    /**
     * Set definition
     *
     * @param string $definition
     * @return Item
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    
        return $this;
    }

    /**
     * Get definition
     *
     * @return string 
     */
    public function getDefinition()
    {
        return $this->definition;
    }
    
    public function __toString() {
        return $this->ref;
    }

}
