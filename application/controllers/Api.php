<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
	parent::__construct();
	$this->load->model('MSudi');
	}

	public function index()
	{
        $status = array(
                'status' => 'Ok'
        );
		echo json_encode($status);
    }

    public function GET_DATA() //Tampilkan Data
    {
        $query = $this->MSudi->GetData('tbl_mahasiswa')->result();
        echo json_encode($query);
    }

    public function POST_DATA() // Tambahkan Data
    {
        $data = [
            'nim' => urldecode($this->uri->segment(3)),
            'nama' => urldecode($this->uri->segment(4)),
            'prodi' => urldecode($this->uri->segment(5)),
            'kelas' => urldecode($this->uri->segment(6))
        ];
        $input = $this->MSudi->AddData('tbl_mahasiswa', $data);
        if($input){
            redirect('Api');;
        } else {
            echo "Error";
        }
    }

    public function PUT_DATA() // Update Data
    {
        $nim=urldecode($this->uri->segment(3));
        $update['nama']= urldecode($this->uri->segment(4));
        $update['kelas']= urldecode($this->uri->segment(5));
        $update=$this->MSudi->UpdateData('tbl_mahasiswa','nim',$nim,$update);    
        if($update){
            redirect('Api');
        } else {echo 'Error';}
    }

    public function DELETE_DATA() // Delete Data
    {
        $nim=urldecode($this->uri->segment(3));
        $delete=$this->MSudi->DeleteData('tbl_mahasiswa','nim',$nim);
        if($delete){
            redirect('Api');
        } else {echo 'Error';}
    }
}
