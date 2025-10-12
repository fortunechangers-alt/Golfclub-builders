<div class="blog-post">
    <div class="blog-header">
        <h1><?= $post['title'] ?></h1>
        <div class="blog-meta">
            <span class="date"><?= date('F j, Y', strtotime($post['date'])) ?></span>
            <span class="read-time"><?= $post['read_time'] ?></span>
        </div>
    </div>
    
    <div class="blog-content">
        <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Rosa's Choice: Between Pride and Peace</h2>
        
        <p>She kept them as if they were a promise—polished thin‑top blades in a sun‑worn headcover, the kind that make golfers whisper when you set one behind the ball. "They were my dad's," Rosa said, laying the 7‑iron on the bench. "I'm not ready to give up the look." Her voice had that mix of pride and fatigue you hear when someone's been playing brave golf with the wrong tool for longer than they'll admit.</p>

        <p>We let the room go quiet the way we always do before a good decision. Grips, epoxy, ferrules. The launch monitor blinking to life. I put a little strip of impact tape on her blade and one on a compact cavity‑back that matched it for length and lie. Same shaft weight and flex. Same swing weight. If we're going to tell the truth, we let the head do the talking.</p>

        <p>Rosa's best with the blade was art—flight lower than the clouds, pin‑high like a ruler had drawn it there. But when she was a hair late or a touch thin, the ball fell out of the sky like it forgot how to be a golf ball. On the face tape, the mark lived half a groove low. She didn't swing badly; she swung like a human.</p>

        <p>Then we put the cavity‑back down. The address still looked honest to her eye—sleek enough, not a shovel, just a touch more sole and a little comfort in the chassis. The first slightly thin strike surprised her. It climbed instead of pleading, carried the front edge, and rolled to the middle like it belonged. She looked at the face, then at me, and laughed that half‑disbelieving laugh golfers make when mercy shows up where punishment used to live.</p>

        <p>Here's the plain truth, without the catalog poetry:</p>

        <ul>
            <li><strong>Blades (muscle‑backs)</strong> are compact, thin‑soled, with minimal offset and mass concentrated behind the center. They reward centered strikes with workability and feedback that feels like a secret handshake. When you miss, they tell the truth fast.</li>
            <li><strong>Cavity‑backs</strong> move more mass to the perimeter. That raises MOI (resistance to twisting), makes the sweet spot bigger, and keeps ball speed and launch from collapsing on ordinary misses. They're not training wheels; they're forgiveness where you live most often.</li>
        </ul>

        <p>Most golfers don't need a sermon; they need a mirror. If your strike already spends its days on the middle groove and you like drawing and fading shots on purpose, blades will sing to you. If your contact wanders low on a Tuesday after work, a cavity‑back won't scold you for being human. The modern ones aren't those chunky shovels you remember—they can look calm behind the ball and glide through turf without the dig‑and‑doom you're afraid of.</p>

        <p>We watched Rosa's swings like a story unfolding. With the blade, the best ball was a photograph you keep in your wallet. With the cavity‑back, the pattern got kind. The thin miss climbed enough to matter. The toe‑side nibble didn't yank the shot into exile. Turf went from grabby to glide. Nothing was dramatic; everything was better. And that's the line I trust in this work: dramatic is for highlights, better is for scorecards.</p>

        <p>She asked the questions everyone asks, and I gave the answers I always keep close:</p>

        <ul>
            <li><strong>"Will I lose workability?"</strong> If you already control the center of the face, you can still curve a cavity‑back; the ball listens because you struck it, not because the head is snobbish. If you don't hit the middle, "workability" mostly means the ball works away from your target.</li>
            <li><strong>"Do cavity‑backs fly too high?"</strong> Many are tuned to launch a touch higher, which is a feature when you need help. We watch your spin and descent angle—if the ball stops on a real green, the window is right. If not, we pick a model/loft that tells the truth.</li>
            <li><strong>"What about feel?"</strong> Blades do talk—clean, immediate feedback. But feel today is closer than it used to be; forging methods, face constructions, and polymers have narrowed the gap. The best cavity‑backs don't sound clattery; they sound complete when you catch one.</li>
            <li><strong>"Turf?"</strong> A bit more sole can save you from digging; a bit less can save you from bouncing. We choose sole width and bounce for your delivery, not for a photograph.</li>
        </ul>

        <p>We finished by making small, unromantic decisions—the kind good golf lives on. A lie angle that kept the toe from writing its own plot. A swing weight that let her feel the head without the head bossing her around. A shaft profile that matched her tempo so she didn't have to swing angrier just to wake the club up. None of it loud. All of it necessary.</p>

        <p>Then the moment I'll remember: she set a cavity‑back 7‑iron down, took a breath, and hit three that looked like sisters—same window, same fall, same hush after they landed. She slipped the old blade back into her bag with a gentleness you reserve for heirlooms. "I won't forget them," she said, "but I'm tired of apologizing to my irons." That's the day you change: not when you choose power over poetry, but when you realize forgiveness has its own kind of beauty.</p>

        <p>If you're living between pride and peace—if you love the look of a thin top line but your Mondays and Fridays aren't your Saturdays—let us put both dreams on the mat. We'll test where your strike really lives, watch how the turf treats you, and choose the head that makes your average shot better without stealing your best. Keep the romance. Add the mercy. Play golf that loves you back.</p>

        <p>When you're ready, call <strong>(717) 387‑1643</strong> and ask for a Blade vs Cavity‑Back session. In‑home, appointment‑only. We'll bring the truth; you bring the swing you already own.</p>
    </div>
    
    <div class="blog-cta">
        <h3>Ready to Find Your Perfect Iron Type?</h3>
        <p>Let our professional fitting help you choose between blades and cavity-back irons based on your strike pattern and preferences.</p>
        <div class="cta-buttons">
            <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary">Book Iron Fitting</a>
            <a href="tel:7173871643" class="btn btn-outline">Call (717) 387-1643</a>
        </div>
    </div>
</div>

<style>
.blog-post {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    line-height: 1.7;
}

.blog-header {
    margin-bottom: 3rem;
    text-align: center;
    border-bottom: 2px solid var(--gold);
    padding-bottom: 2rem;
}

.blog-header h1 {
    color: var(--deep-green);
    font-size: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.blog-meta {
    display: flex;
    justify-content: center;
    gap: 2rem;
    color: #666;
    font-size: 0.9rem;
}

.blog-content {
    font-size: 1.1rem;
    color: #333;
}

.blog-content h2 {
    color: var(--deep-green);
    margin: 3rem 0 1.5rem 0;
    font-size: 1.8rem;
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content ul {
    margin: 2rem 0;
    padding-left: 2rem;
}

.blog-content li {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.blog-content strong {
    color: var(--deep-green);
}

.blog-cta {
    background: linear-gradient(135deg, var(--navy-blue), #0d2a5c);
    color: white;
    padding: 3rem 2rem;
    border-radius: 12px;
    text-align: center;
    margin-top: 4rem;
}

.blog-cta h3 {
    color: white;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.blog-cta p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    color: rgba(255,255,255,0.9);
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .blog-post {
        padding: 1rem;
    }
    
    .blog-header h1 {
        font-size: 2rem;
    }
    
    .blog-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
}
</style>
