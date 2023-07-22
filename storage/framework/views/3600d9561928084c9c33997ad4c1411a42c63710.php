<?php
    use App\User;
    use App\Kriteria;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Penilaian UKM</h5>
        <p class="text-muted m-b-10">Penilaian UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Penilaian UKM</li>
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
                    <div class="card-block table-border-style">
                        <div class="table-responsive">

                            <?php if(count($list_penilaian) == 0): ?>
                                <form action="<?php echo e(route('ukm.penilaian.save')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                                <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                                <th class="text-center align-middle" colspan="<?php echo e($kriteria_count); ?>">Kriteria Penilaian</th>
                                            </tr>
                                            <tr>
                                                <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td class="text-center">
                                                        <b><?php echo e($kriteria->nama_kriteria); ?></b>
                                                        <br>
                                                        <i><?php echo e("($kriteria->jenis_kriteria)"); ?></i>
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $list_ukm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $ukm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($ukm->kode_ukm); ?></td>
                                                    <td><?php echo e($ukm->nama_ukm); ?></td>
                                                    <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td>
                                                            <?php if($kriteria->jenis_kriteria ===  'Benefit'): ?>
                                                                <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                    <option value="0" selected>Pilih Nilai</option>
                                                                    <?php $__currentLoopData = $nilaiTingkatKepentingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyTk => $tingkatKepentingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($tingkatKepentingan['nilai_kpt']); ?>"><?php echo e($tingkatKepentingan['nama_kpt']); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            <?php else: ?>
                                                                <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                    <option value="0" selected>Pilih Nilai</option>
                                                                    <?php $__currentLoopData = $nilaiStandarKriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyTk => $standarKriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($standarKriteria['nilai_krt']); ?>"><?php echo e($standarKriteria['nama_krt']); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            <?php endif; ?>
                                                            <input value="<?php echo e($ukm->kode_ukm); ?>" type="hidden" class="form-control" name="kode_ukm[]">
                                                            <input value="<?php echo e($kriteria->kode_kriteria); ?>" type="hidden" class="form-control" name="kode_kriteria[]">
                                                            
                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="mt-4 float-right">
                                        <button type="submit" id="btn-simpan" name="aksi" value="simpan" class="btn btn-grd-success btn-sm">Simpan</button>
                                        <button type="reset" id="btn-reset" class="btn btn-grd-danger btn-sm">Batal</button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <span>
                                    Penilaian telah dilakukan, silahkan lihat UKM yang di rekomendasikan untuk anda,
                                    <br>
                                    Klik Button <a href="<?php echo e(route('ukm.rekomendasi')); ?>" class="btn btn-out btn-primary btn-square btn-sm">Rekomendasi UKM</a>
                                </span>

                                <div class="mb-2 float-right">
                                    <a href="<?php echo e(route('ukm.penilaian.ubah')); ?>" class="btn btn-grd-warning btn-sm">Ubah</a>
                                    <button type="button" class="btn btn-grd-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-hapus">Hapus</button>
                                    <a href="<?php echo e(route('ukm.penilaian.detail')); ?>" class="btn btn-grd-info btn-sm">Detail</a>
                                </div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                            <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                            <th class="text-center align-middle" colspan="<?php echo e($kriteria_count); ?>">Kriteria Penilaian</th>
                                        </tr>
                                        <tr>
                                            <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-center">
                                                    <b><?php echo e($kriteria->nama_kriteria); ?></b>
                                                    <br>
                                                    <i><?php echo e("($kriteria->jenis_kriteria)"); ?></i>
                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $list_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penilaian => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($val[0]->ukm->kode_ukm); ?></td>
                                                <td><?php echo e($val[0]->ukm->nama_ukm); ?></td>
                                                <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td class="text-center">
                                                        <?php if($kriteria->jenis_kriteria ===  'Benefit'): ?>
                                                            <?php if($val[$key]->nilai == 0): ?>
                                                                <i style="color: red;"><?php echo e(Kriteria::MAP_NILAI_TINGKAT_KEPENTINGAN[$val[$key]->nilai]['nama_kpt']); ?></i>
                                                            <?php else: ?>       
                                                                <b><?php echo e(Kriteria::MAP_NILAI_TINGKAT_KEPENTINGAN[$val[$key]->nilai]['nama_kpt']); ?></b>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if($val[$key]->nilai == 0): ?>
                                                                <i style="color: red;"><?php echo e(Kriteria::MAP_STANDAR_KRITERIA[$val[$key]->nilai]['nama_krt']); ?></i>
                                                            <?php else: ?>
                                                                <b><?php echo e(Kriteria::MAP_STANDAR_KRITERIA[$val[$key]->nilai]['nama_krt']); ?></b>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            

        </div>
    </div>

    
    <div class="modal fade bd-example-modal-hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Hapus Data Penilaian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?php echo e(route('ukm.penilaian.hapus')); ?>" method="get">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="text-center">
                    <p>Data akan terhapus secara permanen, anda yakin ingin menghapus?</p>
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
    

<?php $__env->stopSection(); ?>



<?php $__env->startSection('costum-js'); ?>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/ukm/penilaian_ukm.blade.php ENDPATH**/ ?>