<?php
class login extends CI_Model{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
    }

    public function IniciarSesion($correo,$pass){
        $this->db->select("*");
        $this->db->from("login");
        $this->db->where("correo",$correo); //correo == "correo"
        $this->db->where("password",$pass);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getPass($correo){
        $this->db->select("password,id,tipo_usuario");
        $this->db->from("login");
        $this->db->where("correo",$correo);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function adminPersonas(){
        $this->db->select("*");
        $this->db->from("personas");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInfo($tabla,$id){
        $this->db->select("*");
        $this->db->from($tabla);
        $this->db->where("id",$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function actInfoPersonas($data){
        $dataAct = array(
            "nombre" => $data["nombre"],
            "ap_paterno" => $data["ap_paterno"],
            "ap_materno " => $data["ap_materno"]
        );
        $this->db->update('personas', $dataAct, array('id' =>$data["id"]));
    }
    public function delete($tabla,$id){
        try{
            $this->db->delete($tabla, array('id' => $id));
            return "nice";
        }catch(Exception $error){
            return $error;
        }
    }

    public function insert($data,$tabla){
        try{
            $this->db->insert($tabla,$data);
            return "nice";
        }catch(Exception $error){
            return $error;
        }
    }

    public function update($data,$id,$tabla){
        try {
            $this->db->update($tabla,$data, array('id' => $id));
            return "nice";
        } catch (Exception $error) {
            return $error;
        }
    }

 public function trabajadores(){
        $this->db->select("*");
        $this->db->from("trabajadores");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function actInfoTrabaajdores($data){
        $dataAct = array(
            "id_departamento" => $data["id_departamento"],
            "puesto" => $data["puesto"],
            "estado " => $data["estado"]
        );
        $this->db->update('trabajadores', $dataAct, array('id' =>$data["id"]));
    }

  /*  public function deleteTrabajadores($tabla,$id){
        try{
            $this->db->delete($tabla, array('id' => $id));
            return "nice";
        }catch(Exception $error){
            return $error;
        }
    }
*/
    public function selectAlldepartamentos(){
        $this->db->select("*");
        $this->db->from("departamentos");    
        $query = $this->db->get();
        return $query->result_array();
    }
}