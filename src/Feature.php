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

namespace SeerUK\Frost;

use SeerUK\Frost\Strategy\StrategyInterface;

/**
 * Feature
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class Feature
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var StrategyInterface
     */
    private $strategy;


    /**
     * Feature constructor.
     *
     * @param StrategyInterface $strategy
     * @param string            $name
     */
    public function __construct(StrategyInterface $strategy, string $name)
    {
        $this->name = $name;
        $this->strategy = $strategy;
    }

    /**
     * Get the name of this feature.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Is this feature enabled?
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        // @todo
        return false;
    }
}
