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

namespace SeerUK\Frost\Condition;

/**
 * Voting Condition
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class VotingCondition implements ConditionInterface
{
    const STRATEGY_AFFIRMATIVE = 1; // Enabled if at least one strategy resolves to true.
    const STRATEGY_CONSENSUS = 2;   // Enabled if the majority of strategires resolve to true.
    const STRATEGY_UNANIMOUS = 3;   // Enabled if all of the strategies resolve to true.

    /**
     * @var []ConditionInterface
     */
    private $conditions;

    /**
     * @var int
     */
    private $strategy;


    /**
     * VotingCondition constructor.
     *
     * @param int   $strategy
     * @param array $conditions
     */
    public function __construct(int $strategy, array $conditions)
    {
        $this->strategy = $strategy;

        $this->addConditions($conditions);
    }

    /**
     * Add a condition
     *
     * @param ConditionInterface $condition
     * @return VotingCondition
     */
    public function addCondition(ConditionInterface $condition): VotingCondition
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * Add several conditions
     *
     * @param array $conditions
     * @return VotingCondition
     */
    public function addConditions(array $conditions = []): VotingCondition
    {
        foreach ($conditions as $condition) {
            $this->addCondition($condition);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(array $context): bool
    {
        switch ($this->strategy) {
            case self::STRATEGY_AFFIRMATIVE:
                return $this->resolveAffirmative($context);
            case self::STRATEGY_CONSENSUS:
                return $this->resolveConsensus($context);
            case self::STRATEGY_UNANIMOUS:
                return $this->resolveUnanimous($context);
            default:
                throw new \InvalidArgumentException(sprintf(
                    "Invalid state, expected valid voting strategy, found '%s'.",
                    $this->strategy
                ));
        }
    }

    /**
     * Resolve this voter's conditions via the affirmative strategy.
     *
     * @param array $context
     * @return bool
     */
    private function resolveAffirmative(array $context): bool
    {
        foreach ($this->conditions as $condition) {
            /** @var ConditionInterface $condition */
            $result = $condition->resolve($context);

            if ($result === true) {
                return true;
            }
        }

        return false;
    }

    /**
     * Resolve this voter's conditions via the consensus strategy.
     *
     * @param array $context
     * @return bool
     */
    private function resolveConsensus(array $context): bool
    {
        $resolved = 0;
        $unresolved = 0;

        foreach ($this->conditions as $condition) {
            /** @var ConditionInterface $condition */
            $result = $condition->resolve($context);

            if ($result === true) {
                $resolved++;
            } else {
                $unresolved++;
            }
        }

        return $resolved > $unresolved;
    }

    /**
     * Resolve this voter's conditions via the unanimous strategy.
     *
     * @param array $context
     * @return bool
     */
    private function resolveUnanimous(array $context): bool
    {
        foreach ($this->conditions as $condition) {
            /** @var ConditionInterface $condition */
            $result = $condition->resolve($context);

            if ($result !== true) {
                return false;
            }
        }

        return true;
    }
}
