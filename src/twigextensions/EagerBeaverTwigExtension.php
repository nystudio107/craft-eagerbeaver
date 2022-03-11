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

namespace nystudio107\eagerbeaver\twigextensions;

use nystudio107\eagerbeaver\EagerBeaver;

use craft\base\ElementInterface;

/**
 * Eager Beaver TwigExtension
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 */
class EagerBeaverTwigExtension extends \Twig\Extension\AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'EagerBeaver';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('eagerLoadElements', function (array $elements, array|string $with) : void {
                $this->eagerLoadElements($elements, $with);
            }),
        ];
    }

    /**
     * Eager-loads additional elements onto a given set of elements.
     *
     * @param ElementInterface[] $elements The root element models that should
     *                                     be updated with the eager-loaded
     *                                     elements
     * @param string|array       $with     Dot-delimited paths of the elements
     *                                     that should be eager-loaded into the
     *                                     root elements
     */
    public function eagerLoadElements(array $elements, array|string $with): void
    {
        EagerBeaver::$plugin->eagerBeaverService->eagerLoadElements($elements, $with);
    }
}
