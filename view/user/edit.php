<div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4"><?=$button?></h1>
        </div>
        <form class="user" method="post" action="index.php?c=<?=Database::encryptor('encrypt', 'user')?>&a=<?=Database::encryptor('encrypt', 'crud')?>">
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">    
                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?=$name?>" placeholder="Nombre Del Usuario">
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user" id="email" name="email" value="<?=$email?>" placeholder="Email Del Usuario">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="form-control" name="level" id="level">
                        <option <?=$select1?> value="1">Super Usuario</option>
                        <option <?=$select2?> value="2">Administrador</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?=$id?>" >
            <button type="submit"  class="btn btn-primary btn-user btn-block">
                <?=$button?>
            </button>
        </form>
    </div>
</div>