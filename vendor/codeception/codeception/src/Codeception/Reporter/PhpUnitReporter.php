<?php

declare(strict_types=1);

namespace Codeception\Reporter;

use Codeception\Event\SuiteEvent;
use Codeception\Event\TestEvent;
use Codeception\Test\Interfaces\Reported;
use Codeception\Test\Test;
use ReflectionClass;

class PhpUnitReporter extends JUnitReporter
{
    public const SUITE_LEVEL = 1;
    public const FILE_LEVEL  = 2;

    protected string $reportFileParam = 'phpunit-xml';
    protected string $reportName = 'PHPUNIT XML';
    private ?string $currentFile = null;

    public function startTest(TestEvent $event): void
    {
        $test = $event->getTest();
        $filename = method_exists($test, 'getFileName') ? $test->getFileName() : (new ReflectionClass($test))->getFileName();

        if ($filename !== $this->currentFile) {
            if ($this->currentFile !== null) {
                parent::afterSuite(new SuiteEvent());
            }

            $this->initializeFileLevelSuite($filename, $test);
            $this->currentFile = $filename;
        }

        parent::startTest($event);
    }

    private function initializeFileLevelSuite(string $filename, Test $test): void
    {
        $this->testSuiteAssertions[self::FILE_LEVEL] = 0;
        $this->testSuiteTests[self::FILE_LEVEL]      = 0;
        $this->testSuiteTimes[self::FILE_LEVEL]      = 0;
        $this->testSuiteErrors[self::FILE_LEVEL]     = 0;
        $this->testSuiteFailures[self::FILE_LEVEL]   = 0;
        $this->testSuiteSkipped[self::FILE_LEVEL]    = 0;
        $this->testSuiteUseless[self::FILE_LEVEL]    = 0;

        $this->testSuiteLevel = self::FILE_LEVEL;

        $currentFileSuiteElement = $this->document->createElement('testsuite');

        if ($test instanceof Reported) {
            $reportFields = $test->getReportFields();
            $class = $reportFields['class'] ?? $reportFields['name'];
            $currentFileSuiteElement->setAttribute('name', $class);
        } else {
            $currentFileSuiteElement->setAttribute('name', $test::class);
        }

        $currentFileSuiteElement->setAttribute('file', $filename);

        $this->testSuites[self::SUITE_LEVEL]->appendChild($currentFileSuiteElement);
        $this->testSuites[self::FILE_LEVEL] = $currentFileSuiteElement;
    }

    /**
     * Cleans the mess caused by test suite manipulation in startTest
     */
    public function afterSuite(SuiteEvent $event): void
    {
        $suite = $event->getSuite();
        if ($suite->getName() && $this->currentFile) {
            parent::afterSuite(new SuiteEvent($suite));
            $this->currentFile = null;
        }
        $this->testSuiteLevel = self::SUITE_LEVEL;
        parent::afterSuite($event);
    }
}
