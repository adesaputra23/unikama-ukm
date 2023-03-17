<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Pengguna</h5>
        <p class="text-muted m-b-10">Data Pengguna</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item"><a href="<?php echo e(url()->current()); ?>">Mahasiswa</a></li>
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
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center align-middle"><?php echo e($item + 1); ?></td>
                                            <td class="align-middle"><?php echo e($user->mahasiswa->npm); ?></td>
                                            <td class="align-middle"><?php echo e($user->mahasiswa->nama_mhs); ?></td>
                                            <td class="align-middle"><?php echo e($role_user[$user->id_role]); ?></td>
                                            <td class="text-center align-middle">
                                                <img style="width: 5rem;" 
                                                        src="<?php echo e((!empty($user->mahasiswa->foto_mhs)) ? asset('file_foto_profil').'/'.$user->mahasiswa->foto_mhs : asset('assets/images/avatar-0.png')); ?>" 
                                                    class="rounded" alt="...">
                                            </td>
                                            <td class="text-center align-middle" style="width: 18%">
                                                <div class="btn-group btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-user_id=<?php echo e($user->id); ?>

                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-user_id=<?php echo e($user->id); ?>

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
        <h5 class="modal-title">Tambah Data Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('pengguna.mahasiswa.save')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    <input value="<?php echo e($role_user[User::MAHASISWA]); ?>" type="text" class="form-control" name="role" id="role" required readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">NPM</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="npm" id="npm" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_mhs" id="nama_mhs" required>
                </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input value="" type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Fakultas</label>
                <div class="col-sm-9">
                    <select class="form-control" name="fakultas" id="fakultas" required>
                        <option value="" selected disabled>Pilih Fakultas</option>
                        <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value['id']); ?>"><?php echo e($value['nama']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Prodi</label>
                <div class="col-sm-9">
                    <select class="form-control" name="prodi" id="prodi" required>
                        <option value="" selected disabled>Pilih Prodi</option>
                    </select>
                </div>
            </div>
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
        var prodi = <?php echo json_encode($prodi, 15, 512) ?>;
        $(document).on('change', '#fakultas', function(e){
            var fakultas = $(this).val();
            var html_prodi = '';
            $('#prodi').empty();
            html_prodi += `<option selected disabled>Pilih Prodi</option>`;
            $('#prodi').append(html_prodi);
            $.each(prodi[fakultas], function (key, val) { 
                $('#prodi').append($('<option>', {
                    value: val.id,
                    text: val.nama
                }));
            });
        });

        $(document).on('click', '#btn-tambah', function(e){
            $('.modal .modal-title').text('Tambah Data Pengguna');
            $('#npm').attr('readonly', false);
            var html_prodi = '';
            $('#npm').val('');
            $('#nama_mhs').val('');
            $('#email').val('');
            $('#fakultas').val('');
            $('#prodi').empty();
            html_prodi += `<option selected disabled>Pilih Prodi</option>`;
            $('#prodi').append(html_prodi);
        });

        $(document).on('click', '#edit-button', function(e){
            $('.modal .modal-title').text('Ubah Data Pengguna');
            $('#npm').attr('readonly', true);
            var user_id = $(this).data('user_id');
            var list_data = $.get("<?php echo e(url('pengguna/pegawai/ajax-get')); ?>/" + user_id);
            list_data.done(function(data){
                var mahasiswa = data.mahasiswa;
                var html_prodi = '';
                $('#npm').val(mahasiswa.npm);
                $('#nama_mhs').val(mahasiswa.nama_mhs);
                $('#email').val(data.email);
                $('#fakultas').val(mahasiswa.fakultas);
                $('#prodi').empty();
                html_prodi += `<option selected disabled>Pilih Prodi</option>`;
                $.each(prodi[mahasiswa.fakultas], function (key, val) { 
                    html_prodi += `
                        <option value="${val.id}" ${(val.id == data.mahasiswa.prodi) ? 'selected' : ''}>${val.nama}</option>
                    `;
                });
                $('#prodi').append(html_prodi);
            });
        });

        $(document).on('click', '#btn-hapus', function(e){
            var id_user = $(this).data('user_id');
            $('#id_user').val(id_user);
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/pengguna/mahasiswa/index.blade.php ENDPATH**/ ?>