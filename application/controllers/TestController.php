<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function tambahAction()
    {
        $form = new Application_Form_Barang();
        $this->view->tambah = $form;
        
        if($this->getRequest()->isPost()){
		$formData = $this->getRequest()->getPost();
		if($form->isValid($formData)){
                        $kode_brg = $form->getValue('kode_barang');
			$nama_brg = $form->getValue('nama_barang');
			$qty = $form->getValue('quantity');
			$satuan = $form->getValue('satuan');
			$harga = $form->getValue('harga_barang');
			$date = date('Y-m-d');
			$kode_gd = $form->getValue('kode_gudang');

			$data = array('kode_barang' => $kode_brg,'nama_barang' => $nama_brg,'tanggal_input' => $date,'quantity' => $qty,'satuan' => $satuan,'harga_barang' => $harga,'kode_gudang' => $kode_gd);
			$barang = new Application_Model_DbTable_Barang();
			$barang->insert($data);

			$this->_helper->redirector('index');
		}else{
			$form->populate($formData);
		}
                }
    }


}



