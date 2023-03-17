<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10"><?php echo e($ukm->kode_ukm); ?> - UKM <?php echo e($ukm->nama_ukm); ?></h5>
        <p class="text-muted m-b-10">Penilaian UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Data Mahasiswa</li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">

            
                <div class="card">   
                    <div class="card-header">
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NPM</th>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center">Fakultas</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Jumlah Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_mhs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle text-center"><?php echo e($key + 1); ?></td>
                                            <td class="align-middle"><?php echo e($value->mhs->npm); ?></td>
                                            <td class="align-middle"><?php echo e($value->mhs->nama_mhs); ?></td>
                                            <td class="align-middle"><?php echo e($fakultas[$value->mhs->fakultas]); ?></td>
                                            <td class="align-middle"><?php echo e($prodi[$value->mhs->prodi]); ?></td>
                                            <td class="align-middle text-center"><?php echo e($value->nilai_akhir); ?></td>
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



<?php $__env->startSection('costum-js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/penilaian/get_mhs.blade.php ENDPATH**/ ?>