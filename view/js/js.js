$(document).ready(function () {
    //Al acceder, muestra el formulario de crear contacto
    $("#tab-create").fadeIn("slow");
    $("#login").fadeIn("slow");

    /*se ejecuta cuando se hace submit desde cualquier form*/
    $("form").submit(function (e) {
        e.preventDefault();
        var frmName = $(this).attr('name');
        var form = $("form[name=" + frmName + "]");
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        var loading = "<i class='fa fa-spinner fa-pulse'></i>";

        executeAjax(form, action, method, loading);
    });
    
    //Pone el foco sobre el nodo input hermano al radio seleccionado
    $("input[type=radio]").click(function(){
        $(this).siblings('.search-box').focus();
    });
    //Si el input obtiene el foco, pone checked el radio hermano
    $(".search-box").on('focus',function (){
        if ($(this).val() === ""){
            $(".search-box").val("");
        }
        $(this).siblings("input[type=radio]").prop('checked','true');
    });
    
    $(".search-box").keyup(function (){
        var frmName = $(this).attr('name');
        var form = $("form[name=" + frmName + "]");
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        executeAjax(form, action, method);
    });

    /*Cambiar el color al icono del formulario 
     * cuando el campo de texto toma el foco*/
    $(".txt-field").on("focus", function () {
        $(this).siblings("i").addClass("i-active");
    });
    $(".txt-field").on("blur", function () {
        $(this).siblings("i").removeClass("i-active");
    });

    /*Cambia el color al icono de la pestaña que tiene el mouseover*/
    $(".tab-menu").hover(function () {
        $(this).children("i").addClass("i-active");
    }, function () {
        if (!$(this).hasClass("menu-selected")) {
            $(this).children("i").removeClass("i-active");
        }
    });

    /*Aplica el estilo selected al boton del menu clickeado
     * y ejecuta la funcion showForm*/
    $(".tab-menu").click(function () {
        $(".tab-menu").removeClass("menu-selected");
        $(this).addClass("menu-selected");
        $("i").removeClass("i-active");
        $(this).children("i").addClass("i-active");
        showForm($(this).attr('id'));
    });
    
    /*Valida desde que tabla se presiono el botón
     * segun su id y oculta el result-view correspondiente*/
    $(".close-table").click(function() {
        switch ($(this).attr("id")){
            case "edit-close":
                $("#edit-view").hide("slow");
                $(".table-menu").hide('slow');
                break;
            case "ro-close":
                $("#ro-view").hide("slow");
                break;
        }
    });
    
    /*Obtiene los valores de la tabla de edicion y los 
     * guarda en un objeto JSON*/
    $(".save-table").click(function (){
        var rows = $("#edit-table tbody tr");
        var table_data = [];
        var tmp_obj;
        //recorrer todas las filas
        rows.each(function (){
            var cells = $(this).children("td");
            var i = 0;
            tmp_obj = {};//objeto temporal que almacena toda una fila
            //recorrer las celdas de la fila actual
            cells.each(function (){
                //poblar el objeto temporal
                if (global_keys[i]==="id"){
                    tmp_obj[global_keys[i]] = $(this).parent("tr").attr("id");
                    i++;
                }
                tmp_obj[global_keys[i]] = $(this).html();
                i++;
            }); 
            table_data.push(tmp_obj);//inserta en el arreglo el objeto temporal
        });
        //convertir arreglo en cadena JSON
        //console.log(JSON.stringify(table_data));
        saveChanges(JSON.stringify(table_data));
    });
});

/*Recibe por parametro el value de la propiedad href
 * del boton tab que haya sido presionado para mostrar 
 * el formulario correspondiente*/
function showForm(frm_name) {
    var formulario = $("#tab-" + frm_name);
    $(".tab").hide("fast");
    formulario.show("fast");
    formulario.find("input[type=text]").first().focus();
};

/*Recibe el nombre del formulario desde el que se ejecuto submit
 * por medio de ajax envia los datos del mismo al archivo 
 * especificado en la url.*/
function executeAjax(form, action, method, loading) {
    var frmName = form.attr('name');
    var btn_submit = $("form[name="+frmName+"]").find(":submit");
    var btn_default = btn_submit.html();
    $.ajax({
        beforeSend: function () {
            btn_submit.html(loading);
        },
        url: action,
        type: method,
        /*Convertir en formato json los datos del formulario
         *ejemplo -> ´{'nombre_campo':'value'}*/
        data: form.serialize()+"&form="+frmName,
        success: function (response) {
            setTimeout(function(){
                ajaxResponse(form,response);
                btn_submit.html("<i class='fa fa-check'></i>");
                setTimeout(function (){
                   btn_submit.html(btn_default); 
                }, 2000);
            }, 500);
        }
    });
};
var global_keys;//almacena las llaves del archivo JSON

