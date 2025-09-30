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
        <form action="{{ route('login_Submit') }}" class="Wrapper" method="POST">
            @csrf
            
            <div class="Login-Wrapper">
                <div class="Login-Header">Iniciar Sesión</div>
                <h5 class="Information text-center">Ingrese su informacion de usuario para acceder <br> a su perfil.</h5>
                <div class="Login-Form">
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese su usuario" data-bs-toggle="tooltip" id="User" name="User" onfocus="Hide_Toogle(1)" required type="text">
                        <label class="Label" for="User">Usuario</label>
                        <i class="bi bi-person-fill Icon" id="User-Icon"></i>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Field" data-bs-title="Por favor, ingrese su contraseña" data-bs-toggle="tooltip" id="Password" name="Password" onfocus="Hide_Toogle(2)" required type="password">
                        <label class="Label" for="Password">Contraseña</label>
                        <i class="bi bi-lock-fill Icon" id="Password-Icon"></i>
                    </div>
                    <div class="Login-Check">
                        <div class="Remember">
                            <input id="Remember-Me" type="checkbox">
                            <label for="Remember-Me">Recordarme</label>
                        </div>
                        <div class="Forgot">
                            <a href="/Forgot_Password">Olvide mi contraseña</a>
                        </div>
                    </div>
                    <div class="Input-Wrapper">
                        <input class="Input-Login" onclick="Check_Inputs()" type="submit" value="Iniciar Sesión">
                    </div>
                    <div class="Login-Register text-center">
                        <span>No tienes una cuenta: <a href="{{ route('register') }}">Registrate</a></span>
                    </div>
                </div>
            </div>
        </form>

        <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
        <script>
            const Password = document.getElementById('Password');
            const Password_Icon = document.getElementById('Password-Icon');
            const Password_Tooltip = new bootstrap.Tooltip(Password, {placement: 'right', trigger: 'manual'});
            const User = document.getElementById('User');
            const User_Icon = document.getElementById('User-Icon');
            const User_Tooltip = new bootstrap.Tooltip(User, {placement: 'right', trigger: 'manual'});
            
            function Check_Inputs() {
                if (Password.value == '') {
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
                        Password_Tooltip.hide();
                        break;
                }
            }
        </script>
    </body>
</html>