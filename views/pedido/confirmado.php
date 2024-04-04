<?php if ($_SESSION['pedido'] && $_SESSION['pedido'] == 'complete') : ?>

<?php Utils::deleteSession('carrito')?>
    <h1 class="main__title">Tu pedido se ha confirmado</h1>
    <p>
        Tú pedido ha sido guardado con éxito, una vez que realices el pago a la cuenta XXXXXXXXXX y sea confirmado, será enviado!!
    </p>
    <br>

    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>

        Número de pedido: <?= $pedido->id; ?> <br>
        Total a pagar: <?= $pedido->coste; ?> <br>
        Productos:
        <br>
        <br>
        <table class="table">
        <tr class="table__tr">
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub-total</th>
        </tr>
        <?php while ($producto = $productos->fetch_object()) : ?>

            <tr class="table__tr">
                <td class="table__td--carrito">
                    <?php if ($producto->imagen != null) : ?>
                        <img class="img__carrito" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" />
                    <?php else : ?>
                        <img class="img__carrito" src="<?= base_url ?>assets/img/world.png" />
                    <?php endif; ?>
                </td>

                <td class="table__td--carrito">
                    <a class="link__carrito" href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"> <?= $producto->nombre ?> </a>
                </td>

                <td class="table__td--carrito">
                    <?= $producto->precio ?>
                </td>

                <td class="table__td--carrito">
                    <?= $producto->unidades; ?>
                </td>

                <td class="table__td--carrito">
                    <?= $producto->unidades*$producto->precio; ?>
                </td>

            </tr>
        <?php endwhile; ?>
        </table>
    <?php endif; ?>

<?php elseif ($_SESSION['pedido'] && $_SESSION['pedido'] == 'failed') : ?>
    <h1 class="main__title">Tu pedido NO ha podido procesarse...</h1>
<?php endif ?>