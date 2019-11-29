<?php
/**
 * ekomi plugin for Craft CMS 3.x
 *
 * Download ekomi data
 *
 * @link      https://github.com/plusForta/craft-ekomi
 * @copyright Copyright (c) 2019 Marc Runkel
 */

namespace plusforta\ekomi\jobs;

use craft\feeds\GuzzleClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use plusforta\ekomi\Ekomi;

use Craft;
use craft\queue\BaseJob;

/**
 * Download job
 *
 * Jobs are run in separate process via a Queue of pending jobs. This allows
 * you to spin lengthy processing off into a separate PHP process that does not
 * block the main process.
 *
 * You can use it like this:
 *
 * use plusforta\ekomi\jobs\Download as DownloadJob;
 *
 * $queue = Craft::$app->getQueue();
 * $jobId = $queue->push(new DownloadJob([
 *     'description' => Craft::t('ekomi', 'This overrides the default description'),
 *     'someAttribute' => 'someValue',
 * ]));
 *
 * The key/value pairs that you pass in to the job will set the public properties
 * for that object. Thus whatever you set 'someAttribute' to will cause the
 * public property $someAttribute to be set in the job.
 *
 * Passing in 'description' is optional, and only if you want to override the default
 * description.
 *
 * More info: https://github.com/yiisoft/yii2-queue
 *
 * @author    Marc Runkel
 * @package   Ekomi
 * @since     1.0.0
 */
class Download extends BaseJob
{
    // Public Properties
    // =========================================================================

    /**
     * @var \plusforta\ekomi\models\Settings
     */
    public $settings;

    // Public Methods
    // =========================================================================

    /**
     * When the Queue is ready to run your job, it will call this method.
     * You don't need any steps or any other special logic handling, just do the
     * jobs that needs to be done here.
     *
     * More info: https://github.com/yiisoft/yii2-queue
     */
    public function execute($queue)
    {

        $info = $queue->getJobInfo();
        if (Ekomi::$plugin->data->lockDB($info['id'])) {
            if (Ekomi::$plugin->data->process(
                Ekomi::$plugin->data->getData()
            )) {
                Ekomi::$plugin->data->unlockDB($info['id']);
                return true;
            }
        }
        return false;
    }

    // Protected Methods
    // =========================================================================

    /**
     * Returns a default description for [[getDescription()]], if [[description]] isn’t set.
     *
     * @return string The default task description
     */
    protected function defaultDescription(): string
    {
        return Craft::t('ekomi', 'Download');
    }


}
