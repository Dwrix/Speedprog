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
               // regex : /\b[0-9|.]{1,10}\-[K|k|0-9]/,
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
                required: "Porfavor coloca tu Número Identificador",
                //maxlength: "Porfavor verifica tu RUT."
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

  $('#pass').keyup(function(e) {
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{6,}).*", "g");
    if (false == enoughRegex.test($(this).val())) {
            $('#passstrength').html('La contraseña debe tener más de 6 caracteres.');
    } else if (strongRegex.test($(this).val())) {
            //caracter especial, numeros, y mayus
            $('#passstrength').className = 'ok';
            $('#passstrength').html('Contraseña Fuerte');
    } else if (mediumRegex.test($(this).val())) {
            //numeros, y mayus
            $('#passstrength').className = 'alert';
            $('#passstrength').html('Contraseña Media');
    } else {
            //solo letras
            $('#passstrength').className = 'error';
            $('#passstrength').html('Contraseña Débil');
    }
    return true;
});