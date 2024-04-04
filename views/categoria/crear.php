<h1>Crear una categoría nueva</h1>

<form action="<?=base_url?>categoria/save" method="POST">
    <label class="form__label" for="nombre">Nombre</label>
    <input class="form__input" type="text" name="nombre" required/>

    <input class="form__input" type="submit" value="Guardar">

</form>