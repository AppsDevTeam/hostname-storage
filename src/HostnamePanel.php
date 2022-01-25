<?php

namespace ADT\HostnameStorage;

use Nette\Utils\Html;
use Tracy\IBarPanel;

class HostnamePanel implements IBarPanel
{

	/** @var HostnameStorage */
	private $hostnameStorage;

	public function __construct(HostnameStorage $hostnameStorage)
	{
		$this->hostnameStorage = $hostnameStorage;
	}

	function getTab()
	{
		return Html::el("span")->setAttribute("title", "Instance")->setText($this->hostnameStorage->get());
	}

	function getPanel()
	{
		return "Instance: " . $this->hostnameStorage->get();
	}

	public function exceptionToBlueScreen($e)
	{
		return [
			'tab' => 'hostname',
			'panel' => $this->hostnameStorage->get(),
		];
	}

}