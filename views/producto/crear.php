<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1 class="main__title">Editar producto: <br> <?=$pro->nombre?> </h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id;?>
<?php else:?>
    <h1 class="main__title">Crear nuevo producto</h1>
    <?php $url_action = base_url."producto/save";?>
<?php endif;?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <label class="form__label" for="nombre">Nombre</label>
    <input class="form__input"  type="text" name="nombre" value="<?=$pro->nombre ?? '';?>" required />

    <label class="form__label" for="descripcion">Descripcion</label>
    <textarea class="form__area"  type="text" name="descripcion" required><?=$pro->descripcion ?? '';?></textarea>

    <label class="form__label" for="precio">Precio</label>
    <input class="form__input"  type="text" name="precio" value="<?=$pro->precio ?? '';?>"  pattern="[0-9]{0,13}"  required/>

    <label class="form__label" for="stock">Stock</label>
    <input class="form__input"  type="number" min="1" pattern="^[0-9]+"   name="stock"  value="<?=$pro->stock ?? '';?>"  required/>

    <label class="form__label" for="categoria">Categoria</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <?php while($cat = $categorias->fetch_object()):?>
            <option value="<?=$cat->id;?>" <?= isset($pro) && $cat->id == $pro->categoria_id ? 'selected' : '';?> >
                <?=$cat->nombre;?>
            </option>
        <?php endwhile;?>
    </select>

    <label class="form__label" for="imagen">Imagen</label>
    <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)):?>
        <img class="form__img" src="<?=base_url?>uploads/images/<?=$pro->imagen?>"/>
    <?php endif;?>
    <input class="form__input"  type="file" name="imagen"/>

    <input class="form__input" type="submit" value="Guardar">


</form>