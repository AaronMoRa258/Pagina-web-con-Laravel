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
        <form action="{{ route('user_store') }}" class="Wrapper" method="POST">
            @csrf

            <div class="Login-Wrapper">
                <div class="Login-Header">Registrarse</div>
                <h5 class="Information text-center">Favor de llenar el formulario para <br> poder registrarse.</h5>
                <div class="Login-Form">
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese un nombre de usuario" data-bs-toggle="tooltip" id="User" name="User" onfocus="Hide_Toogle(1)" required type="text">
                        <label class="Label" for="User">Usuario</label>
                        <i class="bi bi-person-fill Icon" id="User-Icon"></i>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese un correo" data-bs-toggle="tooltip" id="Email" name="Email" onfocus="Hide_Toogle(2)" required type="email">
                        <label class="Label" for="Email">Email</label>
                        <i class="bi bi-envelope-fill Icon" id="Email-Icon"></i>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese una contraseña [a-z,A-Z,0-9]" data-bs-toggle="tooltip" id="Password" name="Password" onfocus="Hide_Toogle(3)" required type="password">
                        <label class="Label" for="Password">Contraseña</label>
                        <i class="bi bi-lock-fill Icon" id="Password-Icon"></i>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Login" onclick="Check_Inputs()" type="submit" value="Registarme">
                    </div>
                    <div class="Login-Register text-center">
                        <span>Ya tienes una cuenta: <a href="/login">Iniciar Sesión</a></span>
                    </div>
                </div>
            </div>
        </form>

        <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
        <script>
            const Email = document.getElementById('Email');
            const Email_Icon = document.getElementById('Email-Icon');
            const Email_Tooltip = new bootstrap.Tooltip(Email, {placement: 'right', trigger: 'manual'});
            const Password = document.getElementById('Password');
            const Password_Icon = document.getElementById('Password-Icon');
            const Password_Tooltip = new bootstrap.Tooltip(Password, {placement: 'right', trigger: 'manual'});
            const User = document.getElementById('User');
            const User_Icon = document.getElementById('User-Icon');
            const User_Tooltip = new bootstrap.Tooltip(User, {placement: 'right', trigger: 'manual'});
            
            function Check_Inputs() {
                if (Email.value == "") {
                    Email.style.borderColor = 'rgb(220, 0, 0)';
                    Email_Icon.style.color = 'red';
                    Email_Tooltip.show();
                }

                if (Password.value == "") {
                    Password.style.borderColor = 'rgb(220, 0, 0)';
                    Password_Icon.style.color = 'red';
                    Password_Tooltip.show();
                }

                if (User.value == "") {
                    User.style.borderColor = 'rgb(220, 0, 0)';
                    User_Icon.style.color = 'red';
                    User_Tooltip.show();
                }
            }

            function Hide_Toogle(Element) {
                switch (Element) {
                    case 1: 
                        User_Tooltip.hide();
                        break;
                    case 2:
                        Email_Tooltip.hide();
                        break;
                    case 3:
                        Password_Tooltip.hide();
                        break;
                }
            }

            
        </script>

    </body>
</html>