<?php
    use App\User;
    use App\Ukm;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Penilaian</h5>
        <p class="text-muted m-b-10">Data Penilaian</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Detail Penilaian</li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">

            
                <div class="card">   
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                        <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                        <th class="text-center align-middle" colspan="<?php echo e($kriteria_count); ?>">Kriteria</th>
                                    </tr>
                                    <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-center">
                                            <?php echo e($kriteria->kode_kriteria); ?> 
                                            <?php echo e("($kriteria->jenis_kriteria)"); ?>

                                            <br>
                                            <small style="font-size: 14px;"><b><?php echo e($kriteria->nilai); ?></b></small>
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penilaian => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($val[0]->ukm->kode_ukm); ?></td>
                                            <td><?php echo e($val[0]->ukm->nama_ukm); ?></td>
                                            <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-center">
                                                    <?php echo e($val[$key]->nilai); ?>

                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <tr>
                                        <th class="text-center align-middle" colspan="2">Nilai (max/min)</th>
                                        <?php $__currentLoopData = $list_kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-center align-middle"><b><?php echo e(Ukm::GetMaxMin($kriteria)); ?></b></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>

                                    
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="<?php echo e($kriteria_count + 2); ?>">Normalisasi</th>
                                    </tr>
                                     <?php $__currentLoopData = $list_normalisasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $normalisasi_key => $normalisasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($normalisasi['kode_ukm']); ?></td>
                                            <td><?php echo e($normalisasi['nama_ukm']); ?></td>
                                            <?php $__currentLoopData = $normalisasi['nilai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nilai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-center">
                                                    <?php echo e(Str::substr($nilai, 0, 3)); ?>

                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="<?php echo e($kriteria_count + 2); ?>">Nilai Akhir</th>
                                    </tr>
                                     <?php $__currentLoopData = $list_nilai_akhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nilai_akhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($nilai_akhir['kode_ukm']); ?></td>
                                            <td><?php echo e($nilai_akhir['nama_ukm']); ?></td>
                                            <td colspan="<?php echo e($kriteria_count); ?>">
                                                <?php echo e(Str::substr($nilai_akhir['nilai_akhir'], 0, 5)); ?>

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



<?php $__env->startSection('costum-js'); ?>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/ukm/detailPenilaian.blade.php ENDPATH**/ ?>