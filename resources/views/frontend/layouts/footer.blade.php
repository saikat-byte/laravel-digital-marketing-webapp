    <!-- Footer -->
    <footer class="footer pt-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Footer Left Section -->
                <div class="col-lg-4 footer-left ">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/frontend/media/common/logo/logo.jpg') }}" alt="Cloudspace Solutions Logo">
                    </div>
                    <div class="subscribe-section">
                        <p class="text-muted footer-left-heading ">Join our newsletter to stay up to date on features
                            and releases.</p>
                        <form>
                            @csrf
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Enter Your Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Enter Your Email">
                                </div>
                            </div>
                            <button type="submit" class="gradient-glow-button w-100">SUBSCRIBE</button>
                            <p class="mt-2 small text-muted">
                                By subscribing you agree to our <a href="#" class="text-primary">Privacy Policy</a> and
                                provide consent to receive updates from our company.
                            </p>
                        </form>
                    </div>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>

                <!-- Footer Right Section -->
                <div class="col-lg-8 col-sm-12 footer-right">
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>LOREM IPSUM</h6>
                            <ul>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                            </ul>
                        </div>
                        <!-- Column 2 -->
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>LOREM IPSUM</h6>
                            <ul>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                            </ul>
                        </div>
                        <!-- Column 3 -->
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>LOREM IPSUM</h6>
                            <ul>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                            </ul>
                        </div>
                        <!-- Column 4 -->
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <h6>LOREM IPSUM</h6>
                            <ul>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                                <li class="pt-3"><a href="#">Lorem Ipsum</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer Section -->
            <div class="bottom-footer d-flex justify-content-start mt-4">
                <p>© 2024 CLOUDSPACE SOLUTIONS. ALL RIGHT RESERVED.</p>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
            </div>
        </div>
    </footer>
