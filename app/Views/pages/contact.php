<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Contact Us</h1>
            <p class="section-subtitle">Get in touch to discuss your club building and fitting needs</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 3rem; margin-bottom: 3rem;">
            <!-- Contact Info -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Get In Touch</h3>
                <p style="margin-bottom: 2rem; color: #666;">Ready to transform your golf game? Call us to discuss your project and schedule your appointment.</p>
                
                <div style="margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <div style="font-size: 1.5rem; margin-right: 1rem;">📞</div>
                        <div>
                            <h4 style="margin: 0; color: var(--deep-green);">Phone</h4>
                            <a href="tel:7173871643" style="color: #333; text-decoration: none; font-size: 1.2rem; font-weight: 600;">(717) 387-1643</a>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <div style="font-size: 1.5rem; margin-right: 1rem;">📧</div>
                        <div>
                            <h4 style="margin: 0; color: var(--deep-green);">Email</h4>
                            <a href="mailto:Daniel@Golfclub-builders.com" style="color: #333; text-decoration: none; font-size: 1.1rem;">Daniel@Golfclub-builders.com</a>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                        <div style="font-size: 1.5rem; margin-right: 1rem;">📍</div>
                        <div>
                            <h4 style="margin: 0; color: var(--deep-green);">Location</h4>
                            <p style="margin: 0; color: #333;">254 Farmington Road<br>Chambersburg, PA 17202</p>
                        </div>
                    </div>
                </div>
                
                <div style="background: var(--light); padding: 1.5rem; border-radius: 8px;">
                    <h4 style="margin-bottom: 1rem; color: var(--deep-green);">Call Hours</h4>
                    <p style="margin: 0; color: #333; font-weight: 600;">Monday - Friday: 9:00 AM - 5:00 PM ET</p>
                    <p style="margin: 0.5rem 0 0 0; color: #666;">Weekend calls by appointment only</p>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Send Us a Message</h3>
                <p style="margin-bottom: 2rem; color: #666;">Have a question or want to discuss your project? Fill out the form below and we'll get back to you.</p>
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #c3e6cb;">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= base_url('/contact/submit') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Name *</label>
                        <input type="text" id="name" name="name" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Email *</label>
                        <input type="email" id="email" name="email" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Phone</label>
                        <input type="tel" id="phone" name="phone" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
                    </div>
                    
                    <div style="margin-bottom: 2rem;">
                        <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Message *</label>
                        <textarea id="message" name="message" rows="5" required 
                                  style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 1rem;">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Service Areas -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Service Areas</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Primary Service Area</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Chambersburg, PA</li>
                        <li style="margin-bottom: 0.5rem;">✓ Surrounding areas</li>
                        <li style="margin-bottom: 0.5rem;">✓ In-home service</li>
                    </ul>
                </div>
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Extended Service</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Anyone willing to drive</li>
                        <li style="margin-bottom: 0.5rem;">✓ Call to discuss distance</li>
                        <li style="margin-bottom: 0.5rem;">✓ Travel fees may apply</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div style="text-align: center; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; padding: 3rem; border-radius: 12px;">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Get Started?</h2>
            <p style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Call us today to discuss your club building or fitting needs.</p>
            <a href="tel:7173871643" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem; background: white; color: var(--deep-green); border: none;">
                📞 Call (717) 387-1643
            </a>
        </div>
    </div>
</section>
