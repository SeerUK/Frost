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
use SeerUK\Frost\Feature;
use SeerUK\Frost\FeatureDirector;

/**
 * FeatureDirector Test
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class FeatureDirectorTest extends TestCase
{
    public function testIsEnabled()
    {
        $name = "text.is-enabled";

        $feature = $this->createMock(Feature::class);
        $feature->method("getName")->willReturn($name);
        $feature->method("isEnabled")->willReturn(true);

        $director = new FeatureDirector([ $feature ]);

        $this->assertTrue($director->isEnabled($name));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testIsEnabledThrowsOnUnknownFeature()
    {
        $director = new FeatureDirector([]);
        $director->isEnabled("test.is-enabled.unknown");
    }
}
