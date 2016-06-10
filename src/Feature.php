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

use SeerUK\Frost\Condition\ConditionInterface;

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
     * @var ConditionInterface
     */
    private $condition;


    /**
     * Feature constructor.
     *
     * @param string             $name
     * @param ConditionInterface $condition
     */
    public function __construct(string $name, ConditionInterface $condition)
    {
        $this->name = $name;
        $this->condition = $condition;
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
     * @param array $context
     * @return bool
     */
    public function isEnabled(array $context): bool
    {
        return $this->condition->resolve($context);
    }
}
