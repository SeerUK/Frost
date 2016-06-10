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

namespace SeerUK\Frost\Test;

use PHPUnit\Framework\TestCase;
use SeerUK\Frost\Condition\CallableCondition;
use SeerUK\Frost\Condition\ConditionInterface;
use SeerUK\Frost\Feature;

/**
 * Feature Test
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class FeatureTest extends TestCase
{
    public function testGetName()
    {
        $name = "test.get-name";

        $condition = $this->createMock(ConditionInterface::class);
        $feature = new Feature($name, $condition);

        $this->assertEquals($name, $feature->getName());
    }

    public function testIsEnabledRespondsToCondition()
    {
        $condition = $this->createMock(ConditionInterface::class);
        $condition->method("resolve")->willReturn(true);

        $feature = new Feature("test.is-enabled.true", $condition);

        $this->assertTrue($feature->isEnabled([]));

        $condition = $this->createMock(ConditionInterface::class);
        $condition->method("resolve")->willReturn(false);

        $feature = new Feature("test.is-enabled.false", $condition);

        $this->assertFalse($feature->isEnabled([]));
    }

    public function testIsEnabledPassesContext()
    {
        $condition = new CallableCondition(function(array $context): bool {
            return $context["resolve"];
        });

        $feature = new Feature("test.is-enabled.context", $condition);

        $this->assertTrue($feature->isEnabled([ "resolve" => true ]));
        $this->assertFalse($feature->isEnabled([ "resolve" => false ]));
    }
}
