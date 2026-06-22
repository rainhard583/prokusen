<!-- FOOTER -->
<footer class="footer">

    <div class="footer-grid">

        <!-- LOGO -->
        <div>

            <div class="footer-logo">

                <img src="<?= base_url('logo_png.png') ?>"
                     alt="PSG Logo"
                     class="main-logo">

                <div class="logo-text">

                    <strong style="
                        color:white;
                        font-size:13px;
                    ">

                        PUTRA SUMEDANG GRUB

                    </strong>

                    <span>

                        KUSEN & CAT TERPERCAYA

                    </span>

                </div>

            </div>

            <p>

                Menyediakan berbagai macam kusen berkualitas tinggi
                dan cat tembok terbaik untuk rumah impian Anda.

            </p>

            <a href="https://wa.me/6281234567890"
               class="footer-wa"
               target="_blank">

                <i class="fa-brands fa-whatsapp"></i>

                Chat WhatsApp

            </a>

        </div>


        <!-- MENU -->
        <div>

            <h4>Menu</h4>

            <ul>

                <li>

                    <a href="<?= base_url('/') ?>">

                        Beranda

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user') ?>">

                        Produk

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('pesanan-user') ?>">

                        Buat Pesanan

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('riwayat') ?>">

                        Riwayat Pesanan

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('logout-user') ?>"
                       style="color:#f87171;">

                        Logout User

                    </a>

                </li>

            </ul>

        </div>


        <!-- KATEGORI -->
        <div>

            <h4>Kategori Produk</h4>

            <ul>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Kusen') ?>">

                        Kusen Pintu Kayu Jati

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Kusen') ?>">

                        Kusen Jendela Aluminium

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Kusen') ?>">

                        Kusen Pintu UPVC

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Cat') ?>">

                        Cat Tembok Interior

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Cat') ?>">

                        Cat Tembok Eksterior

                    </a>

                </li>

                <li>

                    <a href="<?= base_url('produk-user?kategori=Cat') ?>">

                        Cat Kayu & Besi

                    </a>

                </li>

            </ul>

        </div>


        <!-- KONTAK -->
        <div>

            <h4>Hubungi Kami</h4>

            <ul class="footer-contact">

                <li>

                    <i class="fa-solid fa-phone"></i>

                    0812-3456-7890

                </li>

                <li>

                    <i class="fa-brands fa-whatsapp"></i>

                    WhatsApp

                </li>

                <li>

                    <i class="fa-solid fa-envelope"></i>

                    admin@kusencat.com

                </li>

                <li>

                    <i class="fa-solid fa-location-dot"></i>

                    Jl. Raya Utama No. 123, Jakarta Selatan

                </li>

                <li>

                    <i class="fa-solid fa-clock"></i>

                    Senin – Sabtu: 08:00 – 17:00
                    <br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Minggu: Tutup

                </li>

            </ul>

        </div>

    </div>

    <div class="copyright">

        <span>

            © <?= date('Y') ?>
            Putra Sumedang Grub.
            Semua hak dilindungi.

        </span>

        <span>

            Dibuat dengan dedikasi
            untuk pelanggan kami.

        </span>

    </div>

</footer>

</body>
</html>