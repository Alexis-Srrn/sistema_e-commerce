<?php if(isset($_SESSION['categoria_creada']) && $_SESSION['categoria_creada'] == 'complete'):?>
        <script>
            Swal.fire({
            title: "Categoría creada con éxito",
            icon: "success"
            });
        </script>
<?php elseif(isset($_SESSION['categoria_creada']) && $_SESSION['categoria_creada'] == 'failed'):?>
    
    
    <script>
            Swal.fire({
            title: "Registro de categoria fallido",
            text: "<?=$_SESSION['categoria_error']?>",
            icon: "error"
            });
    </script>
    
<?php endif?>

<?php if(isset($_SESSION['categoria_eliminada']) && $_SESSION['categoria_eliminada'] == 'complete'):?>
        <script>
            Swal.fire({
            title: "Categoría eliminada con éxito",
            icon: "success"
            });
        </script>
<?php elseif(isset($_SESSION['categoria_eliminada']) && $_SESSION['categoria_eliminada'] == 'failed'):?>
    
    
    <script>
            Swal.fire({
            title: "Error al eliminar la categoria",
            text: "<?=$_SESSION['categoria_error']?>",
            icon: "error"
            });
    </script>
    
<?php endif?>

<?php $_SESSION['categoria_error'] = '';?>
<?php Utils::deleteSession('categoria_creada');?>
<?php Utils::deleteSession('categoria_eliminada');?>

<h1 class="main__title">Gestionar categorias</h1>

<a href="<?=base_url?>categoria/crear" class="button">Crear categoría</a>

<table class="table">
    <tr class="table__tr">
        <th class="table__th">ID</th>
        <th class="table__th">Nombre</th>
        <th class="table__th">Acciones</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()): ?>
        <tr class="table__tr">
            <td class="table__td"><?=$cat->id;?></td>
            <td class="table__td"><?=$cat->nombre;?></td>
            <td class="table__td">
                <a class="button_delete" href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>