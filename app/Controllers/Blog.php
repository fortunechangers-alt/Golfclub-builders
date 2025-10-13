<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Blog extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Blog',
            'posts' => $this->getBlogPosts()
        ];
        
        return view('layout/header', $data)
             . view('blog/index', $data)
             . view('layout/footer', $data);
    }
    
    public function view($slug)
    {
        $posts = $this->getBlogPosts();
        $post = null;
        
        foreach ($posts as $p) {
            if ($p['slug'] === $slug) {
                $post = $p;
                break;
            }
        }
        
        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog post not found');
        }
        
        $data = [
            'title' => $post['title'],
            'post' => $post
        ];
        
        // Handle specific posts with custom views
        if ($slug === 'players-vs-game-improvement-irons') {
            return view('layout/header', $data)
                 . view('blog/players-vs-game-improvement-irons', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'finding-the-right-shaft-flex') {
            return view('layout/header', $data)
                 . view('blog/finding-the-right-shaft-flex', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'why-swing-weight-matters') {
            return view('layout/header', $data)
                 . view('blog/why-swing-weight-matters', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'signs-you-need-different-shaft-flex') {
            return view('layout/header', $data)
                 . view('blog/signs-you-need-different-shaft-flex', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'choosing-shaft-flex-by-swing-speed') {
            return view('layout/header', $data)
                 . view('blog/choosing-shaft-flex-by-swing-speed', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'players-distance-irons-explained') {
            return view('layout/header', $data)
                 . view('blog/players-distance-irons-explained', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'blade-vs-cavity-back') {
            return view('layout/header', $data)
                 . view('blog/blade-vs-cavity-back', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'do-you-need-more-club-weight') {
            return view('layout/header', $data)
                 . view('blog/do-you-need-more-club-weight', $data)
                 . view('layout/footer', $data);
        }
        
            if ($slug === 'graphite-vs-steel-shafts') {
                return view('layout/header', $data)
                     . view('blog/graphite-vs-steel-shafts', $data)
                     . view('layout/footer', $data);
            }
            
            if ($slug === 'loft-and-lie') {
                return view('layout/header', $data)
                     . view('blog/loft-and-lie', $data)
                     . view('layout/footer', $data);
            }
            
            if ($slug === 'grip-size-and-feel') {
                return view('layout/header', $data)
                     . view('blog/grip-size-and-feel', $data)
                     . view('layout/footer', $data);
            }
            
            if ($slug === 'finding-the-right-shaft-flex') {
                return view('layout/header', $data)
                     . view('blog/finding-the-right-shaft-flex', $data)
                     . view('layout/footer', $data);
            }
        
        if ($slug === 'set-gapping') {
            return view('layout/header', $data)
                 . view('blog/set-gapping', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'flex-by-swing-speed') {
            return view('layout/header', $data)
                 . view('blog/flex-by-swing-speed', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'game-improvement-vs-players-vs-players-distance-irons') {
            return view('layout/header', $data)
                 . view('blog/game-improvement-vs-players-vs-players-distance-irons', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'hybrids-vs-long-irons') {
            return view('layout/header', $data)
                 . view('blog/hybrids-vs-long-irons', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'mens-vs-womens-clubs') {
            return view('layout/header', $data)
                 . view('blog/mens-vs-womens-clubs', $data)
                 . view('layout/footer', $data);
        }
        
        return view('layout/header', $data)
             . view('blog/view', $data)
             . view('layout/footer', $data);
    }
    
    private function getBlogPosts()
    {
        return [
            [
                'slug' => 'players-vs-game-improvement-irons',
                'title' => 'Players Irons vs Game Improvement Irons: A Personal Journey to Choosing the Right Clubs',
                'excerpt' => 'I still remember the first time I gazed down at a shiny blade iron behind the ball. It looked beautiful – but my ego was along for the ride. What followed was a season of bruised pride and a hard lesson in choosing the right irons.',
                'date' => '2025-10-12',
                'read_time' => '15 min read',
                'featured' => false,
                'thumbnail' => 'Blades vs cavitybacks.jpg'
            ],
            [
                'slug' => 'finding-the-right-shaft-flex',
                'title' => 'Finding the Right Shaft Flex: A Golfer\'s Journey from Frustration to Confidence',
                'excerpt' => 'Meet Jake, a dedicated weekend golfer who loves the game but has been stuck in a rut. Every tee shot feels like a gamble. One day he hits a low, weak fade that barely reaches the fairway; the next, a wild slice sails out of bounds.',
                'date' => '2025-10-12',
                'read_time' => '12 min read',
                'featured' => false,
                'thumbnail' => 'Straight and true.jpg'
            ],
            [
                'slug' => 'why-swing-weight-matters',
                'title' => 'Why Swing Weight Matters (and how your swing finally clicks when it does)',
                'excerpt' => 'Saturday morning. A misty practice tee outside Chambersburg. A golfer named Matt pulls a 7‑iron he "trusts"… and sends three balls three different distances.',
                'date' => '2025-01-15',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'Swing weight matters.jpg'
            ],
            [
                'slug' => 'signs-you-need-different-shaft-flex',
                'title' => 'Signs You Need a Different Shaft Flex',
                'excerpt' => 'Is your current shaft flex holding you back? Learn the telltale signs that indicate you need a different shaft stiffness for optimal performance.',
                'date' => '2025-10-10',
                'read_time' => '4 min read',
                'featured' => false,
                'thumbnail' => 'Flex Matters.jpg'
            ],
            [
                'slug' => 'choosing-shaft-flex-by-swing-speed',
                'title' => 'Choosing Shaft Flex by Swing Speed (including TX)',
                'excerpt' => 'Learn how to choose the right shaft flex based on your swing speed, with practical guidelines for driver and 6-iron measurements, plus insights on TX flex.',
                'date' => '2025-10-11',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'flex.jpg'
            ],
            [
                'slug' => 'players-distance-irons-explained',
                'title' => 'Players‑Distance Irons: The Middle Path That Doesn\'t Feel Like Compromise',
                'excerpt' => 'Daniel\'s journey to finding the perfect iron category. Learn why Players-Distance irons offer the best of both worlds: sleek looks with forgiveness.',
                'date' => '2025-10-13',
                'read_time' => '9 min read',
                'featured' => false,
                'thumbnail' => 'ANGRY.jpg'
            ],
            [
                'slug' => 'blade-vs-cavity-back',
                'title' => 'Blade vs Cavity‑Back: the day you stop apologizing to your irons',
                'excerpt' => 'Rosa\'s story of choosing between her father\'s blades and modern cavity-back irons. Learn when to choose forgiveness over tradition.',
                'date' => '2025-10-14',
                'read_time' => '7 min read',
                'featured' => false,
                'thumbnail' => 'two ladies.jpg'
            ],
            [
                'slug' => 'do-you-need-more-club-weight',
                'title' => 'Do You Need More Club Weight?',
                'excerpt' => 'Nate and Ellen\'s stories of finding the right club weight. Learn how total weight and swing weight affect your tempo and consistency.',
                'date' => '2025-10-15',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'girl boy.jpg'
            ],
            [
                'slug' => 'graphite-vs-steel-shafts',
                'title' => 'Graphite vs Steel Shafts: finding the sound your hands believe',
                'excerpt' => 'A golfer\'s journey from steel to graphite. Learn the differences between shaft materials and discover which one fits your swing and comfort needs.',
                'date' => '2025-10-16',
                'read_time' => '9 min read',
                'featured' => false,
                'thumbnail' => 'FEELS LIKE CHEETING.jpg'
            ],
            [
                'slug' => 'loft-and-lie',
                'title' => 'Loft & Lie: the hidden compass inside every club',
                'excerpt' => 'Discover how one degree of lie angle can change your start line and why proper loft gapping is the difference between confident shots and constant guessing.',
                'date' => '2025-10-17',
                'read_time' => '7 min read',
                'featured' => false,
                'thumbnail' => 'NORMAN.jpg'
            ],
            [
                'slug' => 'grip-size-and-feel',
                'title' => 'Grip Size & Feel: the day your hands stopped fighting the club',
                'excerpt' => 'June\'s story of finding the right grip size and texture. Learn how proper grip fitting can eliminate hand fatigue and improve consistency.',
                'date' => '2025-10-18',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'Fighting the club.jpg'
            ],
            [
                'slug' => 'set-gapping',
                'title' => 'Set Gapping: the night your bag became a ladder',
                'excerpt' => 'Evan\'s story of fixing his club gapping issues. Learn how proper distance gapping can transform your confidence and scoring.',
                'date' => '2025-10-19',
                'read_time' => '9 min read',
                'featured' => false,
                'thumbnail' => 'Gapping ladder.jpg'
            ],
            [
                'slug' => 'hybrids-vs-long-irons',
                'title' => 'Hybrids vs Long Irons: the day your long par‑3 stopped feeling like a dare',
                'excerpt' => 'Ben\'s story of choosing between hybrids and long irons. Learn when to choose forgiveness over tradition for your long approach shots.',
                'date' => '2025-10-17',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'Hybrids vs Long Irons.jpg'
            ],
            [
                'slug' => 'mens-vs-womens-clubs',
                'title' => 'Men\'s vs Women\'s Clubs: what the labels say—and what your swing actually needs',
                'excerpt' => 'Maya and Dan\'s story of discovering that club fitting is about swing, not gender. Learn why labels don\'t determine what clubs you should play.',
                'date' => '2025-10-18',
                'read_time' => '9 min read',
                'featured' => true,
                'thumbnail' => 'Fight.jpg'
            ],
            [
                'slug' => 'flex-by-swing-speed',
                'title' => 'Flex by Swing Speed (Driver & 6‑Iron)',
                'excerpt' => 'Learn how to choose the right shaft flex based on your swing speed with both driver and 6-iron measurements. Includes speed charts and practical fitting advice.',
                'date' => '2025-10-20',
                'read_time' => '8 min read',
                'featured' => false,
                'thumbnail' => 'Flex by Swing Speed.jpg'
            ],
            [
                'slug' => 'game-improvement-vs-players-vs-players-distance-irons',
                'title' => 'Game Improvement vs Players vs Players‑Distance Irons',
                'excerpt' => 'Tyler\'s story of finding the right iron category. Learn the differences between GI, Players, and Players-Distance irons and discover which type fits your game.',
                'date' => '2025-10-21',
                'read_time' => '10 min read',
                'featured' => false,
                'thumbnail' => 'Iron Choice.jpg'
            ]
        ];
    }
}
