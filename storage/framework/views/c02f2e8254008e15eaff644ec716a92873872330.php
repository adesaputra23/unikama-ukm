<?php
    use App\User;
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

            
                <div class="card">   
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form action="<?php echo e(route('ukm.penilaian.save')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                            <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                            <th class="text-center align-middle" colspan="<?php echo e($kriteria_count); ?>">Kriteria</th>
                                        </tr>
                                        <tr>
                                            <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th class="text-center"><?php echo e($kriteria->kode_kriteria); ?> <?php echo e("($kriteria->jenis_kriteria)"); ?></th>
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
                                                        <input value="<?php echo e($val[$key]->kode_ukm); ?>" type="hidden" class="form-control" name="kode_ukm[]">
                                                        <input value="<?php echo e($kriteria->kode_kriteria); ?>" type="hidden" class="form-control" name="kode_kriteria[]">
                                                        <input max="5" min="1" value="<?php echo e($val[$key]->nilai); ?>" type="number" class="form-control" name="nilai[]" id="nilai" required>
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="mt-4 float-right">
                                    <button type="submit" id="btn-simpan" name="aksi" value="ubah" class="btn btn-grd-success btn-sm">Simpan</button>
                                    <button type="reset" id="btn-reset" class="btn btn-grd-danger btn-sm">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            

        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('costum-js'); ?>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/ukm/ubah_penilaian_ukm.blade.php ENDPATH**/ ?>