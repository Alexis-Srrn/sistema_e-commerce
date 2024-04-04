<?php if(isset($_SESSION['producto_creado']) && $_SESSION['producto_creado'] == 'complete'):?>
        <script>
            Swal.fire({
            title: "Producto creado con éxito",
            icon: "success"
            });
        </script>
<?php elseif(isset($_SESSION['producto_creado']) && $_SESSION['producto_creado'] == 'failed'):?>
    
    
    <script>
            Swal.fire({
            title: "Registro de producto fallido",
            text: "<?=$_SESSION['producto_error']?>",
            icon: "error"
            });
    </script>
    
<?php endif?>


<?php if(isset($_SESSION['producto_eliminado']) && $_SESSION['producto_eliminado'] == 'complete'):?>
    <script>
            Swal.fire({
            title: "Producto eliminado con éxito",
            icon: "success"
            });
    </script>
<?php elseif(isset($_SESSION['producto_eliminado']) && $_SESSION['producto_eliminado'] == 'failed'):?>
    <script>
            Swal.fire({
            title: "No se pudo eliminar el producto!!!",
            text: "<?=$_SESSION['producto_error']?>",
            icon: "error"
            });
    </script>
<?php endif?>



<?php $_SESSION['producto_error'] = '';?>
<?php Utils::deleteSession('producto_creado');?>
<?php Utils::deleteSession('producto_eliminado');?>






<h1 class="main__title">Gestion de productos</h1>


<a href="<?=base_url?>producto/crear" class="button">Crear producto</a>

<table class="table">
    <tr class="table__tr">
        <th class="table__th">ID</th>
        <th class="table__th">Nombre</th>
        <th class="table__th">Precio</th>
        <th class="table__th">Stock</th>
        <th class="table__th">Acciones</th>
    </tr>
    <?php while($pro = $productos->fetch_object()): ?>
        <tr class="table__tr">
            <td class="table__td"><?=$pro->id;?></td>
            <td class="table__td"><?=$pro->nombre;?></td>
            <td class="table__td"><?=$pro->precio;?></td>
            <td class="table__td"><?=$pro->stock;?></td>
            <td class="table__td">
                <a class="button_edit" href="<?=base_url?>producto/editar&id=<?=$pro->id?>">Editar</a>
                <a class="button_delete" href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>">Eliminar</a>            
            </td>
        </tr>
    <?php endwhile; ?>
</table>