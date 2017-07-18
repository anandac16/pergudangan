<?php

class Application_Form_Barang extends Zend_Form
{

    public function init()
    {
        $this->setName('barang');

	$id = new Zend_Form_Element_Hidden('id');
	$id->addFilter('Int');

	$kode_barang = new Zend_Form_Element_Text('kode_barang');
	$kode_barang->setLabel('Kode Barang')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');

	$nama_barang = new Zend_Form_Element_Text('nama_barang');
	$nama_barang->setLabel('Nama Barang')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');

	$qty = new Zend_Form_Element_Text('quantity');
	$qty->setLabel('Quantity')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

	$harga = new Zend_Form_Element_Text('harga_barang');
	$harga->setLabel('Harga barang')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

	$kode_gudang = new Zend_Form_Element_Text('kode_gudang');
	$kode_gudang->setLabel('Kode Gudang')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

	$satuan = new Zend_Form_Element_Select('satuan');
	$satuan->setMultiOptions(array(
	    'buah' => 'Buah',
	    'kg' => 'Kg',
	    'liter' => 'Liter'
	))
	->setLabel('Satuan');

	$this->setDefaults(array(
	    'satuan' => 0
	));


	$submit = new Zend_Form_Element_Submit('submit');
	$submit->setAttrib('id','submitbutton');
	
	$this->addElements(array($id,$kode_barang,$nama_barang,$qty,$satuan,$harga,$kode_gudang));
    }


}

