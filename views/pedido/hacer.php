<?php if(isset($_SESSION['identity'])):?>
    <h1 class="main__title">Realizar pedido</h1>
    <a class="button" href="<?=base_url?>carrito/index">Volver al carrito</a>

    <h3 class="central__title">Dirección de entrega:</h3>
    <form action="<?=base_url.'pedido/add'?>" method="POST">
        <label class="form__label" for="provincia">Provincia</label>
        <input class="form__input" type="text" name="provincia" required>

        <label class="form__label" for="localidad">Localidad</label>
        <input class="form__input" type="text" name="localidad" required>

        <label class="form__label" for="direccion">Dirección</label>
        <input class="form__input" type="text" name="direccion" required>
        <br>
        <input type="submit" value="Confirmar pedido">
    </form>

<?php else:?>
    <h1 class="main__title">Necesitas identificarte!</h1>
    <p>Necesitas estar logueado en la página para realizar tu pedido.</p>
<?php endif;?>