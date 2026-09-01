

<?php $__env->startSection('title', 'Tentang'); ?>

<?php $__env->startSection('content'); ?>

<style>
body { background-color: #fff8ed; }

.tentang-container {
    background:#fff3dc;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(107,66,38,.1);
}

.profile-header {
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:20px;
}

.profile-photo {
    width:100px;
    height:100px;
    min-width:100px; /* Menjaga ukuran agar tidak menyusut */
    min-height:100px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #8b5e34;
    background-color: #f1dfc2;
}

.profile-name {
    color:#6b4226;
    font-weight:800;
    margin:0;
}

.profile-role {
    color:#8b5e34;
    font-weight:600;
    margin:0;
}

.info-card {
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    margin-bottom:16px;
}

.info-card h5 {
    color:#6b4226;
    font-weight:700;
    border-bottom:2px solid #f1dfc2;
    padding-bottom:10px;
    margin-bottom:14px;
}

.info-row {
    display:flex;
    gap:10px;
    margin-bottom:8px;
}

.info-label {
    min-width:130px;
    font-weight:600;
    color:#6b4226;
}

.social-link {
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#8b5e34;
    color:white;
    padding:8px 16px;
    border-radius:10px;
    text-decoration:none;
    margin-right:8px;
    margin-bottom:8px;
}

.social-link:hover {
    background:#6f451f;
    color:white;
}
</style>

<div class="container my-4">
    <div class="tentang-container">

        <div class="profile-header">
            
            <img 
                src="<?php echo e(asset('images/foto-profil.jpg')); ?>" 
                alt="Foto Profil" 
                class="profile-photo"
                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Milan+Zhahira&background=8b5e34&color=ffffff&size=128';"
            >
            <div>
                <h1 class="profile-name">Milan Zhahira Sidiq</h1>
                <p class="profile-role">Aplikasi POS Milan</p>
            </div>
        </div>

        <div class="info-card">
            <h5>👋 Tentang Saya</h5>
            <p class="mb-0">
                Saya Milan, siswa SMKN 4 yang saat ini sedang mempersiapkan diri menghadapi
                Uji Kompetensi (Ujikom). Melalui program ini, saya berlatih menerapkan ilmu
                yang telah dipelajari di kelas ke dalam sebuah proyek nyata, salah satunya
                adalah aplikasi POS Milan ini. Target saya adalah lulus dengan nilai yang baik
                dan terus mengembangkan kemampuan di bidang pemrograman.
            </p>
        </div>

        <div class="info-card">
            <h5>🎓 Pendidikan</h5>
            <div class="info-row">
                <span class="info-label">Institusi</span>
                <span>: SMKN 4 TASIKMALAYA</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jurusan</span>
                <span>: PPLG (PENGEMBANGAN PERANGKAT LUNAK & GIM)</span>
            </div>
             <div class="info-row">
                <span class="info-label">Kelas</span>
                <span>: XII PPLG 4</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tahun</span>
                <span>: 2024 - 2027</span>
            </div>
            <div class="info-row">
                <span class="info-label">NISN</span>
                <span>: 242510300</span>
            </div>
        </div>

        <div class="info-card">
            <h5>📞 Kontak</h5>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span>: emailkamu@example.com</span>
            </div>
            <div class="info-row">
                <span class="info-label">WhatsApp</span>
                <span>: 08xx-xxxx-xxxx</span>
            </div>
        </div>

        <div class="info-card">
            <h5>🔗 Sosial Media</h5>
            <a href="https://instagram.com/mimillannn" target="_blank" class="social-link">
                <i class="bi bi-instagram"></i> Instagram
            </a>
            <a href="https://github.com/MILANN_POS" target="_blank" class="social-link">
                <i class="bi bi-github"></i> GitHub
            </a>
            <a href="https://wa.me/62812xxxxxxx" target="_blank" class="social-link">
                <i class="bi bi-whatsapp"></i> WhatsApp
            </a>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/tentang.blade.php ENDPATH**/ ?>