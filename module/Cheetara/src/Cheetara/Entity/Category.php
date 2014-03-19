<?php
//Entity Category
	
	
	namespace Cheetara\Entity;
	
	class Category implements CategoryInterface
	{
	    /**
	     * @var int
	     */
	    protected $id;
	
	    /**
	     * @var string
	     */
	    protected $category;
	
	    
	    public function getId()
	    {
	        return $this->id;
	    }
	
	    /**
	     * Set id.
	     *
	     * @param int $id
	     * @return CategoryInterface
	     */
	    public function setId($id)
	    {
	        $this->id = (int) $id;
	        return $this;
	    }
	
	    /**
	     * Get category.
	     *
	     * @return string
	     */
	    public function getCategory()
	    {
	        return $this->category;
	    }
	
	    /**
	     * Set category.
	     *
	     * @param string $category
	     * @return CategoryInterface
	     */
	    public function setCategory($category)
	    {
	        $this->category = $category;
	        return $this;
	    }
	    
	    /**
	     * Get parent.
	     *
	     * @return int
	     */
	    public function getParent()
	    {
	    	return $this->Parent;
	    }
	    
	    /**
	     * Set parent.
	     *
	     * @param int $parent
	     * @return CategoryInterface
	     */
	    public function setParent($parent)
	    {
	    	$this->category = $category;
	    	return $this;
	    }
	
}
