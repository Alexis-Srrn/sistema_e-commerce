<aside id="lateral" class="lateral">
    <div id="login" class="lateral__login">

    <?php if(isset($_SESSION['error_login'])):?>
        <script>
            Swal.fire({
            title: "Registro fallido",
            text: "<?=$_SESSION['error_login']?>",
            icon: "error"
            });
    </script>
    <?php unset($_SESSION['error_login']);?>
    <?php endif ?>

    <h3 class="lateral__title">Mi carrito</h3>
    <ul class="lateral__lista">
        <?php $stats = Utils::statsCarrito();?>
        <li class="lista__link"><a href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li>
        <li class="lista__link"><a href="<?=base_url?>carrito/index">Total:  $<?=$stats['total']?></a></li>
        <li class="lista__link"><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
    </ul>

    <?php if(!isset($_SESSION['identity'])): ?>
        <h3 class="lateral__title">Entrar al sitio</h3>
        <form action="<?=base_url?>usuario/login" method="post">
            <label class="form__label" for="email">Email</label>
            <input class="form__input" type="email" name="email" />
            <label class="form__label" for="password">Contraseña</label>
            <input class="form__input" type="password" name="password" />

            <input type="submit" value="Enviar">
        </form>
        
        <?php else: ?>
            <h3 class="lateral__title">Bienvenido <?=$_SESSION['identity']->nombre?></h3>
        <?php endif;?>
        <ul class="lateral__lista">
            <?php if(isset($_SESSION['admin'])):?>
                <li class="lista__link"><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
                <li class="lista__link"><a href="<?=base_url?>producto/gestion">Gestionar productos</a></li>
                <li class="lista__link"><a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
            <?php endif;?>
            
            <?php if(isset($_SESSION['identity'])):?>
                <li class="lista__link"><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
                <li class="lista__link"><a href="<?=base_url?>usuario/logout">Cerrar Sesión</a></li>
            <?php else:?>
                <li class="lista__link lista__register"><a href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
            <?php endif;?>
        </ul>
    </div>
</aside>
<div id="central" class="central">