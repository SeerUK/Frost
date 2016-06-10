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
 * Callable Condition
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class CallableCondition implements ConditionInterface
{
    /**
     * @var callable
     */
    private $callable;


    /**
     * CallableCondition constructor.
     *
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(array $context): bool
    {
        return (bool) call_user_func_array($this->callable, [ $context ]);
    }
}
