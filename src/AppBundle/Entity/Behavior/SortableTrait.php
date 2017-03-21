<?php

namespace AppBundle\Entity\Behavior;

use Doctrine\ORM\Mapping as ORM;

trait SortableTrait
{
    /**
     * @ORM\Column(type="integer", options={"default":1})
     *
     * @var bool
     */
    protected $position = 1;

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;

        return $this;
    }
}
