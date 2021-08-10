<?php
class loginController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper("url"); //url permite accesar a los controladores de una manera mas practica
        $this->load->helper("cookie");
        $this->load->model("login");
        date_default_timezone_set('America/Monterrey');
    }

    public function index(){
        $this->load->view("login/index");
    }
    public function prueba(){
        echo 'funcion'; 

    }
    public function validarLogin(){
        $data = $this->input->post();
        $res = $this->login->getPass($data["correo"]);
        if($res == ""){
            $this->session->set_flashdata('message','error');
            redirect(base_url());
            
        }else{
            $pass = $res['password'];
            //$pass_encriptada = password_hash($data["contra"],PASSWORD_DEFAULT);
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
               }
        }
    }
    

    public function inicio(){
        $this->load->view("inicio/index");
    }

    public function adminPersonas(){
        $res = $this->login->adminPersonas();
        $_SESSION["personas"]= $res;
        $this->load->view("inicio/personas/personas");
    }

    public function editPersona($id){
        $res = $this->login->getInfo("personas",$id);
        $_SESSION["datosEditPersonas"]= $res;
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
        print_r($data);
    }

    public function deletePersonas($id){
        $this->session->set_flashdata("id_delete",$id);
        $this->session->set_flashdata('message','borrar');
        $this->load->view("inicio/personas/personas");
    }

    public function confirmDelete(){
        $id = $_POST["id"];
        $res = $this->login->delete("personas",$id);
        echo $res;
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
        redirect(base_url("inicio"));
    }

    public function logout(){
        session_destroy();
        redirect(base_url());
    }

    public function cambiarPass(){
        $this->load->view("inicio/cambiarPass");
    }

    public function updatePass(){
        $post = $this->input->post();
        if($post["contra"]== $post["conf"]){
            $data = array(
                "password" => password_hash($post["contra"],PASSWORD_DEFAULT)
            );
            $res = $this->login->update($data,$_SESSION["id"],"login");
            $res == "nice" ? $this->session->set_flashdata('message','cambioAct'):$this->session->set_flashdata('message','errorAct');
            redirect(base_url("cambiarPass"));
        }else{
            $this->session->set_flashdata('message','PassIncorrectas');
            redirect(base_url("cambiarPass"));
        }
    }

    

    //apartado de departamentos

    public function departamentos(){
        $res = $this->login->departamentos();
        $_SESSION["departamentos"]= $res;
        $this->load->view("inicio/departamentos/departamentos");
    }

    public function editDepartamento($id){
        $res = $this->login->getInfo("departamentos",$id);
        $_SESSION["datosEditDepartamentos"]= $res;
        $this->load->view("inicio/departamentos/editDepartamento");
    }

    public function actInfoDepartamentos(){
        $data = $this->input->post();
        try{
            $res = $this->login->actInfoDepartamentos($data);
            redirect(base_url("departamentos"));
        }catch(Exception $error){
            echo $error;
        }
        print_r($data);
    }

    public function deleteDepartamento($id){
        $this->session->set_flashdata("id_delete",$id);
        $this->session->set_flashdata('message','borrar');
        $this->load->view("inicio/departamentos/departamentos");
    }
    public function confirmDeleteDepartamento(){
        $id = $_POST["id"];
        $res = $this->login->deleteDepartamentos("departamentos",$id);
        echo $res;
    }

    public function addDepartamento(){
        $this->load->view("inicio/departamentos/addDepartamento");
    }
    public function insertDepartamentos($tabla){
        $data = $this->input->post();
        $data["fecha_registro"] = date("Y-m-d");
        $data["hora_registro"] = date("H:i:s");
        $data["estado"] = 1;
        $res = $this->login->insert($data,$tabla);
        $res == "nice" ? $this->session->set_flashdata('message','success') : $this->session->set_flashdata('message','errorInsert');
        redirect(base_url("departamentos"));
    }


}