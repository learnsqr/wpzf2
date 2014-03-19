<?php
//Entity CheatInterface
namespace Cheetara\Entity;

interface CheatInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     * @return CheatInterface
     */
    public function setId($id);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return CheatInterface
     */
    public function setName($name);

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode();

    /**
     * Set code.
     *
     * @param string $code
     * @return CheatInterface
     */
    public function setCode($code);

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set description.
     *
     * @param string $description
     * @return CheatInterface
     */
    public function setDescription($description);

    /**
     * Get filename.
     *
     * @return string filename
     */
    public function getFilename();

    /**
     * Set filename.
     *
     * @param string $filename
     * @return CheatInterface
     */
    public function setFilename($filename);

    /**
     * Get parent.
     *
     * @return int
     */
    public function getParent();
    
    /**
     * Set parent.
     *
     * @param int $parent
     * @return CategoryInterface
    */
    public function setParent($parent);

}