/*Recibe el objeto formulario que ejecuta la funcion de ajax
 * y la respuesta de success*/
function ajaxResponse(form,response) {
    switch (form.attr('name')) {
        case "frmLogin":
            if (response){
                window.location = "/mvc_project1/view/forms/frmMain.php";
            }else{
                $("#login-form-container").effect("shake",{times:3, distance:50},400);
                alert("Nombre de usuario o contraseña incorrecta!");
            }
            break;
        case "frmCreateContact":
            alert(response);
            break;
        case "frmSearchContact":
            //Convierte la respuesta en un objeto json
            var found = jQuery.parseJSON(response);
            var idkey = null;
            if (found.length > 0) {
                var i = 0;
                var tbody = $("#ro-table > tbody");
                tbody.html("");//Limpia el cuerpo de la tabla
                //Crea la tabla con los registros encontrados
                while(i < found.length){
                    tbody.append('<tr>');
                    //Obtiene la ultima fila dentro de tbody
                    var tr = tbody.children('tr:last-child');
                    jQuery.each(found[i], function (key, val) {
                        if (key == 'id') {
                            idkey = val;
                        }else{
                            tr.append('<td>' + val + '</td>');
                        }
                    });
                    tbody.append('</tr>');
                    i++;
                };
                $("#ro-view").fadeIn('slow');
            }
            else{
                alert("El contacto no ha sido encontrado!")
            }
            break;
        case "frmUpdateContact":
            var found = jQuery.parseJSON(response);
            if (found.length > 0) {
                var keys;
                var i = 0;
                var tbody = $("#edit-table > tbody");
                tbody.html("");
                while(i < found.length){
                    tbody.append('<tr>');
                    var tr = tbody.children('tr:last-child');
                    global_keys = [];
                    jQuery.each(found[i], function (key, val) {
                        global_keys.push(key);
                        if (key == 'id') {
                            tr.attr("id",val);
                        }else{
                            tr.append('<td contenteditable="true">' + val + '</td>');
                        }
                    });
                    tbody.append('</tr>');
                    i++;
                };
                $("#edit-view").fadeIn('slow');
                $(".table-menu").fadeIn('slow');
            }
            else{
                alert("El contacto no ha sido encontrado!");
            }
            break;
        case "frmDeleteContact":
            console.log(response);
            break;
    }
};

function saveChanges(data){
    var btn_default = $(".save-table").html();
    $.ajax({
        beforeSend: function () {
            $(".save-table").html("<i class='fa fa-spinner fa-pulse'></i>Guardando...");
        },
        type: 'POST',
        url: "/mvc_project1/controller/main.controller.php",
        data: "form=frmExecUpdate&data="+data,
        success: function (response) {
            setTimeout(function(){
                $(".save-table").html("<i class='fa fa-check' style='color:green;'></i>");
                setTimeout(function (){
                   $(".save-table").html(btn_default);
                }, 2000);
                alert(response);
            }, 500);
        },
        error: function (textStatus, errorThrown) {
            alert("ERROR!\n"+textStatus+errorThrown);
        }
    });
}

/*Funcion especifica para el comportamiento de los iconos
 * que hacen de radio en la tabla de edicion*/
/*function radios() {
    var table_row = $(".table-view tr");
    var rad_icon = $(".radio-select > i");
    
    table_row.children().on('mouseover', function () {
        $(this).parent().addClass("active-tr");
    });
    table_row.children().on('mouseout', function () {
        $(this).parent().removeAttr("class");
    });
    
    table_row.on('click',function (){
        var item = $(this).find(".rad");
        
        if (item.hasClass("fa-check-circle")) {
            item.removeClass("fa-check-circle");
        } else {
            $(".radio-select i").removeClass("fa-check-circle");
            item.removeClass("fa-circle");
            $(".radio-select i").addClass("fa-circle-o");
            item.removeClass("fa-circle-o");
            item.addClass("fa-check-circle");
        }
    });

    rad_icon.on('mouseover', function() {
        if (!$(this).hasClass("fa-check-circle")) {
            $(this).removeClass("fa-circle-o");
            $(this).addClass("fa-circle");
        }
    });
    rad_icon.on('mouseout', function() {
        if (!$(this).hasClass("fa-check-circle")) {
            $(this).removeClass("fa-circle");
            $(this).addClass("fa-circle-o");
        }
    });
}*/
                            
                         