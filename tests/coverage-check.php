<?php

require_once(__DIR__ . '/../vendor/autoload.php');

/**
 * @global SebastianBergmann\CodeCoverage\CodeCoverage $coverage
 */
$coverage = require_once('coverage-report.php');

$report = $coverage->getReport();

$linePercent = $report->getLineExecutedPercent(false);

echo 'line percent ' . $linePercent . "\n";

if ($linePercent < 90) {
    echo 'line percent < 0.9' . "\n";
    exit(1);
}
