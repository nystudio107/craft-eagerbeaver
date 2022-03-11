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

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use nystudio107\eagerbeaver\services\EagerBeaverService;
use nystudio107\eagerbeaver\twigextensions\EagerBeaverTwigExtension;
use nystudio107\eagerbeaver\variables\EagerBeaverVariable;
use yii\base\Event;

/**
 * Eager Beaver plugin
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 *
 * @property  EagerBeaverService $eagerBeaverService
 */
class EagerBeaver extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ?EagerBeaver
     */
    public static ?EagerBeaver $plugin = null;

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        $config['components'] = [
            'eagerBeaverService' => EagerBeaverService::class,
        ];

        parent::__construct($id, $parent, $config);
    }

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
            static function (Event $event): void {
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
