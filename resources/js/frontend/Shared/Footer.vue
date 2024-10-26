<template>
    <!-- footer-area start -->
    <footer class="bg-fff bt">
        <div class="footer-top-area bb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div
                                class="footer-logo mb-25 d-flex justify-content-center"
                            >
                                <img
                                    src="/frontend/assets/images/logo/logo.png"
                                    alt=""
                                    height="100"
                                    width="100"
                                />
                            </div>
                            <div class="footer-content">
                                <p>
                                    To discover, develop, and deliver innovative
                                    ideas that help perpetuate people, feeling
                                    like they matter by providing them with
                                    modern, fashionable products globally.
                                </p>
                                <ul>
                                    <li>
                                        <a
                                            href="https://www.facebook.com/profile.php?id=61559927879097"
                                            target="_blank"
                                            data-bs-toggle="tooltip"
                                            title="Facebook"
                                            ><i class="fa fa-facebook"></i
                                        ></a>
                                    </li>
                                    <!-- <li>
                                      <a href="#" data-bs-toggle="tooltip" title="Twetter"><i
                                              class="fa fa-twitter"></i></a>
                                  </li> -->
                                    <li>
                                        <a
                                            href="https://www.instagram.com/satrani56/"
                                            target="_blank"
                                            data-bs-toggle="tooltip"
                                            title="Instagram"
                                            ><i class="fa fa-instagram"></i
                                        ></a>
                                    </li>
                                    <!-- <li>
                                      <a href="#" data-bs-toggle="tooltip" title="Google-Plus"><i
                                              class="fa fa-google-plus"></i></a>
                                  </li>
                                  <li>
                                      <a href="#" data-bs-toggle="tooltip" title="Linkedin"><i
                                              class="fa fa-linkedin"></i></a>
                                  </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="footer-title bb mb-20 pb-15">
                                About Us
                            </h3>
                            <ul>
                                <li>
                                    <div class="contuct-content">
                                        <div class="contuct-icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="contuct-info">
                                            <span
                                                >Baekmolla, 60fet,mirpur-2,Dhaka
                                                1216.</span
                                            >
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contuct-content">
                                        <div class="contuct-icon">
                                            <i class="fa fa-fax"></i>
                                        </div>
                                        <div class="contuct-info">
                                            <span>+880 1402 554 376</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contuct-content">
                                        <div class="contuct-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="contuct-info">
                                            <span>satrani2024@gmail.com</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title bb mb-20 pb-15">
                                Information
                            </h3>
                            <div class="footer-menu home3-hover">
                                <ul class="menu-list">
                                    <li>
                                        <Link
                                            href="/"
                                            :class="{
                                                'active-link':
                                                    $page.url === '/',
                                            }"
                                            >Home
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url === '/about-us',
                                            }"
                                            href="/about-us"
                                            >About Us</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url ===
                                                    '/terms-and-conditions',
                                            }"
                                            href="/terms-and-conditions"
                                            >Terms & Conditions</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url ===
                                                    '/return-and-refund',
                                            }"
                                            href="/return-and-refund"
                                            >Return & Refund</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :class="{
                                                'active-link':
                                                    $page.url === '/contact-us',
                                            }"
                                            href="/contact-us"
                                            >Contact us</Link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom ptb-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright">
                            <p>
                                Dveloped by
                                <a
                                    href="https://modernitsbd.com"
                                    title="Modern IT Solutions Bangladesh"
                                    >Modern IT Solutions Bangladesh</a
                                >
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mayment text-end">
                            <a href="#">
                                <img
                                    src="frontend/assets/images/p14.png"
                                    alt=""
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area end -->
</template>

<script>
export default {};
</script>

<style></style>
