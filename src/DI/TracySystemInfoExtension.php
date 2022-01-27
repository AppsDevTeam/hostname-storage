<?php

namespace ADT\TracySystemInfo\DI;


use ADT\TracySystemInfo\SetterCommand;
use ADT\TracySystemInfo\Storage;
use Nette;
use Nette\DI\Extensions\InjectExtension;

class TracySystemInfoExtension extends \Nette\DI\CompilerExtension {

	public function loadConfiguration() {
		$config = $this->getConfig();

		if (empty($config['storageFile'])) {
			throw new \Nette\InvalidStateException('StorageFile not specified');
		}

		$this->getContainerBuilder()
			->addDefinition($this->prefix('storage'))
			->setFactory(Storage::class)
			->setArguments([ $config['storageFile'] ]);

		$this->getContainerBuilder()
			->addDefinition($this->prefix('hostnameSetterCommand'))
			->setFactory(SetterCommand::class)
			->addTag(InjectExtension::TAG_INJECT, FALSE)
			->addTag('console.command');
	}

	public function afterCompile(Nette\PhpGenerator\ClassType $class) {
		$initMethod = $class->methods['initialize'];
		$initMethod->addBody('$_data = &$this->getService(?)->getPanel(?)->data; $_data = $_data \?: []; if (is_array($_data)) { $_data += $this->getService(?)->get();}', [ 'tracy.bar', 'Tracy:info', $this->prefix('storage') ]);
	}


}
