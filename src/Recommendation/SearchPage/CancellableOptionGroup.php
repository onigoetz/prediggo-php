<?php namespace Prediggo\Recommendation\SearchPage;

use Prediggo\Filter\OptionGroup;

/**
 * A group of active filters that can be cancelled. A group is made of an attribute name (for example "genre", "price", "brand") and
 * a collection of options that are currently active.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class CancellableOptionGroup extends OptionGroup
{
}
