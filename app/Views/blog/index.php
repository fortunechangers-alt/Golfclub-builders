<!-- Policy Banner -->
<div class="policy-banner" style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section blog-section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Golf Education Blog</h1>
            <p class="section-subtitle">Expert insights on club fitting, shaft selection, and golf equipment</p>
        </div>
        
        <!-- Featured Post -->
        <?php if (!empty($posts)): ?>
        <?php $featured = array_filter($posts, function($post) { return $post['featured']; }); ?>
        <?php if (!empty($featured)): ?>
        <?php $featured = array_values($featured)[0]; ?>
        <div class="card featured-post-card" style="margin-bottom: 3rem; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; overflow: hidden;">
            <div class="featured-post-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                <div>
                    <div style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 20px; display: inline-block; margin-bottom: 1rem; font-size: 0.9rem; font-weight: 600;">
                        FEATURED POST
                    </div>
                    <h2 style="color: white; margin-bottom: 1rem; font-size: 2.5rem;"><?= $featured['title'] ?></h2>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem; font-size: 1.1rem;"><?= $featured['excerpt'] ?></p>
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 2rem;">
                        <span style="color: rgba(255,255,255,0.8);"><?= date('M j, Y', strtotime($featured['date'])) ?></span>
                        <span style="color: rgba(255,255,255,0.8);">•</span>
                        <span style="color: rgba(255,255,255,0.8);"><?= $featured['read_time'] ?></span>
                    </div>
                    <a href="<?= base_url('/blog/' . $featured['slug']) ?>" class="btn btn-primary" style="background: white; color: var(--deep-green); border: none; font-weight: 600;">
                        Read Article →
                    </a>
                </div>
                <div style="background: rgba(255,255,255,0.1); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 4rem; overflow: hidden;">
                    <?php if (isset($featured['thumbnail']) && !empty($featured['thumbnail'])): ?>
                        <img src="<?= base_url('images/' . $featured['thumbnail']) ?>" 
                             alt="<?= htmlspecialchars($featured['title']) ?>" 
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;"
                             loading="lazy">
                    <?php else: ?>
                        📚
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        
        <!-- Blog Posts Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <?php foreach ($posts as $post): ?>
            <div class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;" onclick="window.location.href='<?= base_url('/blog/' . $post['slug']) ?>'">
                <div style="background: var(--light); height: 200px; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 3rem; overflow: hidden;">
                    <?php if (isset($post['thumbnail']) && !empty($post['thumbnail'])): ?>
                        <img src="<?= base_url('images/' . $post['thumbnail']) ?>" 
                             alt="<?= htmlspecialchars($post['title']) ?>" 
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;"
                             loading="lazy">
                    <?php else: ?>
                        📖
                    <?php endif; ?>
                </div>
                
                <h3 style="margin-bottom: 1rem; color: var(--deep-green); line-height: 1.3;"><?= $post['title'] ?></h3>
                <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;"><?= $post['excerpt'] ?></p>
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span style="color: #999; font-size: 0.9rem;"><?= date('M j, Y', strtotime($post['date'])) ?></span>
                    <span style="color: #999; font-size: 0.9rem;"><?= $post['read_time'] ?></span>
                </div>
                
                <a href="<?= base_url('/blog/' . $post['slug']) ?>" style="color: var(--deep-green); text-decoration: none; font-weight: 600;">
                    Read More →
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Categories -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Topics We Cover</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div style="padding: 1rem; background: var(--light); border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">⚖️</div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--deep-green);">Swing Weight</h4>
                    <p style="color: #666; font-size: 0.9rem;">Understanding club balance</p>
                </div>
                <div style="padding: 1rem; background: var(--light); border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏹</div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--deep-green);">Shaft Flex</h4>
                    <p style="color: #666; font-size: 0.9rem;">Finding your perfect stiffness</p>
                </div>
                <div style="padding: 1rem; background: var(--light); border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏌️</div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--deep-green);">Iron Types</h4>
                    <p style="color: #666; font-size: 0.9rem;">Blades, cavities, and more</p>
                </div>
                <div style="padding: 1rem; background: var(--light); border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔧</div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--deep-green);">Club Building</h4>
                    <p style="color: #666; font-size: 0.9rem;">Technical insights</p>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div style="text-align: center; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; padding: 3rem; border-radius: 12px;">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Apply What You've Learned?</h2>
            <p style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Book a fitting or club build to put these insights into practice.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:7173871643" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem; background: white; color: var(--deep-green); border: none;">
                    📞 Call (717) 387-1643
                </a>
                <a href="<?= base_url('/fitting') ?>" class="btn btn-outline" style="font-size: 1.1rem; padding: 1rem 2rem; border-color: white; color: white;">
                    Book Fitting
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
</style>
