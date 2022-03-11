<?php
/**
 * Eager Beaver plugin for Craft CMS 3.x
 *
 * Allows you to eager load elements from auto-injected Entry elements on
 * demand from your templates.
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2017 nystudio107
 */

namespace nystudio107\eagerbeaver;

use nystudio107\eagerbeaver\services\EagerBeaverService as EagerBeaverServiceService;
use nystudio107\eagerbeaver\variables\EagerBeaverVariable;
use nystudio107\eagerbeaver\twigextensions\EagerBeaverTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Eager Beaver plugin
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 *
 * @property  EagerBeaverServiceService $eagerBeaverService
 */
class EagerBeaver extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var EagerBeaver
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Add in our Twig extensions
        Craft::$app->view->registerTwigExtension(new EagerBeaverTwigExtension());

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event): void {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('eagerBeaver', EagerBeaverVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'eager-beaver',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
