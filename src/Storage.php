<?php

namespace ADT\TracySystemInfo;

use Nette\Utils\Json;

class Storage
{

	/** @var string */
	protected $storageFile;

	/**
	 * @param $storageFile
	 */
	public function __construct($storageFile)
	{
		$this->storageFile = $storageFile;
	}

	public function get()
	{
		$data = @file_get_contents($this->storageFile); // @ - file may not exist

		if (!$data) {
			return [];
		}

		return Json::decode($data, Json::FORCE_ARRAY);
	}

	public function set($data)
	{
		file_put_contents($this->storageFile, Json::encode($data));
	}

}