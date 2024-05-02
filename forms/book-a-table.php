<?php
// Reemplaza contact@example.com con tu dirección real para recibir solicitudes
$receiving_email_address = 'example@noname.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('¡No se pudo cargar la biblioteca "PHP Email Form"!');
}

$book_a_table = new PHP_Email_Form;
$book_a_table->ajax = true;

$book_a_table->to = $receiving_email_address;
$book_a_table->from_name = htmlspecialchars(trim($_POST['name'])); // Limpieza y validación
$book_a_table->from_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : die('Email no válido');
$book_a_table->subject = "Nueva solicitud de cotización para evento";

$book_a_table->add_message($book_a_table->from_name, 'Nombre');
$book_a_table->add_message($book_a_table->from_email, 'Email');
$book_a_table->add_message(htmlspecialchars(trim($_POST['phone'])), 'Teléfono', 4);
$book_a_table->add_message(htmlspecialchars(trim($_POST['date'])), 'Fecha del Evento', 4);
$book_a_table->add_message(htmlspecialchars(trim($_POST['time'])), 'Duración', 4);
$book_a_table->add_message((int) $_POST['people'], 'Número de Personas', 1);
$book_a_table->add_message(htmlspecialchars(trim($_POST['message'])), 'Mensaje');

echo $book_a_table->send(); // Envía el formulario
?>