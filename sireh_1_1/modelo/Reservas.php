<?php
// sireh_1_1/modelo/Reservas.php

require_once '../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Reserva {
    private $conn;

    public function __construct() {
        $this->conn = BaseDeDatos::conectar();
    }

    public function crearReservaDesdePago($data) {
        $this->conn->begin_transaction();

        try {
            $cedula = $data['id'];
            $nombreCompleto = $data['fullname'];
            $email = $data['email'];
            $phone = $data['phone'];

            $stmt_huesped = $this->conn->prepare("SELECT Id_Huesped FROM `huesped` WHERE Numero_Documento = ?");
            if (!$stmt_huesped) throw new Exception("Error al preparar la búsqueda de huésped.");
            
            $stmt_huesped->bind_param("s", $cedula);
            $stmt_huesped->execute();
            $result_huesped = $stmt_huesped->get_result();
            $id_huesped_titular = null;

            if ($row = $result_huesped->fetch_assoc()) {
                // El huésped ya existe por su cédula, usamos su ID.
                $id_huesped_titular = $row['Id_Huesped'];
            } else {
                // --- NUEVA LÓGICA DE VALIDACIÓN ---
                // Si no se encontró por cédula, ahora verificamos el correo ANTES de crear.
                $stmt_check_email = $this->conn->prepare("SELECT Id_Huesped FROM `huesped` WHERE Correo_Electronico = ?");
                if (!$stmt_check_email) throw new Exception("Error al preparar la verificación de email.");

                $stmt_check_email->bind_param("s", $email);
                $stmt_check_email->execute();
                $result_email = $stmt_check_email->get_result();

                if ($result_email->num_rows > 0) {
                    // Si el correo ya existe, detenemos todo y enviamos un error claro.
                    $stmt_check_email->close();
                    // Este es el mensaje que verá el usuario.
                    throw new Exception("El correo electrónico '{$email}' ya está registrado. Por favor, verifique su número de cédula o utilice otro correo.");
                }
                $stmt_check_email->close();
                // --- FIN DE LA NUEVA LÓGICA ---

                // Si llegamos aquí, significa que ni la cédula ni el correo existen. Procedemos a crear el nuevo huésped.
                $nombres = explode(' ', trim($nombreCompleto));
                $primer_nombre = array_shift($nombres);
                $primer_apellido = !empty($nombres) ? implode(' ', $nombres) : $primer_nombre;

                $sql_insert_huesped = "INSERT INTO `huesped` (Tipo_Documento, Numero_Documento, Primer_Nombre, Primer_Apellido, Correo_Electronico, Telefono) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insert_huesped = $this->conn->prepare($sql_insert_huesped);
                if (!$stmt_insert_huesped) throw new Exception("Error al preparar la inserción de huésped.");
                
                $tipo_doc = "CC";
                $stmt_insert_huesped->bind_param("ssssss", $tipo_doc, $cedula, $primer_nombre, $primer_apellido, $email, $phone);
                
                if (!$stmt_insert_huesped->execute()) {
                    throw new Exception("Error al ejecutar la inserción de huésped.");
                }
                $id_huesped_titular = $stmt_insert_huesped->insert_id;
                $stmt_insert_huesped->close();
            }
            $stmt_huesped->close();

            if (!$id_huesped_titular) {
                 throw new Exception("No se pudo obtener un ID de huésped válido.");
            }
            
            // El resto del código para insertar la reserva no cambia.
            $sql_reserva = "INSERT INTO `reserva` (Id_Huesped_Titular, Id_Sucursal, Fecha_Hora_Llegada_Estimada, Fecha_Hora_Salida_Estimada, Num_Adultos, Id_TipoHabitacion_Solicitada, Estado_Reserva, Monto_Total_Estadia, Monto_Pagado, Origen_Reserva, Transaccion_Id_Pago_Online) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt_reserva = $this->conn->prepare($sql_reserva);
            if (!$stmt_reserva) throw new Exception("Error al preparar la inserción de reserva.");
            
            $id_sucursal = 1;
            $estado_reserva = 'Confirmada';
            $origen_reserva = 'PayPal';
            $monto_total = $data['total'];
            $id_tipo_habitacion = $data['id_servicio'];
            $num_adultos = $data['guests'];
            $checkin = $data['checkin'];
            $checkout = $data['checkout'];
            $transaccion_id = $data['transaction_id'];

            $stmt_reserva->bind_param(
                "iissisddsss",
                $id_huesped_titular,
                $id_sucursal,
                $checkin,
                $checkout,
                $num_adultos,
                $id_tipo_habitacion,
                $estado_reserva,
                $monto_total,
                $monto_total,
                $origen_reserva,
                $transaccion_id
            );

            if (!$stmt_reserva->execute()) {
                throw new Exception("Error al ejecutar la inserción de reserva.");
            }
            
            $stmt_reserva->close();
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error en la transacción de reserva: " . $e->getMessage());
            // Ahora el mensaje de error puede ser el de la validación de correo.
            return "Error: " . $e->getMessage();
        }
    }
}