<form name="frmUpdateContact" action="/mvc_project1/controller/main.controller.php" method="POST">
    <ul class="form-list ul-frm-v2">
        <li>
            <input type="radio" name="radio-update" value="name" checked="">
            <i class="form-i fa fa-user fa-2x"></i>
            <input type="text" class="txt-field main-txt search-box" name="txtName" placeholder="Nombres" autofocus>
        </li>
        <li>  
            <input type="radio" name="radio-update" value="phone">
            <i class="form-i fa fa-phone fa-2x"></i>
            <input type="tel" class="txt-field main-txt search-box" name="txtPhone" placeholder="Teléfono">
        </li>
        <li class="li-btn">
            <button class="form-btn" type="submit" name="btnSearch" value="search">Buscar</button>
            <button class="form-btn" type="reset" name="btnSend" value="cancel">Limpiar</button>
        </li>
    </ul>
</form>
<nav class="table-menu">
    <ul class="form-list toolbar">
        <li class="close-table" id="edit-close"><i class="fa fa-times-circle"></i>Cerrar</li>
        <li class="save-table"><i class="fa fa-floppy-o"></i>Guardar</li>
    </ul>
</nav>
<div class="result-view" id="edit-view">
    <table class="table-view" id="edit-table">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Celular</th>
                <th>Correo electrónico</th>
                <th>Dirección</th>
                <th>Cumpleaños</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
