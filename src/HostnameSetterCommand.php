<?php

namespace ADT\HostnameStorage;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HostnameSetterCommand extends Command
{

	/** @var HostnameStorage */
	private $hostnameStorage;

	public function __construct(HostnameStorage $hostnameStorage)
	{
		parent::__construct();
		$this->hostnameStorage = $hostnameStorage;
	}

	public function configure()
	{
		$this->setName('app:savehostname');
		$this->addArgument('hostname', InputArgument::REQUIRED);
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$this->hostnameStorage->set($input->getArgument('hostname'));
	}

}