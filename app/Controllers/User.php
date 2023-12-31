<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\KamarModel;

class User extends BaseController
{
    public $pemesananModel;
    public $kamarModel;

    public function __construct(){
        $this->pemesananModel = new PemesananModel();
        $this->kamarModel = new KamarModel();
    }

    protected $helpers=['form'];
    public function index()
    {
        $data =[
            'title' => 'Home - Customers',
        ];
        return view('/user/index', $data);
    }

    public function contact()
    {
        $data =[
            'title' => 'Contact Us - Customers',
        ];
        return view('/user/contact', $data);
    }

    public function reservasi()
    {
        $data =[
            'title' => 'Reservasi - Customers',
        ];
        return view('/user/reservasi', $data);
    }

    public function transaction()
    {
        $data =[
            'title' => 'Transaction - Customers',
            'users' => $this->pemesananModel->getPemesanan()
        ];
        return view('/user/transaction', $data);
    }

    public function create(){
        $kamar = $this->kamarModel->getKamar();
        $data=[
            'title'=>'ADD Reservasi - Customers',
            'kamar'=>$kamar
        ];
        return view('/user/reservasiCreate',$data);
    }

    public function store(){
        if (!$this->validate([
            'tanggal_pemesanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal pemesanan harus diisi!'
                ]
                ],
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal masuk Harus Diisi !',
                ]
            ],
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal keluar  Harus Diisi !',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama Harus Diisi !',
                ]
            ],
            'nomor_kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nomor kamar Harus Diisi !',
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga Harus Diisi !',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->pemesananModel->savePemesanan([
            'tanggal_pemesanan' => $this->request->getVar('tanggal_pemesanan'),
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'nama' => $this->request->getVar('nama'),
            'nomor_kamar' => $this->request->getVar('nomor_kamar'),
            'harga' => $this->request->getVar('harga'),
            'aksi' => '-',
        ]);
        return redirect()->to('/transaction');
    }

    public function edit($id){
        $pemesanan = $this->pemesananModel->getPemesanan($id);
        $kamar = $this->kamarModel->getKamar();

        $data = [
            'title' => 'Reschedule - Customers',
            'pemesanan'  => $pemesanan,
            'kamar'  => $kamar,
        ];
        return view('/user/reservasiUpdate', $data);
    }

    public function update($id){
        $data = [
            'tanggal_pemesanan' => $this->request->getVar('tanggal_pemesanan'),
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'nama' => $this->request->getVar('nama'),
            'nomor_kamar' => $this->request->getVar('nomor_kamar'),
            'harga' => $this->request->getVar('harga'),
        ];
        $result = $this->pemesananModel->updatePemesanan($data, $id);

        if(!$result){
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan data');
        }
        return redirect()->to(base_url('/transaction'));
    }
    
    public function processRefund($id) {
        $data = [
            'aksi' => 'Dikonfirmasi',
        ];
        $result = $this->pemesananModel->updatePemesanan($data, $id);

        if(!$result){
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan data');
        }
        return redirect()->to(base_url('/transaction'));
    }

    public function destroy($id){
        $result = $this->pemesananModel->deletePemesanan($id);

        if(!$result){
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
        return redirect()->to(base_url('/transaction'))
            ->with('success', 'Berhasil menghapus data');
    }

    public function sendEmail(){
        $from = $this->request->getVar('email');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');

 
        $email = \Config\Services::email();
        $email->setTo('adlii.fiqrullah@gmail.com');
        $email->setFrom($from);
                
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return redirect()->to(base_url('/user'))
                ->with('success', 'Berhasil mengirim email');
        } else{
            return redirect()->back()->with('error', 'Gagal mengirim email');

        }
    }
}
