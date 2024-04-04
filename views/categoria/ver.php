<?php if (isset($categoria)) : ?>
    <h1 class="main__title"><?= $categoria->nombre ?></h1>
    <?php if ($productos->num_rows == 0) : ?>
        <p>No hay productos para mostrar...</p>
    <?php else : ?>
        <div class="container__product">
            <?php while ($pro = $productos->fetch_object()) : ?>
                <div class="product">
                    <a class="product__link" href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>">
                        <?php if ($pro->imagen != null) : ?>
                            <img class="product__img" src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="mi_producto">
                        <?php else : ?>
                            <img class="product__img" src="assets/img/world.png" alt="mi_producto">
                        <?php endif; ?>
                        <h2 class="product__title"><?= $pro->nombre; ?></h2>
                    </a>
                    <p class="product__price"><?= $pro->precio ?></p>
                    <a class="product__button" href="<?=base_url?>carrito/add&id=<?=$pro->id?>">Comprar</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <h1 class="main__title">La categoria no existe</h1>
<?php endif; ?>