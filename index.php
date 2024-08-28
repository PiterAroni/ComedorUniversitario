<?php
include("admin/bd.php");

$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id ASC limit 1");
$sentencia->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_cocineros ORDER BY id ASC limit 3");
$sentencia->execute();
$lista_cocineros=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_comentarios ORDER BY id ASC limit 4");
$sentencia->execute();
$lista_comentarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_menu ORDER BY id ASC limit 6");
$sentencia->execute();
$lista_menu=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST){


$nombre=filter_var($_POST["nombre"],FILTER_SANITIZE_STRING);
$correo=filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL);
$mensaje=filter_var($_POST["mensaje"],FILTER_SANITIZE_STRING);

if($nombre && $correo && $mensaje) {

    $sql="INSERT INTO
    tbl_retroalimentacion (nombre, correo, mensaje)
    VALUES (:nombre, :correo,:mensaje)";

    $resultado= $conexion->prepare($sql);
    $resultado ->bindParam(':nombre',$nombre,PDO::PARAM_STR);
    $resultado ->bindParam(':correo',$correo,PDO::PARAM_STR);
    $resultado ->bindParam(':mensaje',$mensaje,PDO::PARAM_STR);
    $resultado ->execute();
 }
 header("Location:index.php");

  }
?>
<!doctype html>
<html lang="es">

<head>
    <title>Comedor Universitario UNFV</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Formulario de Tickets -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <style>
        .section-reserve {
            width: 70%;
            margin-top: 1em;
            margin-bottom: 1em;
        }
    </style>
    <!-- Fin Formulario de Tickets -->
</head>

