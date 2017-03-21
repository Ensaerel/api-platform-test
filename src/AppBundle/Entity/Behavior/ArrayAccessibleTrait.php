<?php

namespace AppBundle\Entity\Behavior;

/**
 * Class ArrayAccessible
 * @package AppBundle\Entity\Behavior
 */
trait ArrayAccessibleTrait
{
    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return method_exists($this, $this->getAccessor($offset));
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->{$this->getAccessor($offset)}();
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return $this
     */
    public function offsetSet($offset, $value)
    {
        $setter = $this->getAccessor($offset, 'set');

        return $this->{$setter}($value);
    }

    /**
     * @param mixed $offset
     *
     * @return $this
     */
    public function offsetUnset($offset)
    {
        $setter = $this->getAccessor($offset, 'set');

        return $this->{$setter}(null);
    }

    /**
     * @param string $property
     * @param string $type
     *
     * @return string
     */
    protected function getAccessor(string $property, string $type = 'get'): string
    {
        return $type.ucfirst($property);
    }
}
