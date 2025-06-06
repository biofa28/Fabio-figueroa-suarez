<?php
session_start();

require_once __DIR__ . '/../modelo/ReservasModelUpdate.php';

class ReservaControllerUpdate
{
    private $reservaModel;

    public function __construct()
    {
        $this->reservaModel = new ReservasModelUpdate();
    }

    public function listarReservasPendientesPaypal()
    {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'recepcionista') {
            http_response_code(403);
            echo json_encode(['success' => false, 'msg' => 'No autorizado']);
            exit;
        }

        $reservas = $this->reservaModel->obtenerReservasPendientesPaypal();

        echo json_encode(['success' => true, 'data' => $reservas]);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'listarPendientesPaypal') {
    $controller = new ReservaControllerUpdate();
    $controller->listarReservasPendientesPaypal();
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'msg' => 'Acción no válida']);
}
