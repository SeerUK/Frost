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
 * ConditionInterface
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
interface ConditionInterface
{
    /**
     * Provides the result of a condition. Used by the director to decide whether or not a feature
     * is enabled.
     *
     * @param array $context
     * @return bool
     */
    public function resolve(array $context): bool;
}
