<?php
//Entity Cheat

namespace Cheetara\Entity;

class Cheat implements CheatInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var int
     */
    protected $parent;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     * @return CheatInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code.
     *
     * @param string $code
     * @return CheatInterface
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     * @return CheatInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename.
     *
     * @param string $filename
     * @return CheatInterface
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Get parent.
     *
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent.
     *
     * @param int $parent
     * @return CheatInterface
     */
    public function setState($parent)
    {
        $this->parent = $parent;
        return $this;
    }
}
