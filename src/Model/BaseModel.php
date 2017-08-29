<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

abstract class BaseModel
{
    /**
     * Returns the array representation of this object. Call `toArray()` on
     * properties of this class.
     *
     * @return array
     */
    public function toArray(): array
    {
        $arr = [];

        foreach ($this as $prop => $value) {
            $arr[ $prop ] = $value instanceof self ? $value->toArray() : $value;
        }

        return $arr;
    }
}
