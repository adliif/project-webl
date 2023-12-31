<?php

namespace App\Controllers;
use App\Models\PemesananModel2;
// use App\Models\KamarModel2;
class Pemesanan extends BaseController
{
    protected $pemesananModel;
    protected $kamarModel;
    public function __construct(){
        $this->pemesananModel = new PemesananModel2();
        // $this->kamarModel = new KamarModel2();
    }


    public function index()
    {
        // $list_kamar = $this->kamarModel->findAll();
        $list_data = $this->pemesananModel->getData($id = false,"v_pemesanan");
        // dd($list_kamar);
        $data["title"] = "Data Pemesanan - Staf";
        $data['list'] = $list_data;
        // $data['list2'] = $list_kamar;
        $db = db_connect();
        $query   = $db->query("SELECT * FROM kamar");
        $data['list2'] = $query->getResult();

         return view('Pemesanan/list',$data);
    }

    public function edit($id){
         $data = $this->pemesananModel->getData($id,"pemesanan");
         echo json_encode($data);
    }

    public function simpan(){
        // dd($this->request->getVar());
        //  ['id_kamar', 'tanggal_pemesanan', 'tanggal_masuk'];
        $table = "pemesanan";
        $data =  [
                    "id_kamar" => $this->request->getVar('id_kamar'),
                    'tanggal_pemesanan' => $this->request->getVar('tanggal_pemesanan'), 
                    'tanggal_masuk' => $this->request->getVar('tanggal_masuk'), 
                    'tanggal_keluar' => $this->request->getVar('tanggal_keluar'), 
                    'harga' => $this->request->getVar('harga'), 
                    
                    ];
        // $insert = $this->staffModel->insert($data);
        $this->pemesananModel->insertData($table, $data);
        echo json_encode(array("status" => TRUE));
    }

     public function hapus($id){
        $table = "pemesanan";
        $this->pemesananModel->deleteByCondition($table,["id"=>$id]);
        echo json_encode(array("status" => TRUE));
    }

    public function update($id){
        $table = "pemesanan";
        $data =  [
                    "id_kamar" => $this->request->getVar('id_kamar'),
                    'tanggal_pemesanan' => $this->request->getVar('tanggal_pemesanan'), 
                    'tanggal_masuk' => $this->request->getVar('tanggal_masuk'), 
                    'tanggal_keluar' => $this->request->getVar('tanggal_keluar'), 
                    'harga' => $this->request->getVar('harga'), 
                    ];

        $this->pemesananModel->UpdateData($table, $data,["id"=>$id]);
        echo json_encode(array("status" => TRUE));
    }

    public function acc($id){
        $table = "pemesanan";
        $data =  [
                    'aksi' => "Dikonfirmasi", 
                    ];

        // $this->pemesananModel->where(["id"=>$id])->set($data)->update();
        $this->pemesananModel->UpdateData($table, $data,["id"=>$id]);
        echo json_encode(array("status" => TRUE));
    }



}
