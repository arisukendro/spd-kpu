<li class="nav-item">
    <a href="<?=site_url('surattugas')?>" class="nav-link <?=url_is('surattugas')? 'active':''?> ">
        <i class="nav-icon fas fa-edit text-warning"></i>
        <p>
            Surat Tugas
        </p>
    </a>
</li>


<li class="nav-item ">
    <a href="<?=site_url('spd')?>" class="nav-link <?=url_is('spd')? 'active':''?> ">
        <i class="nav-icon fas fa-car text-warning"></i>
        <p>
            Surat Perintah Dinas
        </p>
    </a>
</li>

<li class="nav-header text-bold ">MASTER DATA</li>
<li class="nav-item">
    <a href="<?=site_url('lokasi')?>" class="nav-link <?=url_is('lokasi')? 'active':''?> ">
        <i class="nav-icon fa fa-map"></i>
        <p>
            Data Lokasi
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('pegawai')?>" class="nav-link <?=url_is('pegawai')? 'active':''?> ">
        <i class="nav-icon fa fa-users"></i>
        <p>
            Data Pegawai
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('libur')?>" class="nav-link <?=url_is('libur')? 'active':''?> ">
        <i class="nav-icon fa fa-calendar "></i>
        <p>
            Data Hari Libur
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('klompeg')?>" class="nav-link <?=url_is('klompeg')? 'active':''?> ">
        <i class="nav-icon fa fa-tshirt"></i>
        <p>
            Kelompok Pegawai
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('subbag')?>" class="nav-link <?=url_is('subbag')? 'active':''?> ">
        <i class="nav-icon fa fa-coffee"></i>
        <p>
            Data Subbag/Divisi
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('jabatan')?>" class="nav-link <?=url_is('jabatan')? 'active':''?> ">
        <i class="nav-icon fa fa-university "></i>
        <p>
            Data Jabatan
        </p>
    </a>
</li>

<li class="nav-header text-bold ">PENGATURAN</li>
<?php if (in_groups('admin') OR in_groups('super')) : ?>

<li class="nav-item">
    <a href="<?=site_url('users')?>" class="nav-link <?=url_is('users')? 'active':''?> ">
        <i class="nav-icon fa fa-user-circle"></i>
        <p>
            Users
        </p>
    </a>
</li>
<?php endif ?>

<li class="nav-item">
    <a href="<?=site_url('penandatangan')?>" class="nav-link <?=url_is('penandatangan')? 'active':''?> ">
        <i class="nav-icon fas fa-tree"></i>
        <p>
            Pejabat Penandatangan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?=site_url('template')?>" class="nav-link <?=url_is('template')? 'active':''?> ">
        <i class="nav-icon fa fa-cog"></i>
        <p>
            Template Surat Tugas
        </p>
    </a>
</li>