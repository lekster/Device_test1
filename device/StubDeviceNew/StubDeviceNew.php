<?php

require_once (PROJ_DIR . "/htdocs/console/controllers/AbstractDevice.php");

class StubDeviceNew extends AbstractDevice
{


	public function discovery()
	{
		//возвращаем адреса устройств в сети
		return array(
			'mac_addr_1',
			'mac_addr_2',
			'mac_addr_3',
			'mac_addr_4',
			);
	}
	
	public function getPortsConf()
	{
		return array(
			'a0' => ['AccessType' => 'R/W'], 
			'b0' => ['AccessType' => 'R/W'], 
			'c3' => ['AccessType' => 'R/W']
		);
	}

	protected function setPortValTempl($port, $val)
	{
		$fileName = "/tmp/dev_stub_ports_" . $this->_addr;
		$res = @file_get_contents($fileName);
		$ret = is_array(@json_decode($res, true)) ? @json_decode($res, true) : array();
		$ret[$port] = $val;
		file_put_contents($fileName, json_encode($ret));

		return true;
	}

	protected function getPortValTempl($port)
	{
		$fileName = "/tmp/dev_stub_ports_" . $this->_addr;
		$res = @file_get_contents($fileName);
		$ret = is_array(@json_decode($res, true)) ? @json_decode($res, true) : array();
		if (is_array($ret))
		{
			return @$ret[$port];
		}
		return null;
	}
	
	public function ping()
	{
		return true;
	}

	public function getVersion() { return "0.0.1"; }

}