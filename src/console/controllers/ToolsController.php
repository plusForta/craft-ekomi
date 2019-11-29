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
use plusforta\ekomi\jobs\Download as DownloadJob;

/**
 * Console commands for the ekomi plugin
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
class ToolsController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Kick off an update job manually
     * @return string
     */
    public function actionUpdate()
    {
        $queue = Craft::$app->getQueue();
        $jobId = $queue->push(new DownloadJob([
            'description'   => Craft::t('ekomi', 'Manually started ekomi update job'),
        ]));

        return "Update job queued with Job ID: ${jobId}";
    }

    /**
     * Unlock a blocked update job
     * @return string
     */
    public function actionUnlock()
    {
        $queue = Craft::$app->getQueue();
        return "Job queue unlocked";
    }
}
