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
use SeerUK\Frost\Condition\VotingCondition;
use SeerUK\Frost\Feature;

/**
 * VotingCondition Test
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class VotingConditionTest extends TestCase
{
    public function testResolveWithAffirmativeStrategy()
    {
        $name = "test.condition.callable.resolve-affirmative-strategy";

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_AFFIRMATIVE, [
            new CallableCondition(function(): bool {
                return false;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
        ]));

        $this->assertTrue($feature->isEnabled([]));

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_AFFIRMATIVE, [
            new CallableCondition(function(): bool {
                return false;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
        ]));

        $this->assertFalse($feature->isEnabled([]));
    }

    public function testResolveWithConsensusStrategy()
    {
        $name = "test.condition.callable.resolve-consensus-strategy";

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_CONSENSUS, [
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
        ]));

        $this->assertTrue($feature->isEnabled([]));

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_CONSENSUS, [
            new CallableCondition(function(): bool {
                return false;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
        ]));

        $this->assertFalse($feature->isEnabled([]));
    }

    public function testResolveWithUnanimousStrategy()
    {
        $name = "test.condition.callable.resolve-unanimous-strategy";

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_UNANIMOUS, [
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
        ]));

        $this->assertTrue($feature->isEnabled([]));

        $feature = new Feature($name, new VotingCondition(VotingCondition::STRATEGY_UNANIMOUS, [
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return true;
            }),
            new CallableCondition(function(): bool {
                return false;
            }),
        ]));

        $this->assertFalse($feature->isEnabled([]));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testResolveThrowsOnInvalidStrategy()
    {
        $name = "test.condition.callable.resolve-throws";

        $feature = new Feature($name, new VotingCondition(0, []));
        $feature->isEnabled([]);
    }
}