<br>
	<video autoplay muted loop id="myVideo"
		style="position:fixed; z-index:-10; opacity:0.8;">
		<source src="images/video_bg.mp4" type="video/mp4">
	</video>
    <nav id="inicio" class="navbar navbar-expand-lg navbar-light" style="background-color: #FFB233;">
        <div class="container">
            <a class="navbar-brand" href="#"> <i class="fas fa-utensils"> </i> Comedor Universitario UNFV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menú del día</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cocineros">Cocineros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#comentarios">Comentarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#retroalimentacion">Retroalimentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#horario">Horarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container-fluid p-0">
        <div class="banner-img" style="position:relative; background:url('https://www.unsa.edu.pe/wp-content/uploads/2023/04/Autoridades-universitarias-junto-a-comensales-en-el-primer-da-del-servicio-de-comedor.-scaled.jpg') no-repeat center center; background-size: cover;height: 400px">
            <div class="banner-text" style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); color: white; text-align: center;">
                <?php
                foreach ($lista_banners as $banner) {
                ?>

                    <h1><?php echo $banner['titulo']; ?></h1>
                    <p><?php echo $banner['descripcion']; ?></p>
                    <a href="<?php echo $banner['link']; ?>" class="btn btn-primary">Ver Menú</a>
                <?php } ?>

            </div>
        </div>
    </section>

    <section id="id" class="container mt-4 text-center">
        <div class="jumbotron bg-dark text-white">
            <h2>Bienvenido al Comedor Universitario del Anexo 7</h2>
            <p>Lugar donde los estudiantes pueden disfrutar de la comida</p>
        </div>
    </section>

    <section id="cocineros" class="container mt-4 text-center">
        <h2>Nuestros Cocineros</h2>
        <div class="row">
            <?php foreach ($lista_cocineros as $cocinero) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/cocineros/<?php echo $cocinero["foto"]; ?>"
                            class="card-img-top"
                            alt="Cocinero 1" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $cocinero["titulo"]; ?></h5>
                            <p class="card-text"><?php echo $cocinero["descripcion"]; ?></p>
                            <div class="social-icons mt-3">
                                <a href="<?php echo $cocinero["linkfacebook"]; ?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="<?php echo $cocinero["linkinstagram"]; ?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo $cocinero["linklinkedin"]; ?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <br/></br/>
    <section id="comentarios" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Comentarios</h2>
            <div class="row">

            <?php foreach ($lista_comentarios as $comentarios){ ?>
                
                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text"> <?php echo $comentarios["comentario"];?> </p>
                        </div>
                        <div class="card-footer text-muted">
                        <?php echo $comentarios["nombre"];?>
                        </div>
                    </div>
                </div>

            <?php }?>
            </div>

        </div>
    </section>
    <br/><br/>
    <section id="menu" class="container mt-4">
        <?php
        /*
            arreglo para los dias de la semana,
            segun lo conversado, el dia es estatico en la cabecera de cada menu,
            independientemente al nombre del menu de la base de datos
        */
        $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        $dia = 0;

        ?>
        <h2 class="text-center">Menú del comedor universitario</h2>
        <br/>
        <div class="row row-cols-1 row-cols-md-3 g-3">

        <?php foreach($lista_menu as $registro ) { ?>
            <div class="col d-flex">
                <div class="card">
                    <h3 class="text-center"><?= $dias[$dia] ?></h3>
                    <img src="images/menu/<?php echo $registro["foto"];?>" alt="Tortillas de maiz con frijoles" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card title"><?php echo $registro["nombre"];?></h5>
                        <p class="card-text small"><strong><?php echo $registro["ingredientes"];?></strong></p>
                        <p class="card-text"><strong> Precio:</strong> $<?php echo $registro["precio"];?> </p>
                    </div>
                </div>
            </div>
            <?php $dia ++; if($dia == 6) {$dia == 0;} }?>
        </div>
    </section>
    <br/>
    <div style="background:whitesmoke;">
    <br/>
    <section class="container" >
        <div class="my-5" id="Reserve">
            <h3 class="">Reserva de Atención </h3>
            <div id="login" class="">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div>&nbsp;</div>
                        <div class="text-center">
                            <h4 class="center-align"><i class="material-icons">lock_open</i><b>LOGIN</b></h5>
                                <div class="px-5">
                                    <p class=""><b>Identifíquese como alumno de la UNFV</b></p>
                                    <p class="">Es necesario ser alumno de la UNFV para realizar una reserva en el programa de comedor universitario</p>
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <form id="loginForm" class="" method="post">
                            <div class="">
                                <div class="mb-3">
                                    <label for="codigo" class="form-label">
                                        <i class="material-icons prefix">school</i> Código de Alumno
                                    </label>
                                    <input class="form-control" name="codAlu" id="codigo" type="text" maxlength="10" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="codigo" class="form-label">
                                        <i class="material-icons prefix">account_circle</i> Documento de Identidad
                                    </label>
                                    <input class="form-control" class="validate" name="numDoc" id="dni" type="text" maxlength="15" required>
                                </div>
                                <div class="text-center" id="btn-login">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>
    </div>
    <br/>
    <section id="retroalimentacion" class="container mt-4">
        <h2>Retroalimentación</h2>
        <p>Estamos aqui para servirle</p>
        <form action="?" method="post">
            <div class="mb-3">
                <label for="name">Nombre:</label><br />
                <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required><br />
            </div>
            <div class="mb-3">
                <label for="email">Correo electrónico:</label><br />
                <input type="email" class="form-control" name="correo" placeholder="Escribe tu correo electronico..." required><br />
            </div>
            <div class="mb-3">
                <label for="message">Mensaje:</label><br />
                <textarea id="message" class="form-control" name="mensaje" rows="6" cols="50"></textarea><br />
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar mensaje">
        </form>
    </section>
    <br><br />

    <div id="horario" class="text-center bg-light p-4">
        <h3 class="mb-4"> Horario de atención </h3>
        <div>
            <p> <strong> Lunes a Viernes </strong></p>
            <p> <strong> 7:00 am - 10:00 pm </strong></p>

            <p> <strong> Sabados </strong></p>
            <p> <strong> 7:00 am - 9:00 pm </strong></p>

            <p> <strong> Domingos </strong></p>
            <p> <strong> No hay atencion </strong></p>
        </div>
    </div>

    
