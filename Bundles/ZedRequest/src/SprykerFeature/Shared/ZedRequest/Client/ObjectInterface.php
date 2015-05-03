<?php

namespace SprykerFeature\Shared\ZedRequest\Client;

interface ObjectInterface
{
    /**
     * @param array $values
     */
    public function fromArray(array $values);

    /**
     * @return array
     */
    public function toArray();
}