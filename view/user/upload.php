<form action="index.php?c=<?=Database::encryptor('encrypt', 'user')?>&a=<?=Database::encryptor('encrypt', 'uploadFile')?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlFile1">Seleccione El Documento a Subir</label>
        <input type="file" name="file" id="file">
        <br>
        <button type="submit" class="btn btn-success">
            Subir
        </button>
        <input type="hidden" name="id" value="<?=$id?>">
    </div>
</form>
