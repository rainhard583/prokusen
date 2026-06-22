</div>
            <!-- =========== END MAIN CONTENT =========== -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Sistem Penjualan Kusen & Cat <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- jQuery -->
<script src="<?= base_url('Assets/vendor/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap -->
<script src="<?= base_url('Assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- jQuery Easing -->
<script src="<?= base_url('Assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- SB Admin 2 JS -->
<script src="<?= base_url('Assets/js/sb-admin-2.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?= base_url('Assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('Assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('Assets/js/sweetalert2.min.js') ?>"></script>

<!-- SweetAlert Flashdata -->
<?php if (session()->getFlashdata('success')) : ?>
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil', text: '<?= session()->getFlashdata('success') ?>' });
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
<script>
    Swal.fire({ icon: 'error', title: 'Gagal', text: '<?= session()->getFlashdata('error') ?>' });
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
<script>
    Swal.fire({ icon: 'warning', title: 'Peringatan', text: '<?= session()->getFlashdata('warning') ?>' });
</script>
<?php endif; ?>

<!-- =========================================
     LOGIN SUCCESS ALERT
     Muncul 1x setelah admin berhasil login
     Hilang otomatis dalam 2 detik
========================================= -->
<?php if (session()->getFlashdata('login_success')) : ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: '<?= session()->getFlashdata('login_success') ?>',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    });
</script>
<?php endif; ?>

</body>
</html>