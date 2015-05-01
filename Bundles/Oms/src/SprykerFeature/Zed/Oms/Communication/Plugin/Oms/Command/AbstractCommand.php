<?php

namespace SprykerFeature\Zed\Oms\Communication\Plugin\Oms\Command;

use SprykerFeature\Zed\Sales\Persistence\Propel\SpySalesOrder;

abstract class AbstractCommand
{

    /**
     * @param $message
     * @param SpySalesOrder $orderEntity
     * @param bool $isSuccess
     */
    protected function addNote($message, SpySalesOrder $orderEntity, $isSuccess = true)
    {
        $this->facadeSales->addNote($message, $orderEntity, $isSuccess, get_class($this));
    }

}