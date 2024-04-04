<?php if(isset($gestion)):?>
    <h1 class="main__title">Gestionar pedidos</h1>
<?php else: ?>
    <h1 class="main__title">Mis pedidos</h1>
<?php endif;?>

<table class="table">
    <tr class="table__tr">
        <th>No. de Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php while($ped = $pedidos->fetch_object()):  ?>
    <tr class="table__tr">
        <td class="table__td--carrito">
           <a href="<?=base_url?>pedido/detalle&id=<?=$ped->id;?>"><?=$ped->id;?></a> 
        </td>

        <td class="table__td--carrito">
            $<?=$ped->coste;?>
        </td>

        <td class="table__td--carrito">
            <?=$ped->fecha;?>
        </td>

        <td class="table__td--carrito">
            <?=Utils::showStatus($ped->estado);?>
        </td>
       
    </tr>
    <?php endwhile;?>
</table>
