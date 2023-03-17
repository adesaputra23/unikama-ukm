<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Kaprodi</h5>
        <p class="text-muted m-b-10">Data Kaprodi</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
                <li class="breadcrumb-item">Kaprodi</li>
                <li class="breadcrumb-item"><a href="<?php echo e(url()->current()); ?>">Kaprodi</a></li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">

            <?php if(Session::Has('success')): ?>
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Berhasil!</strong> <?php echo e(Session::get('success')); ?>

                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           <?php endif; ?>

            <?php if(Session::Has('error')): ?>
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Gagal!</strong> <?php echo e(Session::get('error')); ?>

                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           <?php endif; ?>

            
                <div class="card">   
                    <div class="card-header">
                        <button class="btn btn-grd-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIDN</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Fakultas</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="width: 5%" class="text-center align-middle"><?php echo e($item + 1); ?></td>
                                            <td class="align-middle"><?php echo e($value->nidn); ?></td>
                                            <td class="align-middle"><?php echo e($value->nama_pegawai); ?></td>
                                            <td class="align-middle"><?php echo e($map_fakultas[$value->faklutas] ?? '-'); ?></td>
                                            <td class="align-middle"><?php echo e($map_prodi[$value->prodi] ?? '-'); ?></td>
                                            <td class="text-center align-middle" style="width: 18%">
                                                <div class="btn-group btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-user_id=<?php echo e($value->user->id); ?>

                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-user_id=<?php echo e($value->user->id); ?>

                                                        class="btn btn-grd-danger btn-sm"
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-hapus">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            

        </div>
    </div>
<?php $__env->stopSection(); ?>



<div class="modal fade bd-example-modal-hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('pengguna.pegawai.hapus')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <input type="hidden" name="id_user" id="id_user">
            <div class="text-center">
                <p>Anda yakin ingin hapus data ini?</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-grd-primary btn-sm">Hapus</button>
            <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Kaprodi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('pengguna.pegawai.save')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="form-group row" style="display: none;">
                <label class="col-sm-3 col-form-label">Kaprodi</label>
                <div class="col-sm-9">
                    <input value="3" type="text" class="form-control" name="role" id="role">
                </div>
            </div>

            
            <div class="form-add"></div>
            

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-grd-primary btn-sm">Simpan</button>
            <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>



<?php $__env->startSection('costum-js'); ?>
    <script>
        var fakultas = <?php echo json_encode($fakultas, 15, 512) ?>;
        var prodi = <?php echo json_encode($prodi, 15, 512) ?>;

        $(document).on('click', '#btn-tambah', function(e){
            $('.modal .modal-title').text('Tambah Data Kaprodi');
            $('#role').attr('readonly', false);
            $('#role').attr('disabled', false);
            $('.form-add').empty();
            $('#prodi').val('');
            $('#role').val(3);
            var role = 3;
            ShowInputAdd(role);
        });

        $(document).on('click', '#edit-button', function(){
            $('.modal .modal-title').text('Ubah Data Kaprodi');
            $('#role').attr('readonly', true);
            $('#role').attr('disabled', true);

            var user_id = $(this).data("user_id");
            var list_data = $.get("<?php echo e(url('pengguna/pegawai/ajax-get')); ?>/" + user_id);
            list_data.done(function(data){
                var user_role = data.id_role;
                $('#role').val(user_role);
                ShowInputAdd(user_role, data); 
            });
        })

        function ShowInputAdd(role, user = null) {
            var pegawai = '';
            var email = '';
            if (user != null) {
                pegawai = user.pegawai;
                email = user.email;
            }
            var html1 = '';
            html1 += `
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input value="${pegawai.nidn ?? ''}" type="text" class="form-control" name="nidn" id="nidn" required ${(pegawai.nidn ? 'readonly' : '')}>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-9">
                        <input value="${pegawai.nama_pegawai ?? ''}" type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" required>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input value="${email ?? ''}" type="text" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            `;
            if (role == 3) {
                html1 += `
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilih Fakultas</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="fakultas" id="fakultas" required>
                                <option value="" selected disabled>Pilih Fakultas</option>`;
                                    $.each(fakultas, function (index, value) { 
                                       html1 += `<option value="${value.id}" ${value.id == pegawai.faklutas ? 'selected' : ''}>${value.nama}</option>`;
                                    });
                             html1 += `</select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilih Prodi</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="prodi" id="prodi" required>
                                <option value="" selected disabled>Pilih Prodi</option>`;
                                    $('#prodi').empty();
                                    $.each(prodi[pegawai.faklutas], function (key, val) { 
                                        html1 += `<option value="${val.id}" ${val.id == pegawai.prodi ? 'selected' : ''}>${val.nama}</option>`;
                                    });
                            html1 += `</select>
                        </div>
                    </div>
                `;
            }
            $('.form-add').empty().append(html1);
            $('.form-add #fakultas').on('change', function(){
                var val_fakultas = $(this).val();
                $('#prodi').empty();
                $.each(prodi[val_fakultas], function (key, val) { 
                     $('#prodi').append($('<option>', {
                        value: val.id,
                        text: val.nama
                     }));
                });
            });
        }

        $(document).on('click', '#btn-hapus', function(e){
            var id_user = $(this).data('user_id');
            $('#id_user').val(id_user);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/kaprodi/index.blade.php ENDPATH**/ ?>