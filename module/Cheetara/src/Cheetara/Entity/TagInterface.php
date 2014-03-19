<?php
//Entity TagInterface
namespace Cheetara\Entity;

interface TagInterface
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
     * @return UserInterface
     */
    public function setId($id);

    /**
     * Get tag.
     *
     * @return string
     */
    public function getTag();

    /**
     * Set tag.
     *
     * @param string $tag
     * @return UserInterface
     */
    public function setTag($tag);
}
