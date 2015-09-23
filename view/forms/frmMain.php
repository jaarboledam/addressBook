<?php
include 'layout.php';
session_start();
if(empty($_SESSION['login'])){
    header("Location: /addressBook/index.php");
}
?>
<body id="main">
    <header>
        <h1 class="main-title">Contactos</h1>
    </header>
    <section id="main-tabs">
        <nav>
            <ul class="form-list" id="main-menu">
                <li>
                    <a class="tab-menu menu-selected" id="create">
                        <i class="main-i fa fa-plus i-active"></i>
                        <h4>Agregar</h4>
                    </a>
                </li>
                <li>
                    <a class="tab-menu" id="read">
                        <i class="main-i fa fa-search"></i>
                        <h4>Buscar</h4>
                    </a>
                </li>
                <li>
                    <a class="tab-menu" id="update">
                        <i class="main-i fa fa-pencil"></i>
                        <h4>Editar</h4>
                    </a>
                </li>
                <li>
                    <a class="tab-menu" id="delete">
                        <i class="main-i fa fa-trash"></i>
                        <h4>Eliminar</h4>
                    </a>
                </li>
                <li class="signOut">
                    <a href="/addressBook/model/logout.php">
                        <i class="fa fa-times-circle fa-2x" title="Cerrar Sesión"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <article class="tab" id="tab-create">
            <?php include 'frmCreateContact.php'; ?>
        </article>
        <article class="tab" id="tab-read">
            <?php include 'frmSearchContact.php'; ?>
        </article>
        <article class="tab" id="tab-update">
            <?php include 'frmUpdateContact.php'; ?>
        </article>
        <article class="tab" id="tab-delete">
            <?php include 'frmDeleteContact.php'; ?>
        </article>
    </section>
</body>

