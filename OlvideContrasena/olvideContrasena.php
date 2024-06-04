<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verifica si el email existe en la base de datos (ejemplo)
    $conn = new mysqli("localhost", "root", "", "tenis");
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("SELECT id FROM cuenta WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Genera un token único
        $token = bin2hex(random_bytes(50));
        
        // Guarda el token en la base de datos con una fecha de expiración
        $stmt = $conn->prepare("UPDATE cuenta SET reset_token = ?, reset_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE correo = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();
        
        // Configuración del correo electrónico con PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'pistastenis2024@gmail.com'; // Tu dirección de correo Gmail
            $mail->Password = 'bwefoofhhmnmvjcw'; // Tu contraseña de correo Gmail
            $mail->SMTPSecure = 'tls'; // Habilita el cifrado TLS

            // Destinatarios
            $mail->setFrom('pistastenis2024@gmail.com', 'JusTenis'); // Tu dirección de correo Gmail
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Reset your password';
            $mail->Body = 'Haz clic en el siguiente enlace para restablecer tu contraseña: ';
            $mail->Body .= '<a href="http://localhost/TFG-DAM/pistasTenis/registro/inicio-de-sesion.html">Restablecer contraseña</a>';
            $mail->AltBody = 'Haz clic en el siguiente enlace para restablecer tu contraseña: ';
            $mail->AltBody .= 'http://tu_dominio.com/reset_password.php?token=' . $token;

            $mail->send();
            header("Location: ../registro/inicio-de-sesion.html");
        } catch (Exception $e) {
            echo " El mensaje no se pudo enviar. Error de Mailer: {$mail->ErrorInfo}{$email}";
        }
    } else {
        echo "No se encontró una cuenta con ese correo electrónico.";
    }
    
    $stmt->close();
    $conn->close();
}
?>
