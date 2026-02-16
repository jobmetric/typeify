<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasListOptionType
 *
 * Composes list-related type options: show description, remove filter, change status in list.
 *
 * @package JobMetric\Typeify
 */
trait HasListOptionType
{
    use List\ShowDescriptionInListType,
        List\RemoveFilterInListType,
        List\ChangeStatusInListType;
}
