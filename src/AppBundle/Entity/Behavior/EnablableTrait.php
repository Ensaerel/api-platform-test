<?php

namespace AppBundle\Entity\Behavior;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait EnablableTrait
{
    /**
     * @var bool
     *
     * @Groups({"read"})
     *
     * @ORM\Column(type="boolean")
     */
    protected $enabled = false;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
