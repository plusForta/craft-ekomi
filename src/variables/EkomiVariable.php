<?php
/**
 * ekomi plugin for Craft CMS 3.x
 *
 * Download ekomi data
 *
 * @link      https://github.com/plusForta/craft-ekomi
 * @copyright Copyright (c) 2019 Marc Runkel
 */

namespace plusforta\ekomi\variables;

use plusforta\ekomi\Ekomi;

use Craft;

/**
 * ekomi Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.ekomi }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Marc Runkel
 * @package   Ekomi
 * @since     1.0.0
 */
class EkomiVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.ekomi.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.ekomi.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
}
