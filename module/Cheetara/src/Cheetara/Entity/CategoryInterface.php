<?php
//Entity CategoryInterface


namespace Cheetara\Entity;

interface CategoryInterface
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
     * @return CategoryInterface
     */
    public function setId($id);

    /**
     * Get category.
     *
     * @return string
     */
    public function getCategory();

    /**
     * Set category.
     *
     * @param string $category
     * @return CategoryInterface
     */
    public function setCategory($category);
    
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
