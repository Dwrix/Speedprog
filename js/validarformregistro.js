$(document).ready(function() {

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        },
        "Porfavor verifica tu RUT."
    );
    $("#form-registro").validate({

        rules:{

            rut1 :{
                required: true,
                regex : /\b[0-9|.]{1,10}\-[K|k|0-9]/,
               // minlength : 9,
                maxlength: 12
            },
            
            nom1 : {
                required: true,
                minlength: 3
            },
            date :{
                required: true
            },

            direccion :{
                required: true,
                minlength : 6
            },

            correo :{
                required: true,
                email: true
            },

            pais :{
                required: true
            },
            pass1 :{
                required: true
            },
            passCon1 :{
                required: true
            },

            
           
        },
        messages :{
            nom1 : {
                required: "Porfavor llena este campo",
                minlength: "Debe tener al menos 3 Caracteres"
            } ,
            correo :{
                required: "Coloca un email",
                email: "Coloca un formato correcto"
            },
            
            rut :{
                required: "Porfavor coloca tu RUT",
                maxlength: "Porfavor verifica tu RUT."
            },
            direccion :{
                required: "Coloca tu direccion",
                minlength : "Debe contener al menos 6 caracteres"
            },
           
            pais :{
                required: "Selecciona un pais Porfavor"
            },
            pass1 :{
                required: "ingrese contraseña"
            },
            passCon1 :{
                required: "Confirme la contraseña"
            }
            
            
        }

    });
  });