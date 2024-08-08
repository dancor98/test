<?php

namespace Model;

class Incapacidades extends ActiveRecord
{
    protected static $tabla = 'boletas_incapacidad';
    protected static $columnasDB = [
        'id',
        'colaborador_id',
        'fecha',
        'boleta',
        'motivo',
        'cantidad_dias',
        'estado',
        'desde',
        'hasta'
    ];

    public $id;
    public $colaborador_id;
    public $fecha;
    public $boleta;
    public $motivo;
    public $cantidad_dias;
    public $estado;
    public $desde;
    public $hasta;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->colaborador_id = $args['colaborador_id'] ?? null;
        $this->fecha = $args['fecha'] ?? ''; // Corrección del campo 'fecha'
        $this->boleta = $args['boleta'] ?? '';
        $this->motivo = $args['motivo'] ?? '';
        $this->cantidad_dias = $args['cantidad_dias'] ?? 0;
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->desde = $args['desde'] ?? '';
        $this->hasta = $args['hasta'] ?? '';
    }

    // Mensajes de Validación
    public function validar()
    {
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        return self::$alertas;
    }
}
