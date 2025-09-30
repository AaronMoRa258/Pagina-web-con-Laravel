<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/histories.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include('partials/header')
    @include('partials/nav')

    <section class="mx-4" id="Main">
        <div class="Toolbar">
            <button onclick="Classes('Normal')">Normal</button>
            <button onclick="Classes('Actions')">Acciones</button>
            <button onclick="Classes('Narration')">Narrador</button>
            <button onclick="format()">Dar Formato</button>
            <button data-bs-target="#Add-Character" data-bs-toggle="modal">Agregar Personaje</button>

            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="Add-Character" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" id="Info-Character">
                        <div class="modal-header">
                            <h1 class="fs-5 modal-title" id="exampleModalLabel">Agregar Personaje</h1>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label" for="Name-Character">Nombre Personaje: </label>
                            <input class="form-control" id="Name-Character" type="text">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" onclick="Add_Character()" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Characters gap-2">
                <div class="btn-group">
                    <button aria-expanded="false" class="btn btn-secondary dropdown-toggle-split List" data-bs-toggle="dropdown" id="Main-Character" type="button">
                        <i class="bi bi-plus-circle p-1"></i> Personajes
                    </button>
                    <button aria-expanded="false" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" id="Dropdown-List" type="button"></button>
                    <ul class="dropdown-menu List-Characters p-1" id="List-Characters"></ul>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-4" id="Secondary">
        <div contenteditable="true" id="Content"></div>
    </section>

    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/Main.js')}}"></script>
    <script src="{{ asset('JS/Scripts.js')}}"></script>
    <script>
        const Content = document.getElementById("Content");

        let Selection = window.getSelection();

        // Se encarga de agregar personaje a la lista de personajes
        function Add_Character() {
            const Input = document.getElementById("Name-Character");
            const List_Characters = document.getElementById("List-Characters");

            List_Characters.innerHTML += `<li class="dropdown-item Character p-2" onclick="Write_Character('${Input.value}')"><i class="bi bi-dot pe-2"></i>${Input.value}</li>`
            Input.value = "";
        }

        // Agrega clase basica al elemento seleccionado (Narrartion, Normal)
        function Add_Basic_Class(Class, Other, Container, Container_Class) {
            // Verifica si ya tiene una clase el elemento
            if (Container_Class == "") {
                Container.classList.add(Class);
            } else if (Container_Class.includes(Other)) {
                Container.classList.toggle("Normal");
                Container.classList.toggle("Narration");
            }
        }

        // Verifica las clases que tiene el contenedor seleccionado
        function Check_Class_Container(Single_Container, Class, Container, Container_Class, Range) {
            // Verifica si el elemento ya tiene la clase seleccionada
            if (Container_Class.includes(Class)) {
                Remove_Class(Class, Container);
                return;
            }

            // Verifica el tipo de clase a agregar
            switch (Class) {
                case "Actions": 
                    if (!Single_Container) {
                        return;
                    }

                    if (Container_Class.includes("Normal")) {
                        let End_Selection = Range.endOffset;
                        let Start_Selection = Range.startOffset;
                        let Cad_Selected = Container.innerText.substring(Start_Selection, End_Selection);

                        let Index = Content.innerHTML.indexOf(Cad_Selected);
                        let Cad_End = Content.innerHTML.substring(Index + Cad_Selected.length);
                        let Cad_Start = Content.innerHTML.slice(0, Index);

                        Content.innerHTML = Cad_Start + `<span class='${Class}'>` + Cad_Selected + "</span>" + Cad_End;
                    }

                    break;
                case "Narration":
                    Add_Basic_Class(Class, "Normal", Container, Container_Class);
                    break;
                default:
                    Add_Basic_Class(Class, "Narration", Container, Container_Class);
                    break;
            }
        }

        function Classes(Class) {
            let Range = Selection.getRangeAt(0);
            let Childs = Range.commonAncestorContainer.childNodes;
            let Container_End = Range.endContainer;
            let Container_Start = Range.startContainer;
            let Container_Start_Classes = Container_Start.parentElement.classList.value;

            // Verifica si la seleccion abarca 1 o 2 contenedores
            if (Container_Start === Container_End) {
                Check_Class_Container(true, Class, Container_Start.parentElement, Container_Start_Classes, Range);
            } else {
                let Index_Start = Array.prototype.indexOf.call(Childs, Container_Start.parentElement);
                let Index_End = Array.prototype.indexOf.call(Childs, Container_End.parentElement);
                
                for (let i = Index_Start; i <= Index_End; i++) {                   
                    Check_Class_Container(false, Class, Childs[i], Childs[i].classList.value, Range);
                }
            }
        }

        function format() {
            let List_Paragraph = [];
            let New_Cad = "";

            if (Content.innerHTML.includes("<div>")) {
                List_Paragraph = Content.innerHTML.split("<div>");
            } else {
                List_Paragraph = Content.innerHTML.split("<p>");
            }

            List_Paragraph.forEach(Paragraph => {
                if (Paragraph != "") {
                    Paragraph = Paragraph.replace("</p>", "");
                    New_Cad += "<p>" + Paragraph + "</p>";
                }
            });

            Content.innerHTML = New_Cad;
        }

        // Remueve clase para el elemento indicado
        function Remove_Class(Class, Container) {
            Container.classList.toggle(Class);

            // Verifica si el contenido esta o no dentro de etiqueta span (seccion de parrafo afectado por la clase)
            if (Container.outerHTML.includes("span")) {
                let Cad = Container.outerHTML;
                let Index = Content.innerHTML.indexOf(Cad);
                let Cad_End = Content.innerHTML.substring(Index + Cad.length);
                let Cad_Start = Content.innerHTML.slice(0, Index);

                Content.innerHTML = Cad_Start + Container.innerHTML + Cad_End;
            }
        }

        // Agrega personaje seleccionado al contenedor
        function Write_Character(Character) {
            Content.innerHTML = Content.innerHTML.replace("<br>", "");
            Content.innerHTML += Character + ":";
        }

        Check_Auth(Icon_User);
    </script>
</body>
</html>
