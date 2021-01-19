<?php

defined('BASEPATH') or exit('No direct script access allowed');

class json extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('json_model');
    }
    public function index()
    {
        // echo 'text controller';
        // $oneContact = array(
        //     'name' => 'kay',
        //     'age' => 28
        // );
        // $allContact = array();

        // array_push($allContact, $oneContact);

        // $twoContact = array(
        //     'name' => 'thuy',
        //     'age' => 27
        // );

        // array_push($allContact, $twoContact);
        // echo "<pre>";
        // var_dump($allContact);

        // $contentEncode = json_encode($allContact);
        // echo '<h2>Kiểu dữ liệu Json dc mã hoá để nhét vào mysql</h2>';
        // echo "<pre>";
        // var_dump($contentEncode);

        // $contentDecode = json_decode($contentEncode);
        // echo '<h2>Kiểu dữ liệu mảng dc giải mã để sử dụng dữ liệu</h2>';
        // echo "<pre>";
        // var_dump($contentDecode);
        // $this->load->model('json_model');
        // $this->json_model->insertData('contact', $contentEncode);

        $this->load->model('json_model');
        $rs = $this->json_model->showData();
        // echo '<pre>';
        // var_dump($rs);

        $rs = json_decode($rs);
        // echo '<pre>';
        // var_dump($rs);

        $rs = array('mangdl' => $rs);
        $this->load->view('show_data', $rs, FALSE);
    }

    public function deleteData($age)
    {
        $data = $this->json_model->showData();
        // echo '<pre>';
        // var_dump($data);
        $data = json_decode($data);
        foreach ($data as $key => $value) {
            if ($value->age == $age) {
                unset($data[$key]);
            }
        }
        $data = json_encode($data);
        if ($this->json_model->updateData($data)) {
            $this->load->view('success_view');
        } else {
            echo 'Delete fail';
        }
    }

    public function insertData()
    {
        $ten = $this->input->post('name');
        $tuoi = $this->input->post('age');
        $data = $this->json_model->showData();
        $data = json_decode($data, true);
        $oneObject = array(
            'name' => $ten,
            'age' => $tuoi
        );
        array_push($data, $oneObject);

        $data = json_encode($data);
        // echo "<pre>";
        // var_dump($data);
        // $this->db->where('ten', 'contact');
        // $this->db->insert('warehouse', $data);
        if ($this->json_model->updateData($data)) {
            $this->load->view('success_view');
        } else {
            echo 'Insert fail';
        }
    }

    public function editData()
    {
        $ten = $this->input->post('name');
        $tuoi = $this->input->post('age');
        $data = $this->json_model->showData();
        $data = json_decode($data, true);
        $obj = array(
            'name' => $ten,
            'age' => $tuoi
        );
        array_push($data, $obj);
        $data = json_encode($data);
        echo '<pre>';
        var_dump($data);
        // if ($this->json_model->updateData($data)) {
        //     $this->load->view('success_view', $data, FALSE);
        // } else {
        //     echo 'Edit fail';
        // }
    }
}

/* End of file json.php */
