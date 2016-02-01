<?php
final class Configuration implements \ArrayAccess, \Iterator, \Countable
{
	/**
	 * @var Configuration
	 */
	private static $instance;

	private $storedData = null;
	private $data = array();
	private $isLoaded = false;

	const CONFIGURATION_FILE_PATH = PROJECT_FILE_PATH;

	public static function getValue($name)
	{
		$configuration = Configuration::getInstance();
		return $configuration->get($name);
	}

	public static function setValue($name, $value)
	{
		$configuration = Configuration::getInstance();
		$configuration->add($name, $value);
		$configuration->saveConfiguration();
	}

	private function __construct()
	{
	}

	/**
	 * @static
	 * @return Configuration
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}
	public static function getDocumentRoot()
	{
		static $documentRoot = null;
		if ($documentRoot === null)
			$documentRoot = rtrim($_SERVER["DOCUMENT_ROOT"], "/\\");
		return $documentRoot;
	}
	
	public static function getPath($path)
	{
		$path = $path;
		$path = str_replace('/src/src/', '/src/', $path);
		return preg_replace("'[\\\\/]+'", "/", $path);
	}

	private function loadConfiguration()
	{
		$this->isLoaded = false;

		$path = static::getPath(self::CONFIGURATION_FILE_PATH);
		if (file_exists($path))
		{
			$this->data = include($path);
		}

		$this->isLoaded = true;
	}

	public function saveConfiguration()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		$path = static::getPath(self::CONFIGURATION_FILE_PATH);
		$data = $this->data;
		$data = var_export($data, true);

		if (!is_writable($path)){
			@chmod($path, FILE_PERMISSIONS);
		}
		@file_put_contents($path, "<"."?php\nreturn ".$data.";\n");
	}

	public function add($name, $value)
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		if (!isset($this->data[$name]) || !$this->data[$name]["readonly"])
			$this->data[$name] = array("value" => $value, "readonly" => false);
	}

	private function addReadonly($name, $value)
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		$this->data[$name] = array("value" => $value, "readonly" => true);
	}

	public function delete($name)
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		if (isset($this->data[$name]) && !$this->data[$name]["readonly"])
			unset($this->data[$name]);
	}
	
	

	public function get($name)
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		if (isset($this->data[$name]))
			return $this->data[$name]["value"];

		return null;
	}

	public function offsetExists($name)
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		return isset($this->data[$name]);
	}

	public function offsetGet($name)
	{
		return $this->get($name);
	}

	public function offsetSet($name, $value)
	{
		$this->add($name, $value);
	}

	public function offsetUnset($name)
	{
		$this->delete($name);
	}

	public function current()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		$c = current($this->data);

		return $c === false ? false : $c["value"];
	}

	public function next()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		$c = next($this->data);

		return $c === false ? false : $c["value"];
	}

	public function key()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		return key($this->data);
	}

	public function valid()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		$key = $this->key();
		return isset($this->data[$key]);
	}

	public function rewind()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		return reset($this->data);
	}

	public function count()
	{
		if (!$this->isLoaded)
			$this->loadConfiguration();

		return count($this->data);
	}

}
