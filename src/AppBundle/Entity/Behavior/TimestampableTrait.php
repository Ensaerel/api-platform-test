<?php

namespace AppBundle\Entity\Behavior;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampableTrait
{
    /**
     * @Groups({"read"})
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var /DateTime
     */
    protected $createdAt;

    /**
     * @Groups({"read"})
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(type="datetime", name="updated_at")
     *
     * @var /DateTime
     */
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
