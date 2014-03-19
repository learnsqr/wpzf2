	<?php
	//Entity Tag
	namespace Cheetara\Entity;
	
	class Tag implements TagInterface
	{
	    /**
	     * @var int
	     */
	    protected $id;
	
	    /**
	     * @var string
	     */
	    protected $tag;
	
	    
	    public function getId()
	    {
	        return $this->id;
	    }
	
	    /**
	     * Set id.
	     *
	     * @param int $id
	     * @return TagsInterface
	     */
	    public function setId($id)
	    {
	        $this->id = (int) $id;
	        return $this;
	    }
	
	    /**
	     * Get tag.
	     *
	     * @return string
	     */
	    public function getTag()
	    {
	        return $this->tag;
	    }
	
	    /**
	     * Set tag.
	     *
	     * @param string $tag
	     * @return TagInterface
	     */
	    public function setTag($tag)
	    {
	        $this->tag = $tag;
	        return $this;
	    }
	
}
