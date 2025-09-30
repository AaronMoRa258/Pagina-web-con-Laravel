<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
        <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="{{ asset('CSS/login.css')}}" rel="stylesheet" />
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Animes</title>
    </head>
    <body>
        <div class="Wrapper">
            <div class="Login-Wrapper">
                <div class="Login-Header">Cambiar Contraseña</div>
                <h5 class="Information text-center">Ingrese el correo con el que registro en nuestra página <br> para poder enviarle un codigo de verificación de identidad.</h5>
                <div class="Login-Form">
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese su correo registrado" data-bs-toggle="tooltip" id="Email" required type="email">
                        <label class="Label" for="Email">Email</label>
                        <i class="bi bi-envelope-fill Icon" id="Email-Icon"></i>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Login" type="submit" value="Enviar Codigo">
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    </body>
</html>