<?php include 'layout.php'; ?>
<body id="login">
    <header class="login-header">
        <h1 class="project-title">Address Book</h1>
    </header>
    <article class="login-panel">
        <form id="login-form" name="frmLogin" action="/addressBook/controller/login.controller.php" method="POST">
            <div id="login-form-container">
                <h1 id="login-title">Iniciar Sesión</h1>
                <ul class="form-list">
                    <li class="li-txt">
                        <i class="log-i fa fa-user fa-2x"></i>
                        <input type="text" class="txt-field" name="txtUser" placeholder="Username" autocomplete="off" required>
                    </li>
                    <li class="li-txt">
                        <i class="log-i fa fa-unlock-alt fa-2x"></i>
                        <input type="password" class="txt-field" name="txtPwd" placeholder="Password" required>
                    </li>
                    <li class="li-btn">
                        <button name="btnLogin" type="submit" value="btnLogin" id="btnLogin">Entrar</button>
                    </li>
                </ul>
            </div>
        </form>
        <div class="msgBox" id="login-msgBox"></div>
    </article>
</body>