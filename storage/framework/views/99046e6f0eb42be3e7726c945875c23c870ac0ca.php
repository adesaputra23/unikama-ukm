<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">UKM</h5>
        <p class="text-muted m-b-10">Data UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">UKM</li>
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
                        <?php if(User::Is_Admin() || User::Is_Kepala_BAK()): ?>
                            <button class="btn btn-grd-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
                        <?php endif; ?>
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
                                        <th class="text-center">Kode UKM</th>
                                        <th class="text-center">Nama UKM</th>
                                        <th class="text-center">Foto</th>
                                        <?php if(User::Is_Admin() || User::Is_Kepala_BAK()): ?>
                                            <th class="text-center">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_ukm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle text-center"><?php echo e($item + 1); ?></td>
                                            <td class="align-middle"><?php echo e($value->kode_ukm); ?></td>
                                            <td class="align-middle"><?php echo e($value->nama_ukm); ?></td>
                                            <td class="align-middle text-center">
                                                 <img style="width: 5rem;" 
                                                    src="<?php echo e((!empty($value->foto_ukm)) ? asset('file_foto_ukm').'/'.$value->foto_ukm : asset('assets/images/ukm-default.jpg')); ?>" 
                                                class="rounded" alt="...">
                                            </td>
                                            <?php if(User::Is_Admin() || User::Is_Kepala_BAK()): ?>
                                                <td class="align-middle text-center" style="width: 18%">
                                                    <div class="btn-group btn-sm">
                                                        <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                            data-kode_ukm=<?php echo e($value->kode_ukm); ?>

                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-lg">
                                                            Ubah
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            id="btn-hapus"
                                                            data-kode_ukm=<?php echo e($value->kode_ukm); ?>

                                                            class="btn btn-grd-danger btn-sm"
                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-hapus">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
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
        <h5 class="modal-title">Hapus Data UKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('ukm.hapus')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <input type="hidden" name="hapus_ukm_kode" id="hapus_ukm_kode">
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
        <h5 class="modal-title">Tambah Data UKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('ukm.save')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kode</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="kode_ukm" id="kode_ukm" required>
                </div>
                <?php $__errorArgs = ['kode_ukm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger">&ensp;&ensp;
                        <i class="fa fa-warning"></i>
                        <?php echo e($message); ?>

                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_ukm" id="nama_ukm" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Terbentuk</label>
                <div class="col-sm-9">
                    <input value="" type="date" class="form-control" name="tgl_terbentuk" id="tgl_terbentuk">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                    <textarea rows="5" cols="5" class="form-control" name="deskripsi" id="deskripsi"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="foto" id="foto">
                    <small class="foto-name mt-2" style="display: none;"><i>Nama Foto</i></small>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btn-simpan" name="aksi" class="btn btn-grd-primary btn-sm">Simpan</button>
            <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>




<?php $__env->startSection('costum-js'); ?>
    <script>

        $(document).on('click', '#btn-tambah' ,function(e){
            $('.modal .modal-title').text('Tambah Data UKM');
            $('#kode_ukm').attr('readonly', false);
            $('#kode_ukm').val('');
            $('#nama_ukm').val('');
            $('#tgl_terbentuk').val('');
            $('#deskripsi').val('');
            $('.foto-name').css('display', 'none');
            $('.foto-name').text('');
            $('#btn-simpan').val('tambah');
        });

        $(document).on('click', '#edit-button' ,function(e){
            $('.modal .modal-title').text('Ubah Data UKM');
            var kode_ukm = $(this).data('kode_ukm');
            var list_data = $.get("<?php echo e(url('ukm/ajax-get')); ?>/" + kode_ukm);
            list_data.done(function(response){
                $('#kode_ukm').attr('readonly', true);
                $('#kode_ukm').val(response.kode_ukm);
                $('#nama_ukm').val(response.nama_ukm);
                $('#tgl_terbentuk').val(response.tgl_terbentuk);
                $('#deskripsi').val(response.deskripsi);
                $('.foto-name').css('display', 'block');
                $('.foto-name').text(response.foto_ukm);
                $('#btn-simpan').val('update');
            })
        });

        $(document).on('click', '#btn-hapus', function(e){
            var kode_ukm = $(this).data('kode_ukm');
            $('#hapus_ukm_kode').val(kode_ukm);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/Ukm/index.blade.php ENDPATH**/ ?>