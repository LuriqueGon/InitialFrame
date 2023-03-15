<?php

namespace IF\Model;

abstract class Model
{
    private $values = [];

    public function __call($name, $args)
	{
		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		switch ($method)
		{

			case "get":
				return (isset($this->values[$fieldName]))
                        ? $this->values[$fieldName] 
                        : NULL;
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;

		}

	}

    public function __set($attr, $value)
    {
        $this->$attr = $value;
        return $this;
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }

    }

    public function getValues()
	{
		return $this->values;
	}
}