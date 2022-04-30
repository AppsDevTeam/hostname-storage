<?php

namespace ADT\TracySystemInfo;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SetterCommand extends Command
{
	protected static $defaultName = 'tracy-system-info:add';
	
	/** @var Storage */
	private $storage;

	const AUTO_VALUES = [
		'git-commit',
		'git-branch',
		'git-tag',
		'git-message',
		'timestamp',
	];

	public function __construct(Storage $hostnameStorage)
	{
		parent::__construct();
		$this->storage = $hostnameStorage;
	}

	public function configure()
	{
		$this->setName('tracy-system-info:add');

		$this->addArgument('key', InputArgument::OPTIONAL);
		$this->addArgument('value', InputArgument::OPTIONAL);

		foreach (static::AUTO_VALUES as $autoValueName) {
			$this->addOption($autoValueName, null, InputOption::VALUE_NONE);
		}

	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		if ($input->getArgument('key')) {
			$this->storage->add($input->getArgument('key'), $input->getArgument('value'));
		}

		foreach (static::AUTO_VALUES as $autoValueName) {
			if (!$input->getOption($autoValueName)) {
				continue;
			}

			$camelCaseName = str_replace('-', '', ucwords($autoValueName, '-'));  // dashesToCamelCase: https://stackoverflow.com/a/2792045/4837606
			$this->storage->add($autoValueName, $this->{'value' . $camelCaseName}());
		}
	}


	protected function valueGitCommit() {
		return $this->executeGit('log --format="%H" -n 1');
	}

	protected function valueGitBranch() {
		return $this->executeGit('rev-parse --abbrev-ref HEAD');
	}

	protected function valueGitTag() {
		return $this->executeGit('describe --tags --always');
	}

	protected function valueGitMessage() {
		return $this->executeGit('log -1 --pretty=%B');
	}

	protected function executeGit($args) {
		exec('git ' . $args, $output);
		return implode(PHP_EOL, $output);
	}

	protected function valueTimestamp() {
		return (new \DateTime())->format('Y-m-d H:i:s');
	}

}
