<div>
    <!-- footer -->
    <footer>
        <div class="outer-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <img src="{{ asset('storage/' . $WebsiteInformations->image) }}" alt="" width="100">
                        <p class="mt-4 footer-about">{{ $WebsiteInformations->fabout }}</p>
                    </div>
                    <div class="col-12 col-md-3 mt-4 mt-md-0">
                        <div class="outer-footer__content">
                            <div class="outer-footer__list-wrap">
                                <span class="outer-footer__content-title">Our Company</span>
                                <ul>
                                    <li>
                                        <a href="{{ route('blog') }}">Our Blog</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mt-4 mt-md-0">
                        <div class="outer-footer__content">
                            <span class="outer-footer__content-title">Contact Us</span>
                            <div class="outer-footer__text-wrap"><i class="fas fa-home"></i>
                                <span>{{ $WebsiteInformations->address }}</span>
                            </div>
                            <div class="outer-footer__text-wrap"><i class="fas fa-phone-volume"></i>
                                <span>{{ $WebsiteInformations->number }}</span>
                            </div>
                            <div class="outer-footer__text-wrap"><i class="far fa-envelope"></i>
                                <span>{{ $WebsiteInformations->gmail }}</span>
                            </div>
                            <div class="outer-footer__social">
                                <ul>
                                    <li>
                                        <a class="s-fb--color-hover" target="_blank" href="{{ $WebsiteInformations->facebook }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="s-tw--color-hover" target="_blank" href="{{ $WebsiteInformations->twitter }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="s-linked--color-hover" target="_blank" href="{{ $WebsiteInformations->linkedin }}">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="s-insta--color-hover" target="_blank" href="{{ $WebsiteInformations->instragram }}">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="s-youtube--color-hover" target="_blank" href="{{ $WebsiteInformations->youtube }}">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-lg-flex justify-content-between mb-0 d-block">
                    <p class="mb-0 text-center text-uppercase">COPYRIGHT © 2021. All Rights Reserved By <a class="ref color-orange" href="https://www.boinama.com/">boinama.com</a></p>
                    <p class="mb-0 text-center">DESIGN AND DEVELOPED BY <a class="ref color-orange" target="_blank" href="http://www.creativesheba.com/">CREATIVE SHEBA</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end  -->
</div>
