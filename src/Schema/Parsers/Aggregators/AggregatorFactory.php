<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

class AggregatorFactory
{
    /**
     * @param array $relationSymbols
     *
     * @return \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\AggregatorInterface
     */
    public function make(array $relationSymbols): AggregatorInterface
    {
        if ($this->isOneToOne($relationSymbols))
            return new OneToOne;

        if ($this->isOneToMany($relationSymbols))
            return new OneToMany;

        if ($this->isManyToOne($relationSymbols))
            return new ManyToOne;

        if ($this->isManyToMany($relationSymbols))
            return new ManyToMany;
    }

    /**
     * @param array $relationSymbols
     *
     * @return bool
     */
    protected function isOneToOne(array $relationSymbols): bool
    {
        return ArrayHelpers::colonImplode($relationSymbols) == Constants::ONE_TO_ONE_SYMBOL;
    }

    /**
     * @param array $relationSymbols
     *
     * @return bool
     */
    protected function isOneToMany(array $relationSymbols): bool
    {
        return ArrayHelpers::colonImplode($relationSymbols) == Constants::ONE_TO_MANY_SYMBOL;
    }

    /**
     * @param array $relationSymbols
     *
     * @return bool
     */
    protected function isManyToOne(array $relationSymbols): bool
    {
        return ArrayHelpers::colonImplode($relationSymbols) == Constants::MANY_TO_ONE_SYMBOL;
    }

    /**
     * @param array $relationSymbols
     *
     * @return bool
     */
    protected function isManyToMany(array $relationSymbols): bool
    {
        return ArrayHelpers::colonImplode($relationSymbols) == Constants::MANY_TO_MANY_SYMBOL;
    }
}