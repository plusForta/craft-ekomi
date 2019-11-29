<?php
/**
 * ekomi plugin for Craft CMS 3.x
 *
 * Download ekomi data
 *
 * @link      https://github.com/plusForta/craft-ekomi
 * @copyright Copyright (c) 2019 Marc Runkel
 */

namespace plusforta\ekomi\models;

use plusforta\ekomi\Ekomi;

use Craft;
use craft\base\Model;

/**
 * Ekomi Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Marc Runkel
 * @package   Ekomi
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var int How many ratings to stored per page
     */
    public $ratingsPerPage = 25;
    /**
     * @var int Your partner ID (set in control panel)
     */
    public $partnerID;
    /**
     * @var string the password for accessing ekomi data
     */
    public $ekomiSecret;
    /**
     * @var int How long to cache the data before updating
     */
    public $cacheTimeout = 3900;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['ratingsPerPage', 'integer', 'min' => 0, 'max' => 150],
            ['ratingsPerPage', 'default', 'value' => 25],
            ['ratingsPerPage', 'trim'],
            ['partnerID', 'integer', 'min' => 0, 'max' => 99999],
            ['partnerID', 'default', 'value' => 25],
            ['partnerID', 'trim'],
            ['ekomiSecret', 'string'],
            ['ekomiSecret', 'trim'],
            ['cacheTimeout', 'integer', 'min' => 0, 'max' => 6000],
            ['cacheTimeout', 'default', 'value' => 3900],
            ['cacheTimeout', 'trim'],
        ];
    }
}
