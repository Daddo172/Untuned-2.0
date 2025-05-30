<?php

declare(strict_types=1);

namespace Codeception\Template;

use Codeception\Configuration;
use Codeception\InitTemplate;
use Exception;

class Dependencies extends InitTemplate
{
    /**
     * @var string
     */
    public const DONATE_LINK = 'https://opencollective.com/codeception';

    public function setup(): void
    {
        try {
            $this->checkInstalled();
        } catch (Exception) {
            $this->sayWarning('Codeception is not installed in this directory.');
            return;
        }
        $this->sayInfo('Install Codeception Modules as Composer Packages');
        $this->say();

        $suites = Configuration::suites();
        if ($suites === []) {
            $this->sayError('No suites found in current config.');
            $this->sayWarning('If you use sub-configs with `include` option, run this script on subconfigs:');
            $this->sayWarning('Example: php vendor/bin/codecept init dependencies -c backend/');
            throw new Exception("No suites found, can't upgrade");
        }

        $modules = [];
        $config  = Configuration::config();
        foreach ($suites as $suite) {
            $settings = Configuration::suiteSettings($suite, $config);
            $modules  = array_merge($modules, Configuration::modules($settings));
        }

        $numPackages = $this->addModulesToComposer($modules);
        if ($numPackages === 0) {
            $this->sayWarning('No change needed! Everything is installed');
            return;
        }

        $this->saySuccess("Done installing!");
        $this->say();

        $this->say('Please consider donating to Codeception on regular basis:');
        $this->say();
        $this->say('<bold>' . self::DONATE_LINK . '</bold>');
        $this->say();
        $this->say("It's ok to pay for reliable software.");
        $this->say('Talk to your manager & support further development of Codeception!');
    }
}
