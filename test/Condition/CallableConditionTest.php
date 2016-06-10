<?php

/**
 * This file is part of the frost package.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the LICENSE is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Frost\Test\Condition;

use PHPUnit\Framework\TestCase;
use SeerUK\Frost\Condition\CallableCondition;
use SeerUK\Frost\Feature;

/**
 * CallableCondition Test
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class CallableConditionTest extends TestCase
{
    public function testResolveRespondsToCallable()
    {
        $name = "test.condition.callable.resolve-responds";

        $feature = new Feature($name, new CallableCondition(function(): bool {
            return true;
        }));

        $this->assertTrue($feature->isEnabled([]));

        $feature = new Feature($name, new CallableCondition(function(): bool {
            return false;
        }));

        $this->assertFalse($feature->isEnabled([]));
    }

    public function testResolveIsPassedContext()
    {
        $name = "test.condition.callable.resolve-context";

        $feature = new Feature($name, new CallableCondition(function(array $context): bool {
            return $context["resolve"];
        }));

        $this->assertTrue($feature->isEnabled([ "resolve" => true ]));
        $this->assertFalse($feature->isEnabled([ "resolve" => false ]));
    }
}
