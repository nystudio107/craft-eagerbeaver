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

namespace nystudio107\eagerbeaver\services;

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\elements\db\ElementQueryInterface;
use Illuminate\Support\Collection;
use function is_array;

/**
 * EagerBeaverService Service
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 */
class EagerBeaverService extends Component
{
    // Public Methods
    // =========================================================================
    /**
     * Eager-loads additional elements onto a given set of elements.
     *
     * @param ElementInterface|ElementQueryInterface|Collection|array $elements The root
     * element models that should be updated with the eager-loaded elements
     * @param string|array $with Dot-delimited paths of the elements that should be
     * eager-loaded into the root elements
     */
    public function eagerLoadElements(ElementInterface|ElementQueryInterface|Collection|array $elements, array|string $with): void
    {
        // Normalize Collections to an array of Elements
        if ($elements instanceof Collection) {
            $elements = $elements->toArray();
        }
        // Normalize ElementQuery's to an array of Elements
        if ($elements instanceof ElementQueryInterface) {
            $elements = $elements->all();
        }
        // Bail if there aren't even any elements
        if (empty($elements)) {
            return;
        }
        // Normalize an individual element to an array of Elements
        if (!is_array($elements)) {
            $elements = [$elements];
        }
        // We are assuming all of these elements are of the same type
        /** @var Element $element */
        $element = $elements[0];
        $elementType = $element::class;
        Craft::$app->elements->eagerLoadElements($elementType, $elements, $with);
    }
}
