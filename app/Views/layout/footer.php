    </main>
    
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <img src="<?= base_url('images/logo-small.png') ?>" alt="Golf Club Builders" style="width: 80px; height: auto; margin-bottom: 1rem;">
                <h3>Golf Club Builders</h3>
                <p>Elevating your golf game with AI-assisted club fittings and professional regripping services.</p>
                <div class="social-links" style="margin-top: 1.5rem;">
                    <a href="#" style="color: rgba(255,255,255,0.8); margin-right: 1rem; text-decoration: none;">Facebook</a>
                    <a href="#" style="color: rgba(255,255,255,0.8); margin-right: 1rem; text-decoration: none;">Instagram</a>
                    <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">Twitter</a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="<?= base_url('/') ?>">Home</a></li>
                    <li><a href="<?= base_url('/services') ?>">Services</a></li>
                    <li><a href="<?= base_url('/shop') ?>">Shop</a></li>
                    <li><a href="<?= base_url('/about') ?>">About Us</a></li>
                    <li><a href="<?= base_url('/contact') ?>">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="<?= base_url('/services/ai-club-fitting') ?>">AI Club Fitting</a></li>
                    <li><a href="<?= base_url('/services/regripping') ?>">Professional Regripping</a></li>
                    <li><a href="<?= base_url('/booking') ?>">Book Appointment</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="footer-links">
                    <li>📧 info@golfbuilders.com</li>
                    <li>📞 (555) 123-4567</li>
                    <li>📍 123 Golf Course Dr<br>&nbsp;&nbsp;&nbsp;&nbsp;Your City, ST 12345</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Golf Builders. All rights reserved. | <a href="<?= base_url('/privacy') ?>" style="color: rgba(255,255,255,0.6);">Privacy Policy</a> | <a href="<?= base_url('/terms') ?>" style="color: rgba(255,255,255,0.6);">Terms of Service</a></p>
        </div>
    </footer>
    
    <!-- Main JavaScript -->
    <script src="<?= base_url('js/main.js') ?>"></script>
    
    <!-- Additional page-specific scripts -->
    <?php if (isset($additionalScripts)): ?>
        <?= $additionalScripts ?>
    <?php endif; ?>
</body>
</html>

