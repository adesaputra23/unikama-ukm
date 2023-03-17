<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Kriteria</h5>
        <p class="text-muted m-b-10">Data Kriteria</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Kriteria</li>
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
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Cost/Benefit</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                        <tr>
                                            <td class="align-middle text-center"><?php echo e($item + 1); ?></td>
                                            <td class="align-middle"><?php echo e($value->kode_kriteria); ?></td>
                                            <td class="align-middle"><?php echo e($value->nama_kriteria); ?></td>
                                            <td class="align-middle text-center"><?php echo e($value->jenis_kriteria); ?></td>
                                            <td class="align-middle text-center"><?php echo e($value->nilai); ?></td>
                                            <td class="align-middle text-center" style="width: 18%">
                                                <div class="btn-group btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-id=<?php echo e($value->id_kriteria); ?>

                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-id=<?php echo e($value->id_kriteria); ?>

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

                <div class="card">   
                    <div class="card-block table-border-style">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">Tingkat Nilai Kepentingan</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Kepentingan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $list_tingkat_kepentingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $tingkat_kepentingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($tingkat_kepentingan['nilai_kpt']); ?></td>
                                                    <td class="text-center"><?php echo e($tingkat_kepentingan['nama_kpt']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                     <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">Standar Nilai Kriteria</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Kriteria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php $__currentLoopData = $list_standar_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $standar_kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($standar_kriteria['nilai_krt']); ?></td>
                                                    <td class="text-center"><?php echo e($standar_kriteria['nama_krt']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
      <form action="<?php echo e(route('kriteria.hapus')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <input type="hidden" name="id_kriteria" id="id_kriteria">
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
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('kriteria.save')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kode</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="kode_kriteria" id="kode_kriteria" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kriteria</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis</label>
                <div class="col-sm-9">
                    <select class="form-control" name="jenis" id="jenis" required>
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="Benefit">Benefit</option>
                        <option value="Cost">Cost</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nilai</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nilai" id="nilai" required>
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
        $(document).on('click', '#btn-tambah', function(e){
            $('.modal .modal-title').text('Tambah Data Kriteria');
            $('#kode_kriteria').attr('readonly', false);
            $('#kode_kriteria').val('');
            $('#nama_kriteria').val('');
            $('#jenis').val('');
            $('#nilai').val('');
            $('#btn-simpan').val('tambah');
        });
        $(document).on('click', '#edit-button', function(e){
            $('.modal .modal-title').text('Ubah Data Kriteria');
            $('#kode_kriteria').attr('readonly', true);
            var id = $(this).data('id');
            var list_data = $.get("<?php echo e(url('kriteria/ajax-get')); ?>/" + id);
            list_data.done(function(response){
                var kriteria = response;
                $('#kode_kriteria').val(kriteria.kode_kriteria);
                $('#nama_kriteria').val(kriteria.nama_kriteria);
                $('#jenis').val(kriteria.jenis_kriteria);
                $('#nilai').val(kriteria.nilai);
                $('#btn-simpan').val('ubah');
            });
        });
        $(document).on('click', '#btn-hapus', function(e){
            var id = $(this).data('id');
            $('#id_kriteria').val(id);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/kriteria/index.blade.php ENDPATH**/ ?>