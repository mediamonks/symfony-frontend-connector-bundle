<?php

declare(strict_types=1);

namespace MediaMonks\FrontendConnectorBundle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class SetupCommand extends Command
{
    protected static $defaultName = 'frontend-connector:setup';

    private string $projectDir;

    public function __construct(string $projectDir)
    {
        parent::__construct(self::$defaultName);
        $this->projectDir = $projectDir;
    }

    protected function configure()
    {
        $this->setDescription('Adds global asset_version to twig.yaml.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $twigFile = $this->projectDir . '/config/packages/twig.yaml';

        if (!is_file($twigFile)) {
            $output->writeln(sprintf("%s not found.", $twigFile));
            return Command::FAILURE;
        }

        $parsedYaml = Yaml::parseFile($twigFile);

        if (isset($parsedYaml['twig']['globals'])) {
            $parsedYaml['twig']['globals']['asset_version'] = '%asset_version%';
        } else {
            $parsedYaml['twig']['globals'] = [
                'asset_version' => "%asset_version%",
            ];
        }

        file_put_contents($twigFile, Yaml::dump($parsedYaml, 5));

        $output->writeln('The asset_version property was successfully added to ' . $twigFile);

        return Command::SUCCESS;
    }
}