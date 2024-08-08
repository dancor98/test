<?php

namespace Model;

class Carreras extends ActiveRecord
{

    protected static $tabla = 'postulaciones';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'cedula',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'correo',
        'departamento_id',
        'pretencion_salarial',
        'mensaje',
        'cv',
        'fecha_postulacion',
        'estado'

    ];

    public $id;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $cedula;
    public $fecha_nacimiento;
    public $genero;
    public $telefono;
    public $correo;
    public $departamento_id;
    public $pretencion_salarial;
    public $mensaje;
    public $cv;
    public $fecha_postulacion;
    public $estado;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido_paterno = $args['apellido_paterno'] ?? '';
        $this->apellido_materno = $args['apellido_materno'] ?? '';
        $this->cedula = $args['cedula'] ?? null;
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->departamento_id = $args['departamento_id'] ?? null;
        $this->pretencion_salarial = $args['pretencion_salarial'] ?? '';
        $this->mensaje = $args['mensaje'] ?? '';
        $this->cv = $args['cv'] ?? '';
        $this->fecha_postulacion = $args['fecha_postulacion'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
    }

    //Mensajes de Validacion
    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (preg_match('/[0-9]/', $this->nombre)) {
            self::$alertas['error'][] = 'El nombre no debe contener números';
        }
        if (!$this->apellido_paterno || !$this->apellido_materno) {
            self::$alertas['error'][] = 'Los apellidos son obligatorios';
        }
        if (preg_match('/[0-9]/', $this->apellido_paterno)) {
            self::$alertas['error'][] = 'El apellido paterno no debe contener números';
        }
        if (preg_match('/[0-9]/', $this->apellido_materno)) {
            self::$alertas['error'][] = 'El apellido materno no debe contener números';
        }
        if (!$this->cedula) {
            self::$alertas['error'][] = 'La cedula es obligatoria';
        }
        if (!preg_match('/^[0-9]+$/', $this->cedula)) {
            self::$alertas['error'][] = 'La cedula debe contener solo números';
        }
        if (strlen($this->cedula) < 9) {
            self::$alertas['error'][] = 'La cedula tiene que tener un minimo de 9 digitos, verifique que no existan espacios';
        }

        if (!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        if (!preg_match('/^[0-9]+$/', $this->telefono)) {
            self::$alertas['error'][] = 'El telefono debe contener solo números';
        }
        if (strlen($this->telefono) < 8 || strlen($this->telefono) > 8) {
            self::$alertas['error'][] = 'El telefono debe de tener 8 digitos';
        }

        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        } elseif (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo no es válido';
        }

        if (!$this->pretencion_salarial) {
            self::$alertas['error'][] = 'Debe indicar su pretencion salarial';
        }

        if (!$this->mensaje) {
            self::$alertas['error'][] = 'Debe indicar el mensaje para el reclutador';
        }

        return self::$alertas;
    }
}
