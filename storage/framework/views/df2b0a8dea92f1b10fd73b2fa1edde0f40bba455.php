<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Mahasiswa</h5>
        <p class="text-muted m-b-10">Data Mahasiswa</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
                <li class="breadcrumb-item">Mahasiswa</li>
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
                                        <?php if(User::Is_Admin() || User::Is_Kepala_BAK()): ?>
                                            <th class="text-center">Fakultas</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Agama</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                        <?php elseif(User::Is_Kaprodi()): ?>
                                            <th class="text-center">UKM Pilihan</th>
                                        <?php endif; ?>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center align-middle"><?php echo e($item + 1); ?></td>
                                            <td class="align-middle"><?php echo e($value->npm); ?></td>
                                            <td class="align-middle"><?php echo e($value->nama_mhs); ?></td>
                                            <?php if(User::Is_Admin() || User::Is_Kepala_BAK()): ?>    
                                                <td class="align-middle"><?php echo e($map_fakultas[$value->fakultas]); ?></td>
                                                <td class="align-middle"><?php echo e($map_prodi[$value->prodi]); ?></td>
                                                <td class="align-middle"><?php echo e($agama[$value->agama] ?? '-'); ?></td>
                                                <td class="align-middle"><?php echo e($jenis_kelamin[$value->jenis_kelamin] ?? '-'); ?></td>
                                            <?php elseif(User::Is_Kaprodi()): ?>
                                                <td class="align-middle text-center">
                                                    <?php if(!$value->PilihanUkm): ?>
                                                        <?php echo e('-'); ?>

                                                    <?php else: ?>
                                                        <?php echo e('('.$value->PilihanUkm->Ukm->kode_ukm.') - ' .$value->PilihanUkm->Ukm->nama_ukm); ?>

                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <td class="text-center align-middle" style="width: 12%">
                                                <div class="btn-group btn-group-vertical btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-npm=<?php echo e($value->npm); ?>

                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-id_user=<?php echo e($value->user->id); ?>

                                                        class="btn btn-grd-danger btn-sm"
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-hapus">
                                                        Hapus
                                                    </button>
                                                    <a href="<?php echo e(route('ukm.penilaian.detail',['npm' => $value->npm ])); ?>" class="btn btn-grd-info btn-sm">Detail</a>
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
                        <?php if(User::Is_Kaprodi()): ?>
                            <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value['id']); ?>"><?php echo e($value['nama']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif(User::Is_Admin() || User::Is_Kepala_BAK()): ?>
                            <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value['id']); ?>"><?php echo e($value['nama']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
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
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                    <select class="form-control" name="agama" id="agama" required>
                        <option value="" selected disabled>Pilih Agama</option>
                        <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $agm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"><?php echo e($agm); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <select class="form-control" name="jk" id="jk" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <?php $__currentLoopData = $jenis_kelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_jk => $jk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item_jk); ?>"><?php echo e($jk); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            $('.modal .modal-title').text('Tambah Data Mahasiswa');
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
            $('.modal .modal-title').text('Ubah Data Mahasiswa');
            $('#npm').attr('readonly', true);
            var npm = $(this).data('npm');
            var list_data = $.get("<?php echo e(url('mahasiswa/ajax-get')); ?>/" + npm);
            list_data.done(function(data){
                var mahasiswa = data;
                var html_prodi = '';
                $('#npm').val(mahasiswa.npm);
                $('#nama_mhs').val(mahasiswa.nama_mhs);
                $('#email').val(mahasiswa.user.email);
                $('#fakultas').val(mahasiswa.fakultas);
                $('#prodi').empty();
                html_prodi += `<option selected disabled>Pilih Prodi</option>`;
                $.each(prodi[mahasiswa.fakultas], function (key, val) { 
                    html_prodi += `
                        <option value="${val.id}" ${(val.id == mahasiswa.prodi) ? 'selected' : ''}>${val.nama}</option>
                    `;
                });
                $('#prodi').append(html_prodi);
                $('#agama').val(mahasiswa.agama);
                $('#jk').val(mahasiswa.jenis_kelamin);
            });
        });

        $(document).on('click', '#btn-hapus', function(e){
            var id_user = $(this).data('id_user');
            $('#id_user').val(id_user);
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/mahasiswa/index.blade.php ENDPATH**/ ?>