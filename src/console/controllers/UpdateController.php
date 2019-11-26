<?php
/**
 * ekomi plugin for Craft CMS 3.x
 *
 * Download ekomi data
 *
 * @link      https://github.com/plusForta/craft-ekomi
 * @copyright Copyright (c) 2019 Marc Runkel
 */

namespace plusforta\ekomi\console\controllers;

use plusforta\ekomi\Ekomi;

use Craft;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Update Command
 *
 * The first line of this class docblock is displayed as the description
 * of the Console Command in ./craft help
 *
 * Craft can be invoked via commandline console by using the `./craft` command
 * from the project root.
 *
 * Console Commands are just controllers that are invoked to handle console
 * actions. The segment routing is plugin-name/controller-name/action-name
 *
 * The actionIndex() method is what is executed if no sub-commands are supplied, e.g.:
 *
 * ./craft ekomi/update
 *
 * Actions must be in 'kebab-case' so actionDoSomething() maps to 'do-something',
 * and would be invoked via:
 *
 * ./craft ekomi/update/do-something
 *
 * @author    Marc Runkel
 * @package   Ekomi
 * @since     1.0.0
 */
class UpdateController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle ekomi/update console commands
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console UpdateController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle ekomi/update/do-something console commands
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console UpdateController actionDoSomething() method\n";

        return $result;
    }
}
