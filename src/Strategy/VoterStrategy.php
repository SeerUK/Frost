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

namespace SeerUK\Frost\Strategy;

/**
 * Voter Strategy
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class VotingStrategy implements StrategyInterface
{
    const STRATEGY_AFFIRMATIVE = 1;
    const STRATEGY_MAJORITY = 2;
    const STRATEGY_UNANIMOUS = 3;

    /**
     * @var []StrategyInterface
     */
    private $strategies;


    /**
     * VotingStrategy constructor.
     *
     * @param array $strategies
     */
    public function __construct(array $strategies = [])
    {
        $this->strategies = $strategies;
    }

    /**
     * Add a strategy
     *
     * @param StrategyInterface $strategy
     * @return VotingStrategy
     */
    public function addStrategy(StrategyInterface $strategy): VotingStrategy
    {
        $this->strategies[] = $strategy;

        return $this;
    }

    /**
     * Add several strategies
     *
     * @param []Strategyinterface $strategies
     * @return VotingStrategy
     */
    public function addStrategies(array $strategies = []): VotingStrategy
    {
        foreach ($strategies as $strategy) {
            $this->addStrategy($strategy);
        }

        return $this;
    }
}
