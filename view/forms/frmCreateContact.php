<form name="frmCreateContact" action="/addressBook/controller/main.controller.php" method="POST" autocomplete="off">
    <ul class="form-list form-rows">
        <li>
            <i class="form-i fa fa-user fa-2x"></i>
            <input type="text" class="txt-field main-txt" name="txtName" placeholder="Nombres" required>
        </li>
        <li>
            <i class="form-i fa fa-user fa-2x"></i>
            <input type="text" class="txt-field main-txt" name="txtLastName" placeholder="Apellidos">
        </li>
        <li>
            <i class="form-i fa fa-phone fa-2x"></i>
            <input type="tel" class="txt-field main-txt" name="txtPhone" placeholder="Teléfono" required>
        </li>
        <li>
            <i class="form-i fa fa-mobile fa-2x"></i>
            <input type="tel" class="txt-field main-txt" name="txtMobile" placeholder="Celular">
        </li>
        <li>
            <i class="form-i fa fa-at fa-2x"></i>
            <input type="email" class="txt-field main-txt" name="txtEmail" placeholder="Correo electrónico">
        </li>
        <li>
            <i class="form-i fa fa-map-marker fa-2x"></i>
            <input type="text" class="txt-field main-txt" name="txtAddress" placeholder="Dirección">
        </li>
        <li>
            <i class="form-i fa fa-calendar fa-2x"></i>
            <input type="date" class="txt-field main-txt" name="txtBirthday" placeholder="Cumpleaños">
        </li>
        <li class="li-btn">
            <button class="form-btn" type="submit" name="btnCreate" value="create">Guardar</button>
            <button class="form-btn" type="reset" name="btnClear" value="cancel">Limpiar</button>
        </li>
    </ul>
</form>
