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

/**
 * FeatureDirector
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class FeatureDirector
{
    /**
     * @var []Feature
     */
    private $features;


    /**
     * FeatureDirector constructor.
     *
     * @param []Feature $features
     */
    public function __construct(array $features = [])
    {
        $this->addFeatures($features);
    }

    /**
     * Is this feature enabled?
     *
     * @param string $name
     * @param array  $context
     * @return bool
     */
    public function isEnabled(string $name, array $context = []): bool
    {
        $feature = $this->features[$name];

        if (!$feature instanceof Feature) {
            throw new \RuntimeException(sprintf(
                "Attempted to resolve feature '%s', but it was not an instance of Feature.",
                $name
            ));
        }

        return $feature->isEnabled($context);
    }

    /**
     * Add a feature
     *
     * @param Feature $feature
     * @return FeatureDirector
     */
    public function addFeature(Feature $feature): FeatureDirector
    {
        $this->features[$feature->getName()] = $feature;

        return $this;
    }

    /**
     * Add several features
     *
     * @param []Feature $features
     * @return FeatureDirector
     */
    public function addFeatures(array $features): FeatureDirector
    {
        foreach ($features as $feature) {
            $this->addFeature($feature);
        }

        return $this;
    }
}
