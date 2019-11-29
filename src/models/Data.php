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
 * EkomiData Model
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
class Data extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some model attribute
     *
     * @var string
     */
    public $reviewDate;
    public $orderId;
    public $score;
    public $comment;
    public $extra = '';

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
            ['reviewDate', 'datetime'],
            ['orderId', 'string'],
            ['score', 'integer'],
            ['comment', 'string'],
            ['extra', 'string'],
        ];
    }
}
