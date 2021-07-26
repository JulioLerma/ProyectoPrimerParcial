<?php
class loginController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper("url"); //url permite accesar a los controladores de una manera mas práctica
        $this->load->helper("cookie");
        $this->load->model("login");  //modelo no debe llamarse igual que el controlador
        date_default_timezone_set('America/Monterrey');
    }

    public function index(){
        $this->load->view("login/index");
    }

    public function validarLogin(){
        $data = $this->input->post();
        $res = $this->login->getPass($data["correo"]); //verifica que existe el correo
        //print_r($res);
        if($res == ""){
            $this->session->set_flashdata('message','error');
            redirect(base_url());
        }else{
            $pass = $res['password'];
            echo $data["contra"]."<br>".$pass."<br>";
            if(password_verify($data["contra"],$pass)){
                if(!isset($_SESSION["id"])){
                    session_start();
                    $_SESSION["id"] = $res["id"];
                    $_SESSION["tipo"] = $res["tipo_usuario"];
                    redirect(base_url("inicio"));
                }else{
                    redirect(base_url("inicio"));
                }
            }else{
                $this->session->set_flashdata('message','verify');
                redirect(base_url());
                $this->session->set_flashdata('message','');
            }
        }
    }

    public function inicio(){
        $this->load->view("inicio/index");
    }

    public function adminPersonas(){
        $res = $this->login->adminPersonas();
        $_SESSION["personas"] = $res;
        $this->load->view("inicio/personas/personas");
    }

    public function editPersona($id){
        $res = $this->login->getInfo("personas",$id);
        $_SESSION["datosEditPersona"] = $res;
        $this->load->view("inicio/personas/editPersona");
    }

    public function actInfoPersonas(){
        $data = $this->input->post();
        try{
            $res = $this->login->actInfoPersonas($data);
            redirect(base_url("adminPersonas"));
        }catch(Exception $error){
            echo $error;
        }
    }

    public function deletePersona($id){
        $this->session->set_flashdata("id_delete",$id);
        $this->session->set_flashdata('message','borrar');
        $this->load->view("inicio/personas/personas");
    }

    public function confirmDelete(){
        $id = $_POST["id"];
        $res = $this->login->delete("personas",$id);
        echo $res;
    }

    public function logout(){
        session_destroy();
        redirect(base_url());
    }

    public function addPersona(){
        $this->load->view("inicio/personas/addPersona");
    }

    public function insert($tabla){
        $data = $this->input->post();
        $data["fecha_registro"] = date("Y-m-d");
        $data["hora_registro"] = date("H:i:s");
        $data["estado"] = 1;
        $res = $this->login->insert($data,$tabla);
        $res == "nice" ? $this->session->set_flashdata('message','success') : $this->session->set_flashdata('message','errorInsert');
        redirect(base_url("adminPersonas"));
    }

}