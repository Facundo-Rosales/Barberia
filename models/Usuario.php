<?php 
namespace Model;

use Classes\Email;
use LimitIterator;

class Usuario extends ActiveRecord{
    // base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre', 'apellido', 
    'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }
    
    // mensajes de validacion para la creacion de cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'] [] = 'El Nombre es Obligatotio';
        }

        if(!$this->apellido){
            self::$alertas['error'] [] = 'El Apellido es Obligatotio';
        }

        if(!$this->email){
            self::$alertas['error'] [] = 'El Correo es Obligatotio';
        }

        if(!$this->password){
            self::$alertas['error'] [] = 'La Contraseña es Obligatotio';
        }
        if(strlen($this->password) < 6 ){
            self::$alertas['error'] [] = 'La Contraseña debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }
    
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'] [] = 'El Correo es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'] [] = 'La contraseña es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'] [] = 'El Correo es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'] [] = 'La contraseña es obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'] [] = 'La contraseña debe tener al menos
            6 caracteres';
        }

        return self::$alertas;
    }

    public function existeUsuario(){
        $query = " SELECT * FROM " 
        . self::$tabla . " WHERE email = '". $this->email ."' LIMIT 1";

        $resultado = self::$db->query($query);
        
        if($resultado->num_rows){
            self::$alertas['error'] [] = 'El Usuario Ya Existe';
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT );
       
    }

    public function crearToken(){
        $this->token = uniqid();

    }

    public function comprobarPasswordVerificado($password){
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado){
            self::$alertas['error'] [] = 'Contraseña Incorrecta o tu cuenta no ha sido confirmada';
                                   
        }else{
            return true;
        }
    }

}