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
use SeerUK\Frost\Condition\VotingCondition;

$features = [
    new Feature("example.voting.affirmative", new VotingCondition(VotingCondition::STRATEGY_AFFIRMATIVE, [
        new CallableCondition(function (): bool {
            return false;
        }),
        new CallableCondition(function (): bool {
            return true;
        }),
        new CallableCondition(function (): bool {
            return false;
        }),
    ])),
    new Feature("example.voting.consensus", new VotingCondition(VotingCondition::STRATEGY_CONSENSUS, [
        new CallableCondition(function (): bool {
            return true;
        }),
        new CallableCondition(function (): bool {
            return true;
        }),
        new CallableCondition(function (): bool {
            return false;
        }),
    ])),
    new Feature("example.voting.unanimous", new VotingCondition(VotingCondition::STRATEGY_UNANIMOUS, [
        new CallableCondition(function (): bool {
            return true;
        }),
        new CallableCondition(function (): bool {
            return true;
        }),
        new CallableCondition(function (): bool {
            return true;
        }),
    ])),
];

$director = new FeatureDirector();
$director->addFeatures($features);

foreach ($features as $feature) {
    /** @var Feature $feature */
    if ($director->isEnabled($feature->getName())) {
        echo "Feature '{$feature->getName()}' is enabled!\n";
    } else {
        echo "Feature '{$feature->getName()}' is not enabled. Something went wrong!\n";
    }
}

