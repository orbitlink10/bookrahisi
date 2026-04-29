<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function index(): View
    {
        $cities = [
            'Nairobi',
            'Mombasa',
            'Kisumu',
            'Nakuru',
            'Eldoret',
            'Thika',
            'Naivasha',
            'Malindi',
            'Kitale',
            'Machakos',
            'Kakamega',
            'Nyeri',
            'Meru',
            'Nanyuki',
            'Diani',
            'Kericho',
            'Kisii',
            'Embu',
            'Athi River',
            'Rongai',
        ];

        return view('home', [
            'hero' => [
                'title' => 'Book your next self-care session',
                'subtitle' => 'Discover salons, spas, barbershops, nail studios, massage therapy, and fitness classes across Kenya with instant online booking.',
                'image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=1800&q=80',
            ],
            'servicePills' => [
                'Haircut & Style',
                'Hair Color',
                'Barber',
                'Spa',
                'Nail',
                'Yoga',
                'Massage',
                'Pilates',
                'More...',
            ],
            'trendingBusinesses' => [
                [
                    'name' => 'Amani Style Studio',
                    'category' => 'Salon',
                    'location' => 'Westlands, Nairobi',
                    'distance' => '1.2 km',
                    'rating' => '4.9',
                    'reviews' => '318 reviews',
                    'image' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Polished by Zuri',
                    'category' => 'Nail Studio',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '2.4 km',
                    'rating' => '4.8',
                    'reviews' => '204 reviews',
                    'image' => 'https://images.unsplash.com/photo-1610992239169-c57b2a6f98b1?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Baraka Grooming Club',
                    'category' => 'Barbershop',
                    'location' => 'Milimani, Kisumu',
                    'distance' => '0.9 km',
                    'rating' => '4.9',
                    'reviews' => '175 reviews',
                    'image' => 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Maua Spa House',
                    'category' => 'Spa',
                    'location' => 'Nyali, Mombasa',
                    'distance' => '1.7 km',
                    'rating' => '4.8',
                    'reviews' => '128 reviews',
                    'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Iron District Fitness',
                    'category' => 'Gym',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '3.1 km',
                    'rating' => '4.7',
                    'reviews' => '96 reviews',
                    'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            'dailyDeals' => [
                [
                    'title' => 'Radiance facial treatment',
                    'location' => 'Westlands, Nairobi',
                    'distance' => '1.4 km',
                    'badge' => 'Save 25%',
                    'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Executive barber refresh',
                    'location' => 'Karen, Nairobi',
                    'distance' => '4.2 km',
                    'badge' => 'Save 15%',
                    'image' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Energy healing body work',
                    'location' => 'Nyali, Mombasa',
                    'distance' => '2.3 km',
                    'badge' => 'Up to 20% off',
                    'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Weekend lash special',
                    'location' => 'Nakuru CBD',
                    'distance' => '0.8 km',
                    'badge' => 'Up to 30% off',
                    'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Brightening glow mask',
                    'location' => 'Kisumu CBD',
                    'distance' => '1.1 km',
                    'badge' => 'Save KES 1,000',
                    'image' => 'https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Deep tissue reset',
                    'location' => 'Diani Beach',
                    'distance' => '3.8 km',
                    'badge' => '30% off',
                    'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Luxury nails and chrome finish',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '1.6 km',
                    'badge' => 'Up to KES 2,000 off',
                    'image' => 'https://images.unsplash.com/photo-1607779097040-26e80aa4576c?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'First visit gym pass',
                    'location' => 'Eldoret Town',
                    'distance' => '2.5 km',
                    'badge' => '50% off',
                    'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            'cityColumns' => array_chunk($cities, 5),
        ]);
    }
}
