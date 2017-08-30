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
    public function toArray(bool $removeEmptyValues = false): array
    {
        $arr = [];

        foreach ($this as $prop => $value) {
            if (! $removeEmptyValues || ! empty($value)) {
                $arr[ $prop ] = $value instanceof self ? $value->toArray($removeEmptyValues) : $value;
            }
        }

        return $arr;
    }
}
