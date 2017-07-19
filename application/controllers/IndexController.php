<?php

class IndexController extends Zend_Controller_Action {
    public function init() {
        /* Initialize action controller here */
    }
    public function indexAction() {
        $barang = new Application_Model_DbTable_Barang();
        $this->view->barang = $barang->fetchAll();
    }
    public function tambahAction() {
        $form = new Application_Form_Barang();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $kode_brg = $form->getValue('kode_barang');
                $nama_brg = $form->getValue('nama_barang');
                $qty = $form->getValue('quantity');
                $satuan = $form->getValue('satuan');
                $harga = $form->getValue('harga_barang');
                $date = date('Y-m-d');
                $kode_gd = $form->getValue('kode_gudang');
                $data = array('kode_barang' => $kode_brg, 'nama_barang' => $nama_brg, 'tanggal_input' => $date, 'quantity' => $qty, 'satuan' => $satuan, 'harga_barang' => $harga, 'kode_gudang' => $kode_gd);
                $barang = new Application_Model_DbTable_Barang();
                $barang->add_barang($data);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }
    public function editAction() {
        $form = new Application_Form_Barang();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formdata = $this->getRequest()->getPost();
            if ($form->isValid($formdata)) {
                $id = (int) $form->getValue('id');
                $kode_brg = $form->getValue('kode_barang');
                $nama_brg = $form->getValue('nama_barang');
                $qty = $form->getValue('quantity');
                $satuan = $form->getValue('satuan');
                $harga = $form->getValue('harga_barang');
                $date = date('Y-m-d');
                $kode_gd = $form->getValue('kode_gudang');
                $data = array('kode_barang' => $kode_brg, 'nama_barang' => $nama_brg, 'quantity' => $qty, 'satuan' => $satuan, 'harga_barang' => $harga, 'kode_gudang' => $kode_gd);
                $barang = new Application_Model_DbTable_Barang();
                $barang->edit_barang($id, $data);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formdata);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $barang = new Application_Model_DbTable_Barang();
                $form->populate($barang->ambilBarang($id));
            }
        }
    }
    public function hapusAction() {
        if ($this->getRequest()->isPost()) {
            $barang = new Application_Model_DbTable_Barang();
            $id = $this->getRequest()->getPost('id');
            $barang->hapus_barang($id);
        }
    }
    public function editableAction() {
        $this->getHelper('layout')->disableLayout();
        $barang = new Application_Model_DbTable_Barang();
        $type = $this->_getParam('type', 0);
        $id = $this->_getParam('id', 0);
        switch ($type) {
            case 'kodebrg':
                $field = "kode_barang";
                break;
            case 'namabrg':
                $field = "nama_barang";
                break;
            case 'qty':
                $field = "quantity";
                break;
            case 'harga':
                $field = "harga_barang";
                break;
            case 'kodegd':
                $field = "kode_gudang";
                break;
            case 'tglout':
                $field = "tanggal_keluar";
                break;
            case 'satuan':
                $field = "satuan";
                break;
        }
        if ($this->getRequest()->isPost()) {
            $barang = new Application_Model_DbTable_Barang();
            $id = $this->getRequest()->getPost('id');
            $value = $this->getRequest()->getPost('value');
            $data = array($field => $value);
            $barang->edit_barang($id, $data);
            $this->view->editable = $value;
        } else {
            $date = date("Y-m-d");
            $data = array('tanggal_keluar' => $date);
            $barang = new Application_Model_DbTable_Barang();
            $barang->edit_barang($id, $data);
            $this->_helper->redirector('index');
        }
    }
}
