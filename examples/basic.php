<?php

require __DIR__ . "/../vendor/autoload.php";

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

use SeerUK\Frost\Feature;
use SeerUK\Frost\FeatureDirector;
use SeerUK\Frost\Strategy\MultivariateStrategy;

$features = [
    new Feature(new MultivariateStrategy(), "example.multivariate")
];

$director = new FeatureDirector();
$director->addFeatures($features);

var_dump($director);
