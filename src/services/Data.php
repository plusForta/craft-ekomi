<?php
/**
 * ekomi plugin for Craft CMS 3.x
 *
 * Download ekomi data
 *
 * @link      https://github.com/plusForta/craft-ekomi
 * @copyright Copyright (c) 2019 Marc Runkel
 */

namespace plusforta\ekomi\services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use plusforta\ekomi\Ekomi;

use Craft;
use craft\base\Component;
use plusforta\ekomi\records\Data as DataRecord;

/**
 * Data Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Marc Runkel
 * @package   Ekomi
 * @since     1.0.0
 *
 * @property bool $data
 */
class Data extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Ekomi::$plugin->data->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Ekomi::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }

    public function lockDB($id = null)
    {
        return true;

    }

    public function unlockDB($id = null)
    {
        return true;
    }

    public function process($csvText)
    {
        if (!is_string($csvText)) {
            Craft::debug('No data returned', __METHOD__);

            return false;
        }

        foreach (preg_split("/((\r?\n)|(\r]n?))/", $csvText) as $line) {
            $record            = new DataRecord();
            $part              = str_getcsv($line);
            DataRecord::find()
                      ->where(['orderId' => intval($part[1])])
                      ->one();
            $record->reviewDate = date("Y-m-d H:i:s", $part[0]);
            $record->orderId    = intval($part[1]);
            $record->score      = $part[2];
            $record->comment    = $this->sanitizeComment($part[3]);
            $record->save();
        }


        return true;
    }

    public function getData()
    {
        $client = new Client();
        try {
            $res = $client->request('GET',
                'https://api.ekomi.de/get_feedback.php',
                [
                    'query' => [
                        'interface_id',
                        $this->settings->partnerID,
                        'interface_pw',
                        $this->settings->ekomiSecret,
                    ],
                ]);
        } catch (GuzzleException $exception) {
            Craft::warning('Ekomi download failed', __METHOD__);

            return false;
        }

        return $res->getBody();

    }

    /**
     * Sanitizes the returned comments for display.
     *
     * @param $text
     *
     * @return string
     */
    public function sanitizeComment($text)
    {
        // convert text string to bytes
        $raw = unpack('H*', $text);
        // remove \x83\xc2 and \xc3\x82
        $clean = pack('H*', preg_replace('/c382|83c2/', '', $raw[1]));

        // strip newlines from string, and spaces from end of string.
        $trimmed = rtrim(trim($clean, "\n\r"));

        // remove '\n' literals from the strings.
        $trimmed = preg_replace('/\\n/', ' ', $trimmed);

        return htmlentities($trimmed, ENT_COMPAT, 'UTF-8');
    }

}
