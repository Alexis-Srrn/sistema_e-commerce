<h1 class="central__title">Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
        <script>
            Swal.fire({
            title: "Usuario agregado con éxito",
            icon: "success"
            });
        </script>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'):?>
    
    
    <script>
            Swal.fire({
            title: "Registro fallido",
            text: "<?=$_SESSION['error']?>",
            icon: "error"
            });
    </script>
    
<?php endif?>
<?php $_SESSION['error'] = '';?>
<?php Utils::deleteSession('register');?>

<form action="<?=base_url?>usuario/save" method="POST">
    <label class="form__label" for="nombre">Nombre</label>
    <input class="form__input" type="text" name="nombre" id="nombre" required>

    <label class="form__label" for="apellidos">Apellidos</label>
    <input class="form__input" type="text" name="apellidos" id="apellidos" required>

    <label class="form__label" for="email">Email</label>
    <input class="form__input" type="email" name="email" id="email" required>

    <label class="form__label" for="password">Contraseña</label>
    <input class="form__input" type="password" name="password" id="password" required>

    <input type="submit" value="Registrarse">
</form>

