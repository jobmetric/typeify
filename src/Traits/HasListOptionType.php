<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasListOptionType
 *
 * @package JobMetric\Typeify
 */
trait HasListOptionType
{
    use List\ShowDescriptionInListType,
        List\RemoveFilterInListType,
        List\ChangeStatusInListType;
}
