<?php

namespace ADT\HostnameStorage;

class HostnameStorage
{

	/** @var string */
	protected $dir;

	/**
	 * @param $dir
	 */
	public function __construct($dir)
	{
		$this->dir = $dir;
	}

	public function get()
	{
		return @file_get_contents($this->dir . "/instance");
	}

	public function set($hostname)
	{
		@file_put_contents($this->dir . "/instance", $hostname);
	}

}