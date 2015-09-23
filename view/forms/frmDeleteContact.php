<form name="frmDeleteContact" action="/addressBook/controller/main.controller.php" method="POST">
    <ul class="form-list ul-frm-v2">
        <li>
            <input type="radio" name="radio-filter" class="radbtn" value="name" checked="">
            <i class="form-i fa fa-user fa-2x"></i>
            <input type="text" class="txt-field main-txt search-box" name="txtName" placeholder="Nombres" autofocus>
        </li>
        <li>  
            <input type="radio" name="radio-filter" class="radbtn" value="phone">
            <i class="form-i fa fa-phone fa-2x"></i>
            <input type="tel" class="txt-field main-txt search-box" name="txtPhone" placeholder="Teléfono">
        </li>
        <li class="li-btn">
            <button class="form-btn" type="submit" name="btnSearch" value="search">Buscar</button>
            <button class="form-btn" type="reset" name="btnSend" value="cancel">Limpiar</button>
        </li>
    </ul>
</form>
