<?php
    use App\User;
?>

<?php $__env->startSection('content-breadcrumb'); ?>
    <div class="card-block">
        <h5 class="m-b-10">Profil</h5>
        <p class="text-muted m-b-10">Data Profil</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Profil</li>
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
                        <div class="float-right mb-2">
                            <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" data-toggle="modal" data-target=".bd-example-modal-lg" data-user_id="<?php echo e(Auth::user()->id); ?>">Ubah Profil</button>
                            
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <?php if(User::Is_Mahasiswa()): ?>
                                        <th scope="row" rowspan="9" style="width: 20%;">
                                            <div class="text-center">
                                                <img style="width: 10rem;" 
                                                    src="<?php echo e(empty($user_data->foto_mhs) ? asset('assets/images/avatar-0.png') : asset('file_foto_profil').'/'.$user_data->foto_mhs); ?>" 
                                                class="rounded" alt="...">
                                            </div>
                                        </th>
                                        <th style="width: 15%">NPM</th>
                                        <td><?php echo e($user_data->npm); ?></td>
                                    <?php elseif(User::Is_Kepala_BAK() || User::Is_Kaprodi()): ?>
                                        <th scope="row" rowspan="9" style="width: 20%;">
                                            <div class="text-center">
                                                <img style="width: 10rem;" 
                                                    src="<?php echo e(empty($user_data->foto) ? asset('assets/images/avatar-0.png') : asset('file_foto_profil').'/'.$user_data->foto); ?>" 
                                                class="rounded" alt="...">
                                            </div>
                                        </th>
                                        <th style="width: 15%">NIDN</th>
                                        <td><?php echo e($user_data->nidn); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><?php echo e($user_data->nama_mhs ?? $user_data->nama_pegawai); ?></td>
                                </tr>
                                <?php if(!User::Is_Kepala_BAK()): ?>
                                    <tr>
                                        <th>Fakultas</th>
                                        <td><?php echo e($list_fakultas[$user_data->fakultas ?? $user_data->faklutas]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Prodi</th>
                                        <td><?php echo e($list_prodi[$user_data->prodi]); ?></td>
                                    </tr>
                                <?php endif; ?>
                                 <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?php echo e($user_data->jenis_kelamin == null ? '' : $jk[$user_data->jenis_kelamin]); ?></td>
                                </tr>
                                 <tr>
                                    <th>Agama</th>
                                    <td><?php echo e($user_data->agama == null ? '' : $list_agama[$user_data->agama]); ?></td>
                                </tr>
                                <tr>
                                    <th>Tempat lahir</th>
                                    <td><?php echo e($user_data->tempat_lahir); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td><?php echo e($user_data->tgl_lahir); ?></td>
                                </tr>
                                <tr>
                                    <th>No Telpon</th>
                                    <td><?php echo e($user_data->no_tlpn ?? $user_data->no_hp); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            

        </div>
    </div>
<?php $__env->stopSection(); ?>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('profil.save')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="form-group row">
                <?php if(User::Is_Mahasiswa()): ?>
                    <label class="col-sm-3 col-form-label">NPM</label>
                    <div class="col-sm-9">
                        <input value="" type="text" class="form-control" name="npm" id="npm" required readonly>
                    </div>
                <?php else: ?>
                    <label class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input value="" type="text" class="form-control" name="nidn" id="nidn" required readonly>
                    </div>    
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama" id="nama" required>
                </div>
            </div>
            <?php if(!User::Is_Kepala_BAK()): ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Fakultas</label>
                    <div class="col-sm-9">
                        <select name="fakultas" id="fakultas" class="form-control">
                            <option value="" selected disabled>Pilih Fakultas</option>
                            <?php $__currentLoopData = $list_fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $fakultas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item); ?>"><?php echo e($fakultas); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Prodi</label>
                    <div class="col-sm-9">
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="" selected disabled>Pilih Prodi</option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <select name="jk" id="jk" class="form-control">
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <?php $__currentLoopData = $jk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $is_jk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"><?php echo e($is_jk); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                    <select name="agama" id="agama" class="form-control">
                        <option value="" selected disabled>Pilih Agama</option>
                        <?php $__currentLoopData = $list_agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $is_agama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item); ?>"><?php echo e($is_agama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input value="" type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Telpon</label>
                <div class="col-sm-9">
                    <input value="" type="number" class="form-control" name="no_telpon" id="no_telpon" required>
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
        $(document).on('click', '#edit-button', function(e){
            var user_id = $(this).data('user_id');
            var list_data = $.get("<?php echo e(url('pengguna/pegawai/ajax-get')); ?>/" + user_id);
            list_data.done(function(data){
                var mahasiswa = data.mahasiswa;
                var pegawai = data.pegawai;
                var html_prodi = '';
                if (mahasiswa != null) {
                    $('#npm').val(mahasiswa.npm);
                    $('#nama').val(mahasiswa.nama_mhs);
                    $('#fakultas').val(mahasiswa.fakultas);
                    $('#prodi').val(mahasiswa.prodi);
                    $('#agama').val(mahasiswa.agama);
                    $('#jk').val(mahasiswa.jenis_kelamin);
                    $('#tmpt_lahir').val(mahasiswa.tempat_lahir);
                    $('#tgl_lahir').val(mahasiswa.tgl_lahir);
                    $('#no_telpon').val(mahasiswa.no_tlpn);
                    if (mahasiswa.foto_mhs != null) {
                        $('.foto-name').css('display', 'block');
                        $('.foto-name').text(mahasiswa.foto_mhs);
                    }
                    $('#prodi').empty();
                    html_prodi += `<option selected disabled>Pilih Prodi</option>`;
                    $.each(prodi[mahasiswa.fakultas], function (key, val) { 
                        console.log(val);
                        html_prodi += `
                            <option value="${val.id}" ${(val.id == data.mahasiswa.prodi) ? 'selected' : ''}>${val.nama}</option>
                        `;
                    });
                    $('#prodi').append(html_prodi);
                }else{
                    $('#nidn').val(pegawai.nidn);
                    $('#nama').val(pegawai.nama_pegawai);
                    $('#fakultas').val(pegawai.faklutas);
                    $('#prodi').val(pegawai.prodi);
                    $('#agama').val(pegawai.agama);
                    $('#jk').val(pegawai.jenis_kelamin);
                    $('#tmpt_lahir').val(pegawai.tempat_lahir);
                    $('#tgl_lahir').val(pegawai.tgl_lahir);
                    $('#no_telpon').val(pegawai.no_hp);
                    if (pegawai.foto != null) {
                        $('.foto-name').css('display', 'block');
                        $('.foto-name').text(pegawai.foto);
                    }
                    $('#prodi').empty();
                    html_prodi += `<option selected disabled>Pilih Prodi</option>`;
                    $.each(prodi[pegawai.faklutas], function (key, val) { 
                        html_prodi += `
                            <option value="${val.id}" ${(val.id == data.pegawai.prodi) ? 'selected' : ''}>${val.nama}</option>
                        `;
                    });
                    $('#prodi').append(html_prodi);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.partials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/pengguna/profil.blade.php ENDPATH**/ ?>