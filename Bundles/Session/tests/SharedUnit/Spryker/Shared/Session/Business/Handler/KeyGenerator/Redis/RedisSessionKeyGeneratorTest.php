<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SharedUnit\Spryker\Shared\Session\Business\Handler\KeyGenerator\Redis;

use Codeception\TestCase\Test;
use Spryker\Shared\Session\Business\Handler\KeyGenerator\Redis\RedisSessionKeyGenerator;

/**
 * @group SharedUnit
 * @group Spryker
 * @group Shared
 * @group Session
 * @group Business
 * @group Handler
 * @group KeyGenerator
 * @group Redis
 * @group RedisSessionKeyGeneratorTest
 */
class RedisSessionKeyGeneratorTest extends Test
{

    /**
     * @return void
     */
    public function testGenerateAddsPrefix()
    {
        $generator = new RedisSessionKeyGenerator();
        $generatedKey = $generator->generateSessionKey('foo-session-123');

        $this->assertSame('session:foo-session-123', $generatedKey);
    }

}
