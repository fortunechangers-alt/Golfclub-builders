    </main>
    
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-content">
                <!-- Brand Section -->
                <div class="footer-brand">
                    <picture>
                        <source srcset="<?= base_url('images/logo-banner.webp') ?>" type="image/webp">
                        <img src="<?= base_url('images/logo-banner.png') ?>" alt="Golf Club Builders" loading="lazy" class="footer-logo-img">
                    </picture>
                    <p class="brand-description">Professional club building, fitting, and simulator services. In-home workshop serving Chambersburg and surrounding areas.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.928.875 1.418 2.026 1.418 3.323s-.49 2.448-1.418 3.244c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.281H7.83c-.49 0-.928.438-.928.928v7.83c0 .49.438.928.928.928h8.449c.49 0 .928-.438.928-.928v-7.83c0-.49-.438-.928-.928-.928z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="footer-column">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/') ?>" class="footer-link">Home</a></li>
                        <li><a href="<?= base_url('/about') ?>" class="footer-link">About Us</a></li>
                        <li><a href="<?= base_url('/contact') ?>" class="footer-link">Contact</a></li>
                        <li><a href="<?= base_url('/blog') ?>" class="footer-link">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Services Column -->
                <div class="footer-column" style="padding-right: 3rem; margin-left: -1rem;">
                    <h3 class="footer-title">Services</h3>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/custom-club-building') ?>" class="footer-link">Club Building</a></li>
                        <li><a href="<?= base_url('/fitting') ?>" class="footer-link">AI Fitting</a></li>
                        <li><a href="<?= base_url('/simulator') ?>" class="footer-link">Simulator Rental</a></li>
                        <li><a href="<?= base_url('/blog') ?>" class="footer-link">Education</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="footer-contact">
                    <h3 class="footer-title">Get In Touch</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Email</span>
                                <a href="mailto:Daniel@Golfclub-builders.com" class="contact-value">Daniel@Golfclub-builders.com</a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Phone</span>
                                <a href="tel:7173871643" class="contact-value">(717) 387-1643</a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Location</span>
                                <span class="contact-value">254 Farmington Road<br>Chambersburg, PA 17202</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">&copy; <?= date('Y') ?> Golf Club Builders. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="<?= base_url('/privacy') ?>" class="legal-link">Privacy Policy</a>
                    <span class="legal-separator">•</span>
                    <a href="<?= base_url('/terms') ?>" class="legal-link">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Main JavaScript -->
    <script src="<?= base_url('js/main.js?v=2.3') ?>"></script>
    
    <!-- Additional page-specific scripts -->
    <?php if (isset($additionalScripts)): ?>
        <?= $additionalScripts ?>
    <?php endif; ?>
</body>
</html>

