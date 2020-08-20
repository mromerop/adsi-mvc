<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <a href="index.php?c=<?=Database::encryptor('encrypt', 'user')?>&a=<?=Database::encryptor('encrypt', 'edit')?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-user-plus"></i>
                    </span>
            <span class="text">Crear Usuario</span>
        </a>
        <a target="_blank" href="https://drive.google.com/file/d/1YxPoYBvWsEdYBR5SSmrcfL5_Yuu7mQ5J/view?usp=sharing">Documento Drive</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th>Ultima Sesión</th>
                    <th><i class="fa fa-cogs"></i></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th>Ultima Sesión</th>
                    <th><i class="fa fa-cogs"></i></th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $num = 0;
                foreach ($rows as $row) {
                    $num++;
                    ?>
                    <tr>
                        <td><?=$row->name?></td>
                        <td><?=$row->email?></td>
                        <td><?=$row->level?></td>
                        <td><?=$row->active?></td>
                        <td><?=$row->lastAccess?></td>
                        <td>
                            <a href="#" class="btn btn-success btn-circle .btn-sm" data-toggle="modal" data-target="#editModal<?=$num?>">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <div class="modal fade" id="editModal<?=$num?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                <i class="fa fa-user-edit"></i>&nbsp;&nbsp;
                                                Actualizar Registro Del Usuaario
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="user" method="post" action="index.php?c=user&a=crud">
                                            <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="<?=$row->name?>" placeholder="Nombre Del Usuario">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="<?=$row->email?>" placeholder="Email Del Usuario">
                                                    </div>
                                                    <input type="hidden" name="id" value="<?=$row->id?>" >
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                    <i class="fa fa-cloud"></i>&nbsp;&nbsp;
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary" >
                                                    <i class="fa fa-floppy-o"></i>&nbsp;&nbsp;
                                                    Actualizar
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-danger btn-circle .btn-sm" data-toggle="modal" data-target="#logoutModal<?=$num?>">
                                <i class="fas fa-trash"></i>
                            </a>
                            <!-- Logout Modal-->
                            <div class="modal fade" id="logoutModal<?=$num?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">
                                                <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;
                                                Eliminar El Usuario?
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Realmente Desea Eliminar El Usuario?.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                <i class="fa fa-cloud"></i>&nbsp;&nbsp;
                                                Cancel
                                            </button>
                                            <a class="btn btn-danger" href="index.php?c=user&a=delete&id=<?=$row->id?>">
                                                <i class="fa fa-trash"></i>&nbsp;&nbsp;
                                                Eliminar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?c=<?=Database::encryptor('encrypt', 'user' )?>>&a=<?=Database::encryptor('encrypt', 'upload' )?>&id=<?=Database::encryptor('encrypt', $row->id )?>" class="btn btn-primary btn-circle .btn-sm">
                                <i class="fa fa-cloud"></i>
                            </a>
                            <a href="index.php?c=<?=Database::encryptor('encrypt', 'user' )?>>&a=<?=Database::encryptor('encrypt', 'viewDoc' )?>&id=<?=Database::encryptor('encrypt', $row->id )?>" class="btn btn-warning btn-circle .btn-sm">
                                <i class="fas fa-file-upload"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
