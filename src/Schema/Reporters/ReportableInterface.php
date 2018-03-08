<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Reporters;

/**
 * Interface ReportableInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Reporters
 */
interface ReportableInterface
{
    /**
     * @param array $createdMigrations
     */
    public function generateMigrationsReport(array $createdMigrations): void;

    /**
     * @param array $createdModels
     */
    public function generateModelsReport(array $createdModels): void;
}