<?php
/**
 * Eager Beaver plugin for Craft CMS 3.x
 *
 * Allows you to eager load elements from auto-injected Entry elements on demand from your templates.
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2017 nystudio107
 */

namespace nystudio107\eagerbeaver\twigextensions;

use nystudio107\eagerbeaver\EagerBeaver;

use Craft;
use craft\base\ElementInterface;

/**
 * Eager Beaver TwigExtension
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 */
class EagerBeaverTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'EagerBeaver';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('eagerLoadElements', [$this, 'eagerLoadElements']),
        ];
    }

    /**
     * Eager-loads additional elements onto a given set of elements.
     *
     * @param ElementInterface[] $elements    The root element models that should be updated with the eager-loaded elements
     * @param string|array       $with        Dot-delimited paths of the elements that should be eager-loaded into the root elements
     *
     * @return void
     */
    public function eagerLoadElements($elements, $with)
    {
        EagerBeaver::$plugin->eagerBeaverService->eagerLoadElements($elements, $with);
    }
}
