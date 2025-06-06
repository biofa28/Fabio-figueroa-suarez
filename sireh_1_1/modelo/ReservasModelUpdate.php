<?php
require_once __DIR__ . '/../config/database.php';

class ReservasModelUpdate
{
    private $conn;

    public function __construct()
    {
        $this->conn = BaseDeDatos::conectar();
    }

    public function obtenerReservasPendientesPaypal()
    {
        $sql = "SELECT id, nombre, correo, telefono, cedula, checkin, checkout, dias_estadia,
                huespedes, id_servicio, total_pagado, transaccion_id, fecha_registro, estado
                FROM reservas_paypal
                WHERE estado = 'pendiente'
                ORDER BY fecha_registro DESC";

        $result = $this->conn->query($sql);
        $reservas = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reservas[] = $row;
            }
        }
        return $reservas;
    }
}
