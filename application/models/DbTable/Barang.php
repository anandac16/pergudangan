<?php

class Application_Model_DbTable_Barang extends Zend_Db_Table_Abstract
{

    protected $_name = 'barang';

	public function add_barang($data)
	{
		$this->insert($data);
	}

	public function edit_barang($id,$data)
	{
		$update = $this->update($data,'id = ' . (int)$id);
		if(!$update)
		{
			return "Cannot update barang!";
		}
	}

	public function ambilBarang($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if(!$row)
		{
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	public function hapus_barang($id)
	{
		$this->delete('id = ' . (int)$id);
	}

}
/*
	public function getAlbum($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if(!$row)
		{
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
*/
