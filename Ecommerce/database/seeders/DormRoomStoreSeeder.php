<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DormRoomStoreSeeder extends Seeder
{
    public function run(): void
    {
        $vendorRole = Role::firstOrCreate(['name' => 'vendor']);

        // 1. Create the Vendor User
        $vendor = User::firstOrCreate(
            ['email' => 'dormdecor@demo.com'],
            ['name' => 'Dorm Decor Vendor', 'password' => bcrypt('password')]
        );
        $vendor->assignRole($vendorRole);

        // 2. Create the Shop
        $shop = Shop::firstOrCreate(
            ['user_id' => $vendor->id],
            [
                'name' => 'Dorm Room Decor Micro Store',
                'description' => 'Aesthetic, affordable dorm room decoration for students and young women.',
                'logo_url' => 'https://placehold.co/200x200?text=Dorm+Decor',
                'banner_url' => 'https://images.unsplash.com/photo-1540932239986-30128078f3c5?q=80&w=2000&auto=format&fit=crop', // A nice room aesthetic banner
                'is_active' => true,
            ]
        );

        // 3. Create Categories
        $categoryNames = [
            'Wall Decor',
            'LED & Lighting',
            'Desk Decor',
            'Bedding & Cushions',
            'Storage & Organizers'
        ];

        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate([
                'name' => $name,
            ], [
                'slug' => Str::slug($name)
            ]);
        }

        // 4. Products (15 Items, 500 PKR to 6000 PKR)
        $products = [
            // Wall Decor
            [
                'name' => 'Boho Macrame Wall Hanging',
                'description' => 'A beautiful handwoven macrame tapestry to give your dorm walls a cozy, bohemian vibe.',
                'price' => 1500.00,
                'stock' => 30,
                'category_id' => $categories['Wall Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1596395819057-e37f55a8516d?q=80&w=1500&auto=format&fit=crop',
            ],
            [
                'name' => 'Aesthetic Polaroid Display Grid',
                'description' => 'Rose gold wire wall grid with wooden pegs for displaying your favorite polaroids, study notes, and fairy lights.',
                'price' => 1200.00,
                'stock' => 50,
                'category_id' => $categories['Wall Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1469&auto=format&fit=crop',
            ],
            [
                'name' => 'Minimalist Sun & Moon Line Art Prints (Set of 3)',
                'description' => 'Set of 3 unframed A4 aesthetic line art posters printed on premium cream cardstock.',
                'price' => 850.00,
                'stock' => 100,
                'category_id' => $categories['Wall Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1579783900864-5133c94de584?q=80&w=1500&auto=format&fit=crop',
            ],

            // LED & Lighting
            [
                'name' => 'Sunset Projection Lamp',
                'description' => 'Transform your dorm room into a golden hour paradise instantly. Features 16 distinct RGB color modes with a remote.',
                'price' => 1800.00,
                'stock' => 75,
                'category_id' => $categories['LED & Lighting']->id,
                'image_url' => 'https://images.unsplash.com/photo-1629828453472-747f4f6b4dd9?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'name' => 'Warm White Fairy String Lights',
                'description' => '10 meters of delicate copper wire fairy lights. Completely changes the atmosphere of your room.',
                'price' => 500.00,
                'stock' => 200,
                'category_id' => $categories['LED & Lighting']->id,
                'image_url' => 'https://images.unsplash.com/photo-1513702113337-b4d0eb6dc8b0?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'name' => 'Neon Cloud Wall Sign',
                'description' => 'A chic and vivid blue neon cloud sign. USB powered and easy to hang above your desk or bed.',
                'price' => 2200.00,
                'stock' => 45,
                'category_id' => $categories['LED & Lighting']->id,
                'image_url' => 'https://images.unsplash.com/photo-1554290712-e640351074bd?q=80&w=1500&auto=format&fit=crop',
            ],

            // Desk Decor
            [
                'name' => 'Acrylic Desktop Organizer',
                'description' => 'Clear aesthetic acrylic organizer for your pens, highlighters, sticky notes, and makeup brushes. Keeps your desk spotless.',
                'price' => 1400.00,
                'stock' => 60,
                'category_id' => $categories['Desk Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1593640495253-23196b27a87f?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'name' => 'Mini Artificial Potted Succulent',
                'description' => 'Add some greenery to your study desk without the hassle of watering. In a cute white ceramic pot.',
                'price' => 650.00,
                'stock' => 150,
                'category_id' => $categories['Desk Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1453904300235-0f2f60b15b5d?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'name' => 'Digital Wooden Alarm Clock',
                'description' => 'Minimalist wooden cube clock that senses sound. Displays time, date, and temperature with a sleek LED glow.',
                'price' => 2100.00,
                'stock' => 40,
                'category_id' => $categories['Desk Decor']->id,
                'image_url' => 'https://images.unsplash.com/photo-1520697960685-64bc4a7e9373?q=80&w=1471&auto=format&fit=crop',
            ],

            // Bedding & Cushions
            [
                'name' => 'Fluffy Faux Fur Throw Blanket',
                'description' => 'An incredibly soft, baby pink faux fur blanket. Perfect for cozy study sessions in bed.',
                'price' => 3500.00,
                'stock' => 30,
                'category_id' => $categories['Bedding & Cushions']->id,
                'image_url' => 'https://images.unsplash.com/photo-1583847268964-b28e5dbc1348?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'name' => 'Aesthetic Flower Floor Cushion',
                'description' => 'A large, plush cushion shaped like a daisy flower. Perfect for sitting on the floor while studying with friends.',
                'price' => 2800.00,
                'stock' => 25,
                'category_id' => $categories['Bedding & Cushions']->id,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1678122396656-621aa0da1625?q=80&w=1471&auto=format&fit=crop',
            ],
            [
                'name' => 'Silk Pillowcase Pair',
                'description' => 'Protect your hair and skin with these luxurious pastel silk pillowcases. A dorm essential for glowy mornings.',
                'price' => 1900.00,
                'stock' => 80,
                'category_id' => $categories['Bedding & Cushions']->id,
                'image_url' => 'https://images.unsplash.com/photo-1522771731478-44bf105b38cb?q=80&w=1500&auto=format&fit=crop',
            ],

            // Storage & Organizers
            [
                'name' => 'Rolling 3-Tier Utility Cart',
                'description' => 'A mint green metal rolling cart. Incredible for storing textbooks, snacks, and extra toiletries in cramped spaces.',
                'price' => 5500.00,
                'stock' => 15,
                'category_id' => $categories['Storage & Organizers']->id,
                'image_url' => 'https://images.unsplash.com/photo-1595514535310-7ab1730bb0f8?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'name' => 'Under-Bed Storage Bags (Set of 2)',
                'description' => 'Maximize your dorm space. These breathable fabric bags with clear windows hold your winter clothes out of sight.',
                'price' => 1600.00,
                'stock' => 60,
                'category_id' => $categories['Storage & Organizers']->id,
                'image_url' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'name' => 'Over The Door Shoe Organizer',
                'description' => '24 clear pockets hanging organizer. Not just for shoes—perfect for snacks, hair products, and small items.',
                'price' => 900.00,
                'stock' => 120,
                'category_id' => $categories['Storage & Organizers']->id,
                'image_url' => 'https://images.unsplash.com/photo-1596484552834-6a58f850e0a1?q=80&w=1470&auto=format&fit=crop', // Fallback placeholder
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate([
                'shop_id' => $shop->id,
                'name' => $p['name'],
            ], [
                'category_id' => $p['category_id'],
                'description' => $p['description'],
                'price' => $p['price'],
                'stock' => $p['stock'],
                'image_url' => $p['image_url'],
                'is_active' => true,
            ]);
        }
    }
}