<footer class="text-white" style="background-color: #FF9333">
    <div class="container">
        <div class="row py-4">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Comedor Universitario Anexo 8</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <i class="fas fa-map-marker-alt"></i> Av. Óscar R. Benavides 450, Lima 15082
                    </li>
                    <li>
                        <i class="fas fa-phone"></i> (01) 7480888 Anexo 8740
                    </li>
                    <li>
                        Anexos:
                        <ul>
                            <li>Comedor Anexo 7</li>
                        </ul>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i> Correos: <a href="mailto:aaasp.ocbu@unfv.edu.pe" class="text-white">aaasp.ocbu@unfv.edu.pe</a> (Área de Apoyo Alimentario)
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Universidad Nacional Federico Villarreal</a></li>
                    <li><a href="#" class="text-white">Oficina Central de Bienestar Universitario</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 - UNFV
    </div>
</footer>

    <!-- Modals para el Formulario -->
    <!-- Mensaje del modal para cuando es correcto los datos -->
    <div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="forModalSuccess" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Inicio de sesión exitoso</h4>
                    <p>Bienvenido al sistema de reservas del comedor universitario.</p>
                    <p id="availableTickets"></p>
                    <div class="py-2">
                        <button id="generateTicketButton" class="btn btn-primary btn-sm">Generar Ticket</button>
                        <div class="mt-2" id="ticketInfo"></div>
                        <div id="ticketContainer" style="display: none;">
                            <canvas id="qrCodeCanvas"></canvas>
                            <p id="ticketDetails"></p>
                            <button id="downloadTicketButton" class="btn btn-success btn-sm">Descargar Ticket</button>
                            <button id="emailTicketButton" class="btn btn-info btn-sm btn-sm">Enviar por correo</button>

                            <div id="emailForm" style="display: none;" class="py-2">
                                <input class="form-control" type="email" id="emailAddress" placeholder="Correo electrónico">
                                <div class="mt-1">
                                    <button id="sendEmailButton" class="btn btn-dark btn-sm">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nuevo código para el comentario -->
                    <button id="commentButton" class="btn btn-primary btn-sm">Dejar comentario</button>
                    <div id="commentSection" class="my-2" style="display: none;">
                        <textarea id="commentText" placeholder="Escribe tu comentario" class="form-control"></textarea>
                        <div class="mt-1">
                            <button id="submitCommentButton" class="btn btn-dark btn-sm">Enviar comentario</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Mensaje para cuando el modal da el error -->
    <div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="forModalError" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Error de autenticación</h4>
                    <p>Usuario no encontrado. Por favor, verifique sus datos e intente nuevamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modals para el Formulario -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Script Formulario de Tickets -->
    <script>
        $(document).ready(function() {
            // Inicializaciones
            emailjs.init("YOUR_EMAILJS_USER_ID");

            // Lista de códigos de alumnos y sus documentos de identidad
            const alumnos = {
                '20210001': '12345678',
                '20210002': '87654321',
                '20210003': '11223344',
                '20210004': '11111111',
                '20210005': '22222222',
                '20210006': '33333333',
                '20210007': '22223333',
                '2020103944': '76640497',
                '2020101059': '70091431',
                '2020102457': '71319225',
            };

            let ticketsAvailable = 100; // cantidad de tickets disponibles
            const generatedTickets = {};
            const submittedComments = {}; // Asegúrate de inicializar esto para comentarios

            function generateTicketCode() {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let code = '';
                for (let i = 0; i < 5; i++) {
                    code += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                return code;
            }

            function updateTicketAvailability() {
                $('#availableTickets').text(`Tickets disponibles: ${ticketsAvailable}`);
            }

            function generateQRCode(text) {
                QRCode.toCanvas(document.getElementById('qrCodeCanvas'), text, function(error) {
                    if (error) console.error(error);
                    $('#qrCodeCanvas').show(); // Mostrar el canvas del código QR
                });
            }

            $('#loginForm').submit(function(event) {
                event.preventDefault();
                resetModal();

                const codigo = $('#codigo').val();
                const dni = $('#dni').val();

                if (alumnos[codigo] && alumnos[codigo] === dni) {
                    if (generatedTickets[codigo]) {
                        $('#ticketInfo').html('<p>Ya has generado un ticket. Código: ' + generatedTickets[codigo] + '</p>');
                        $('#generateTicketButton').hide();
                    } else {
                        $('#ticketInfo').html('');
                        $('#generateTicketButton').show();
                    }
                    updateTicketAvailability();
                    $('#modalSuccess').modal('show');
                } else {
                    $('#modalError').modal('show');
                }
            });

            $('#generateTicketButton').click(function() {
                const codigo = $('#codigo').val();

                if (ticketsAvailable > 0 && !generatedTickets[codigo]) {
                    const ticketCode = generateTicketCode();
                    const timestamp = new Date().toLocaleString();
                    generatedTickets[codigo] = ticketCode;
                    ticketsAvailable--;
                    $('#ticketInfo').html('<p>Tu ticket ha sido generado exitosamente.</p>');
                    $('#ticketDetails').html(`
                        <p>Código del Ticket: ${ticketCode}</p>
                        <p>Código de Estudiante: ${codigo}</p>
                        <p>Hora de Generación: ${timestamp}</p>
                    `);
                    generateQRCode(ticketCode);
                    $('#ticketContainer').show();
                    updateTicketAvailability();
                } else {
                    $('#ticketInfo').html('<p>Cupos vacíos.</p>');
                }
            });

            $('#downloadTicketButton').click(function() {
                html2canvas(document.getElementById('ticketContainer')).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'ticket.png';
                    link.href = canvas.toDataURL();
                    link.click();
                });
            });

            $('#emailTicketButton').click(function() {
                $('#emailForm').toggle();
            });

            $('#sendEmailButton').click(function() {
                const email = $('#emailAddress').val();
                const ticketDetails = $('#ticketDetails').text();
                const qrCodeDataURL = document.getElementById('qrCodeCanvas').toDataURL();

                const templateParams = {
                    to_email: email,
                    ticket_details: ticketDetails,
                    qr_code: qrCodeDataURL
                };

                emailjs.send('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', templateParams)
                    .then(function(response) {
                        console.log('SUCCESS!', response.status, response.text);
                    }, function(error) {
                        console.log('FAILED...', error);
                    });
            });

            // Mostrar la sección de comentarios
            $('#commentButton').click(function() {
                $('#commentSection').toggle(); // Muestra u oculta la sección de comentarios
            });

            // Manejar el envío de comentarios
            $('#submitCommentButton').click(function() {
                const comment = $('#commentText').val();
                const codigo = $('#codigo').val(); // Obtener el código del alumno

                if (comment) {
                    if (!submittedComments[codigo]) { // Verifica si ya se ha dejado un comentario
                        const commentElement = `<p>${comment}</p>`;
                        $('#commentsContainer').append(commentElement);
                        $('#commentText').val('');
                        $('#commentSection').hide();
                        submittedComments[codigo] = true; // Marca que el alumno ya dejó un comentario
                    } else {
                        alert("Ya has dejado un comentario."); // Mensaje de advertencia
                    }
                } else {
                    alert("Por favor, escribe un comentario."); // Mensaje si el campo está vacío
                }
            });
        });

        function resetModal() {
            $('#ticketInfo').html('');
            $('#ticketDetails').html('');
            $('#qrCodeCanvas').hide();
            $('#generateTicketButton').show();
            $('#ticketContainer').hide();
            $('#commentSection').hide();
            $('#commentText').val('');
            $('#emailForm').hide();
            $('#emailAddress').val('');
            $('#availableTickets').text('');
        }
    </script>
    <!-- Fin Script Formulario de Tickets -->
</body>

</html>