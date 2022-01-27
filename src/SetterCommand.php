<?php

namespace ADT\TracySystemInfo;

use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetterCommand extends Command
{

	/** @var Storage */
	private $storage;

	public function __construct(Storage $hostnameStorage)
	{
		parent::__construct();
		$this->storage = $hostnameStorage;
	}

	public function configure()
	{
		$this->setName('tracy-system-info:set');
		$this->addArgument('jsonData', InputArgument::REQUIRED);
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$this->storage->set(Json::decode($input->getArgument('jsonData'), Json::FORCE_ARRAY));
	}

}