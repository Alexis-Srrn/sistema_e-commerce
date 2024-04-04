<h1 class="main__title">Detalles del pedido:</h1>

<?php if (isset($pedido)) : ?>

    <?php if(isset($_SESSION['admin'])):?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="POST">
            <input type="hidden" value="<?=$pedido->id?>"  name="pedido_id"/>
            <select name="estado" id="">
                <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
                <option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
                <option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
                <option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif; ?>
        <h3>Datos del pedido:</h3>
        <br>
        Estado del pedido: <?=Utils::showStatus($pedido->estado); ?> <br>
        Número de pedido: <?= $pedido->id; ?> <br>
        Total a pagar: <?= $pedido->coste; ?> <br>
        Provincia: <?= $pedido->provincia; ?> <br>
        Ciudad: <?= $pedido->localidad; ?> <br>
        Direccion: <?= $pedido->direccion; ?> <br>
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