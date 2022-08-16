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

namespace nystudio107\eagerbeaver\variables;

use craft\base\ElementInterface;
use craft\elements\db\ElementQueryInterface;
use Illuminate\Support\Collection;
use nystudio107\eagerbeaver\EagerBeaver;

/**
 * Eager Beaver Variable
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    nystudio107
 * @package   EagerBeaver
 * @since     1.0.0
 */
class EagerBeaverVariable
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
        EagerBeaver::$plugin->eagerBeaverService->eagerLoadElements($elements, $with);
    }
}
