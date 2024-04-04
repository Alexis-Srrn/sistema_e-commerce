<?php if (isset($pro)) : ?>
    <h1 class="main__title"><?= $pro->nombre ?></h1>
    <div class="container__product--mostrar">
        <div class="container__img--mostrar">
            <?php if ($pro->imagen != null) : ?>
                <img class="product__img--mostrar" src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="mi_producto">
            <?php else : ?>
                <img class="product__img--mostrar" src="assets/img/world.png" alt="mi_producto">
            <?php endif; ?>
        </div>
        <div class="container__text--mostrar">
            <p class="product__price">$<?= $pro->precio ?></p>
            <p class="text__description"><?= $pro->descripcion ?></p>
            
            <div class="container__button">
                <a class="product__button--mostrar" href="<?=base_url?>carrito/add&id=<?=$pro->id?>">Comprar</a>
            </div>
        </div>
    </div>

<?php else : ?>
    <h1 class="main__title">Ups! Parece que el producto que buscabas no existe</h1>
<?php endif; ?>