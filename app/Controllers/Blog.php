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
                 . view('blog/shaft-flex-guide', $data)
                 . view('layout/footer', $data);
        }
        
        if ($slug === 'why-swing-weight-matters') {
            return view('layout/header', $data)
                 . view('blog/why-swing-weight-matters', $data)
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
                'featured' => true
            ],
            [
                'slug' => 'finding-the-right-shaft-flex',
                'title' => 'Finding the Right Shaft Flex: A Golfer\'s Journey from Frustration to Confidence',
                'excerpt' => 'Meet Jake, a dedicated weekend golfer who loves the game but has been stuck in a rut. Every tee shot feels like a gamble. One day he hits a low, weak fade that barely reaches the fairway; the next, a wild slice sails out of bounds.',
                'date' => '2025-10-12',
                'read_time' => '12 min read',
                'featured' => false
            ],
            [
                'slug' => 'why-swing-weight-matters',
                'title' => 'Why Swing Weight Matters (and how your swing finally clicks when it does)',
                'excerpt' => 'Saturday morning. A misty practice tee outside Chambersburg. A golfer named Matt pulls a 7‑iron he "trusts"… and sends three balls three different distances.',
                'date' => '2025-01-15',
                'read_time' => '8 min read',
                'featured' => false
            ],
            [
                'slug' => 'signs-you-need-different-shaft-flex',
                'title' => 'Signs You Need a Different Shaft Flex',
                'excerpt' => 'Is your current shaft flex holding you back? Learn the telltale signs that indicate you need a different shaft stiffness for optimal performance.',
                'date' => '2025-10-10',
                'read_time' => '4 min read',
                'featured' => false
            ],
            [
                'slug' => 'flex-by-swing-speed',
                'title' => 'Flex by Swing Speed (Driver & 6-Iron)',
                'excerpt' => 'A comprehensive guide to choosing the right shaft flex based on your swing speed with both driver and 6-iron measurements.',
                'date' => '2025-10-09',
                'read_time' => '6 min read',
                'featured' => false
            ],
            [
                'slug' => 'game-improvement-vs-players-irons',
                'title' => 'Game Improvement vs Players vs Players-Distance Irons',
                'excerpt' => 'Breaking down the differences between iron categories to help you choose the right clubs for your skill level and goals.',
                'date' => '2025-10-08',
                'read_time' => '7 min read',
                'featured' => false
            ],
            [
                'slug' => 'players-distance-irons-explained',
                'title' => 'Players-Distance Irons Explained',
                'excerpt' => 'The perfect blend of forgiveness and workability. Learn why players-distance irons might be the sweet spot for your game.',
                'date' => '2025-10-07',
                'read_time' => '5 min read',
                'featured' => false
            ],
            [
                'slug' => 'blade-vs-cavity-back',
                'title' => 'Blade vs Cavity-Back',
                'excerpt' => 'The eternal debate: blades vs cavity-back irons. We break down the pros and cons to help you make an informed decision.',
                'date' => '2025-10-06',
                'read_time' => '6 min read',
                'featured' => false
            ],
            [
                'slug' => 'do-you-need-more-club-weight',
                'title' => 'Do You Need More Club Weight?',
                'excerpt' => 'Understanding total club weight and how it affects your swing. Learn when adding weight might improve your performance.',
                'date' => '2025-10-05',
                'read_time' => '4 min read',
                'featured' => false
            ],
            [
                'slug' => 'graphite-vs-steel-shafts',
                'title' => 'Graphite vs Steel Shafts',
                'excerpt' => 'The complete comparison between graphite and steel shafts. Learn which material is right for your swing and playing style.',
                'date' => '2025-10-04',
                'read_time' => '8 min read',
                'featured' => false
            ],
            [
                'slug' => 'hybrids-vs-long-irons',
                'title' => 'Hybrids vs Long Irons',
                'excerpt' => 'Should you carry hybrids or long irons? We analyze the benefits of each to help you optimize your long game.',
                'date' => '2025-10-03',
                'read_time' => '5 min read',
                'featured' => false
            ],
            [
                'slug' => 'mens-vs-womens-clubs',
                'title' => 'Men\'s vs Women\'s Clubs',
                'excerpt' => 'Understanding the differences between men\'s and women\'s golf clubs and how to choose the right equipment for your needs.',
                'date' => '2025-10-02',
                'read_time' => '6 min read',
                'featured' => false
            ]
        ];
    }
}
