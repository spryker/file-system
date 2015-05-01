<?php

namespace SprykerFeature\Zed\Oms\Communication\Console;

use SprykerFeature\Zed\Console\Business\Model\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckTimeoutConsole extends Console
{

    const COMMAND_NAME = 'oms:check-timeout';
    const COMMAND_DESCRIPTION = 'Check timeouts';

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::COMMAND_DESCRIPTION);

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->locator->oms()->facade()->checkTimeouts([]);
    }

}