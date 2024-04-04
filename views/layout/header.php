<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi tienda</title>



    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <!--Sweet Alert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="container" class="container">
        <!--HEADER-->
        <header id="header" class="header">
            <div class="logo" id="logo">
                <img class="logo__img" src="<?=base_url?>assets/img/sonic.png" alt="LOGO">
                <a class="logo__link" href="<?=base_url?>">
                    MI TIENDA
                </a>
            </div>
        </header>
        <!--MENU-->
        <?php $categorias = Utils::showCategorias();?>
        <nav id="menu" class="menu">
            <ul class="menu__ul">
                <li class="menu__li"> <a class="menu__link" href="<?=base_url?>">Inicio</a> </li>
                <?php while($cat = $categorias->fetch_object()):?>
                    <li class="menu__li">
                        <a class="menu__link" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre;?></a> 
                    </li>
                <?php endwhile;?>
            </ul>
        </nav>

        <div id="content" class="content">