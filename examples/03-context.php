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
use SeerUK\Frost\Condition\CallableCondition;

$feature = new Feature("example.context", new CallableCondition(function(array $context): bool {
    $requiredDate = new DateTimeImmutable("2015-01-01");

    return $context["created"] > $requiredDate->getTimestamp();
}));

$director = new FeatureDirector();
$director->addFeature($feature);

$users = [
    [
        "username" => "A",
        "created" => 1428842585,
    ],
    [
        "username" => "B",
        "created" => 1321639398,
    ],
];

foreach ($users as $user) {
    if ($director->isEnabled("example.context", $user)) {
        echo "Feature 'example.context' is enabled for user '{$user["username"]}'.\n";
    } else {
        echo "Feature 'example.context' is not enabled for user '{$user["username"]}'.\n";
    }
}
