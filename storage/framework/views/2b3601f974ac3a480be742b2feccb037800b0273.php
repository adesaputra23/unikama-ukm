<?php
    use App\User;
?>
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-search">
            <?php if(Auth::user()->UserRole->id_role == User::ADMIN): ?>
                <img 
                    src="<?php echo e(asset('assets/images/avatar-0.png')); ?>" 
                    class="rounded mx-auto d-block"
                    alt="User-Profile-Image" 
                    style="width: 8rem; border: 3px solid rgb(104, 130, 237); border-radius: 4px;">
            <?php elseif(Auth::user()->UserRole->id_role == User::KEPALA_BAK || Auth::user()->UserRole->id_role == User::KAPRODI): ?>
                <img 
                    src="<?php echo e(empty(Auth::user()->Pegawai->foto) ? asset('assets/images/avatar-0.png') : asset('file_foto_profil').'/'.Auth::user()->Pegawai->foto); ?>" 
                    class="rounded mx-auto d-block"
                    alt="User-Profile-Image" 
                    style="width: 8rem; border: 3px solid rgb(104, 130, 237); border-radius: 4px;">
            <?php elseif(Auth::user()->UserRole->id_role == User::MAHASISWA): ?>
                <img 
                    src="<?php echo e(empty(Auth::user()->Mahasiswa->foto_mhs) ? asset('assets/images/avatar-0.png') : asset('file_foto_profil').'/'.Auth::user()->Mahasiswa->foto_mhs); ?>" 
                    class="rounded mx-auto d-block"
                    alt="User-Profile-Image" 
                    style="width: 8rem; border: 3px solid rgb(104, 130, 237); border-radius: 4px;">
            <?php endif; ?>
            <div class="text-center mt-2">
                <?php if(Auth::user()->UserRole->id_role == User::ADMIN): ?>
                    <dt class="text-center"><?php echo e(Auth::user()->name); ?></dt>
                <?php elseif(Auth::user()->UserRole->id_role == User::KEPALA_BAK || Auth::user()->UserRole->id_role == User::KAPRODI): ?>
                    <dt class="text-center"><?php echo e(Auth::user()->Pegawai->nama_pegawai); ?></dt>
                <?php elseif(Auth::user()->UserRole->id_role == User::MAHASISWA): ?>
                    <dt class="text-center"><?php echo e(Auth::user()->Mahasiswa->nama_mhs); ?></dt>
                <?php endif; ?>
                <dd class="text-center"><?php echo e(Auth::user()->UserRole->role_name); ?></dd>
            </div>
        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
        <?php if(Auth::user()->UserRole->id_role == User::ADMIN): ?>
            <ul class="pcoded-item pcoded-left-item">
                <li class="<?php echo e(Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-home" aria-hidden="true"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'ukm' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-square" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'kriteria' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('kriteria.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Kriteria</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'mahasiswa' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mahasiswa.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Mahasiswa</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'kaprodi' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('kaprodi.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Kaprodi</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'penilaian' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('penilaian.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Penilaian UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu <?php echo e(Request::segment(1) == 'pengguna' ? 'active pcoded-trigger' : ''); ?> ">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Pengguna</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?php echo e(Request::segment(2) == 'pegawai' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('pengguna.pegawai.index')); ?>">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Pagawai</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="<?php echo e(Request::segment(2) == 'mahasiswa' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('pengguna.mahasiswa.index')); ?>">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Mahasiswa</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>

            </ul>
        <?php elseif(Auth::user()->UserRole->id_role == User::KEPALA_BAK): ?>
            <ul class="pcoded-item pcoded-left-item">
                <li class="<?php echo e(Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'ukm' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-square" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'kriteria' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('kriteria.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Kriteria</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'mahasiswa' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mahasiswa.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Mahasiswa</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'kaprodi' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('kaprodi.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Kaprodi</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                 <li class="<?php echo e(Request::segment(1) == 'penilaian' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('penilaian.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Penilaian UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) === 'profil' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('profil')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Profil</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        <?php elseif(Auth::user()->UserRole->id_role == User::KAPRODI): ?>
            <ul class="pcoded-item pcoded-left-item">
                <li class="<?php echo e(Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'mahasiswa' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mahasiswa.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Mahasiswa</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'ukm' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) == 'penilaian' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('penilaian.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Penilaian UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) === 'profil' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('profil')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Profil</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        <?php elseif(Auth::user()->UserRole->id_role == User::MAHASISWA): ?>
            <ul class="pcoded-item pcoded-left-item">
                <li class="<?php echo e(Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(2) === 'penilaian' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.penilaian')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Penilaian UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(2) === 'rekomendasi' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.rekomendasi')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Rekomendasi UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) === 'ukm' && Request::segment(2) === 'index' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('ukm.index')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">UKM</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="<?php echo e(Request::segment(1) === 'profil' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('profil')); ?>">
                        <span class="pcoded-micon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Profil</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/template/partial_nav_right.blade.php ENDPATH**/ ?>