<?php

require_once(__DIR__ . '/../vendor/autoload.php');

/**
 * @global SebastianBergmann\CodeCoverage\CodeCoverage $coverage
 */
$coverage = require_once('coverage-report.php');

$report = $coverage->getReport();

$linePercent = $report->getLineExecutedPercent(false);

echo 'line percent ' . $linePercent . "\n";

if ($linePercent < 80) {
    echo 'line percent < 80%' . "\n";
    exit(1);
}
