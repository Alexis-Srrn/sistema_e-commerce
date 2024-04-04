<?php if(empty($_SESSION['carrito'])){unset($_SESSION['carrito']);} ?>
<?php if(isset($_SESSION['carrito'])): ?>
<h1 class="main__title">Tú carrito:</h1>

<table class="table">
    <tr class="table__tr">
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach($carrito as $indice => $elemento):
        $producto = $elemento['producto'];
    ?>
    <tr class="table__tr">
        <td class="table__td--carrito">
            <?php if ($producto->imagen != null): ?>
                <img class="img__carrito" src="<?=base_url?>uploads/images/<?=$producto->imagen?>" />
            <?php else: ?>
                <img class="img__carrito" src="<?=base_url?>assets/img/world.png" />
            <?php endif;?>
        </td>

        <td class="table__td--carrito">
               <a class="link__carrito" href="<?=base_url?>producto/ver&id=<?=$producto->id?>" > <?=$producto->nombre?> </a>
        </td>

        <td class="table__td--carrito">
            <?=$producto->precio?>
        </td>

        <td class="table__td--carrito">
            <div class="up_down">
                <?php if($elemento['unidades'] < $producto->stock): ?>
                <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button__unidad">+</a>
                <?php endif; ?>
                <?=$elemento['unidades']?>
                <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button__unidad">-</a>
            </div>
        </td>

        <td class="table__td--carrito">
            <?=$producto->precio*$elemento['unidades'];?>
        </td>

        <td class="table__td--carrito">
            <a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class="button_delete">Quitar</a>
        </td>
        
    </tr>
    <?php endforeach;?>
</table>

<br>
<a href="<?=base_url?>carrito/delete_all" class="link__carrito link__compra link__compra--delete">Vaciar carrito</a>
<div class="carrito__total">
    <?php $stats = Utils::statsCarrito();?>
    <h3 class="total__carrito">Precio total: $<?=$stats['total']?></h3>
    <a href="<?=base_url?>pedido/hacer" class="link__carrito link__compra">Continuar con el pedido</a>
</div>

<?php else: ?>
    <h1 class="main__title">Ups, parece que no has agregado nada al carrito aun!!</h1>
<?php endif; ?>
