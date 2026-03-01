<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there is at least one vendor shop to attach products to
        $vendor = User::role('vendor')->first();
        if (!$vendor) {
            return;
        }
        
        $shop = $vendor->shop()->firstOrCreate([
            'name' => 'Demo Premium Store',
            'description' => 'The best quality products from our premium vendor.',
        ]);
        
        $shopId = $shop->id;

        $categories = Category::all()->keyBy('name');

        $products = [
            // Electronics
            [
                'category_id' => $categories['Electronics']->id,
                'name' => 'Premium Noise-Cancelling Headphones',
                'description' => 'Experience industry-leading noise cancellation and immersive audio with these premium wireless over-ear headphones. Features 30-hour battery life and fast charging.',
                'price' => 299.99,
                'stock' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Electronics']->id,
                'name' => 'Ultra-Slim 4K Smart TV - 55"',
                'description' => 'Bring the cinema to your living room. Stunning 4K Ultra HD resolution, vibrant HDR colors, and built-in smart functionality for endless streaming.',
                'price' => 499.00,
                'stock' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Electronics']->id,
                'name' => 'Pro Gaming Laptop - 16GB RAM, RTX 4060',
                'description' => 'Dominate the leaderboard with this high-performance gaming laptop. Fast refresh rate, powerful GPU, and advanced cooling system.',
                'price' => 1299.50,
                'stock' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?q=80&w=1468&auto=format&fit=crop',
            ],

            // Fashion
            [
                'category_id' => $categories['Fashion']->id,
                'name' => 'Classic Blue Denim Jacket',
                'description' => 'A wardrobe essential. This timeless denim jacket offers a comfortable fit, durable stitching, and pairs perfectly with any casual outfit.',
                'price' => 59.99,
                'stock' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1495105787522-5334e3ffa0ef?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Fashion']->id,
                'name' => 'Everyday Minimalist Sneakers',
                'description' => 'Sleek, lightweight, and versatile. These minimalist white sneakers provide all-day comfort whether you are commuting or exploring the city.',
                'price' => 89.00,
                'stock' => 75,
                'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1424&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Fashion']->id,
                'name' => 'Cozy Knitted Sweater',
                'description' => 'Stay warm and stylish this winter with our premium knitted sweater. Made from a soft wool blend, featuring a classic crew neck design.',
                'price' => 45.50,
                'stock' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1372&auto=format&fit=crop',
            ],

            // Home & Living
            [
                'category_id' => $categories['Home & Living']->id,
                'name' => 'Modern Ceramic Coffee Mug Set',
                'description' => 'Enjoy your morning brew in style. This set of 4 artisanal ceramic mugs features a matte finish and ergonomic handles. Microwave and dishwasher safe.',
                'price' => 34.00,
                'stock' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Home & Living']->id,
                'name' => 'Minimalist Wooden Desk Lamp',
                'description' => 'Brighten up your workspace. A sleek fusion of natural wood and matte black metal, emitting a warm, adjustable LED glow.',
                'price' => 49.99,
                'stock' => 25,
                'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Home & Living']->id,
                'name' => 'Handwoven Cotton Throw Blanket',
                'description' => 'Add texture and comfort to your sofa or bed. This breathable, 100% natural cotton throw features decorative tassels and a beautiful geometric pattern.',
                'price' => 39.50,
                'stock' => 30,
                'image_url' => 'https://images.unsplash.com/photo-1583847268964-b28e5dbc1348?q=80&w=1374&auto=format&fit=crop',
            ],

            // Accessories
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Elegant Leather Watch',
                'description' => 'A statement piece for any occasion. Features a genuine leather strap, water-resistant stainless steel casing, and a minimalist analog dial.',
                'price' => 149.00,
                'stock' => 18,
                'image_url' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1399&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Classic Aviator Sunglasses',
                'description' => 'Protect your eyes in style. These aviator sunglasses offer 100% UV protection, polarized lenses, and a durable lightweight metal frame.',
                'price' => 25.00,
                'stock' => 100,
                'image_url' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=1480&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Genuine Leather Bifold Wallet',
                'description' => 'Slim, practical, and stylish. Handcrafted from premium full-grain leather, featuring RF protection and multiple card slots.',
                'price' => 4500.00,
                'stock' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?q=80&w=1374&auto=format&fit=crop',
            ],

            // Cute Stationery
            [
                'category_id' => $categories['Cute Stationery']->id,
                'name' => 'Pastel Highlighters Set (6 Pack)',
                'description' => 'Aesthetically pleasing pastel highlighters that do not bleed through paper. Perfect for bullet journaling and aesthetic notes.',
                'price' => 850.00,
                'stock' => 200,
                'image_url' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?q=80&w=1500&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Stationery']->id,
                'name' => 'A5 Peach Floral Bullet Journal',
                'description' => 'Thick 160gsm dotted paper with a soft touch peachy floral cover. Excellent for tracking habits, art, and daily planning.',
                'price' => 1200.00,
                'stock' => 150,
                'image_url' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=1587&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Stationery']->id,
                'name' => 'Kawaii Bear Pencil Pouch',
                'description' => 'A fluffy and adorable bear-shaped plush pencil case. Spacious enough to hold up to 30 pens, erasers, and washi tapes.',
                'price' => 950.00,
                'stock' => 85,
                'image_url' => 'https://images.unsplash.com/photo-1510127034890-ba27508e9f1c?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Stationery']->id,
                'name' => 'Vintage Washi Tape Box Set',
                'description' => '10 rolls of exquisite vintage botanical and aesthetic washi tapes to decorate your polaroids and scrapbooks.',
                'price' => 1100.00,
                'stock' => 300,
                'image_url' => 'https://images.unsplash.com/photo-1596484552834-6a58f850e0a1?q=80&w=1470&auto=format&fit=crop',
            ],

            // Hoodies & Casual Wear
            [
                'category_id' => $categories['Hoodies & Casual Wear']->id,
                'name' => 'Oversized Lilac Graphic Hoodie',
                'description' => 'Super soft, oversized matching fleece hoodie in a cute lilac hue. Perfect for lazy weekends or a chic street style look.',
                'price' => 3200.00,
                'stock' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Hoodies & Casual Wear']->id,
                'name' => 'Daisy Embroidered Cardigan',
                'description' => 'Chunky knit cropped cardigan featuring cute daisy embroidery. A vintage-inspired piece to elevate any casual outfit.',
                'price' => 4500.00,
                'stock' => 45,
                'image_url' => 'https://images.unsplash.com/photo-1620799140188-3b2a02fd9a77?q=80&w=1372&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Hoodies & Casual Wear']->id,
                'name' => 'Aesthetic Matcha Green Sweatpants',
                'description' => 'High-waisted, ultra-comfortable sweatpants in an earthy matcha green tone. Includes deep pockets and a drawstring waist.',
                'price' => 2500.00,
                'stock' => 80,
                'image_url' => 'https://images.unsplash.com/photo-1605063034960-93a9ba016147?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Hoodies & Casual Wear']->id,
                'name' => 'Cloud Print Lounge Set',
                'description' => 'A matching 2-piece lounge set consisting of a long sleeve crop top and shorts featuring a dreamy cloud print.',
                'price' => 2800.00,
                'stock' => 55,
                'image_url' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1440&auto=format&fit=crop',
            ],

            // Accessories (Targeted Additions)
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Chunky Gold Hoop Earrings Se',
                'description' => 'A set of 3 pairs of lightweight, hypoallergenic chunky gold hoops. Classic, trendy, and perfect for daily wear.',
                'price' => 1200.00,
                'stock' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1629224316810-9d8805b95e76?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Faux Leather Quilted Crossbody Bag',
                'description' => 'A chic and compact quilted crossbody bag with a golden chain strap. Fits your phone, lip gloss, and wallet easily.',
                'price' => 3500.00,
                'stock' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1584916201218-f4242ceb4809?q=80&w=1430&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Pearl Layered Choker Necklace',
                'description' => 'A delicate multi-layered choker necklace adorned with faux pearls and a tiny gold star pendant.',
                'price' => 950.00,
                'stock' => 90,
                'image_url' => 'https://images.unsplash.com/photo-1599643478514-4a5202300408?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Accessories']->id,
                'name' => 'Fluffy Faux Fur Claw Clips (Set of 2)',
                'description' => 'Keep your hair up in style with these trendy, ultra-soft faux fur claw clips. Comes in baby pink and cream.',
                'price' => 850.00,
                'stock' => 160,
                'image_url' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=1470&auto=format&fit=crop',
            ],

            // Cute Furniture
            [
                'category_id' => $categories['Cute Furniture']->id,
                'name' => 'Pink Velvet Vanity Chair',
                'description' => 'A comfortable, petal-shaped vanity chair wrapped in soft pink velvet with golden metal legs. Perfect for makeup desks.',
                'price' => 7500.00,
                'stock' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Furniture']->id,
                'name' => 'Mushroom Bedside Lamp',
                'description' => 'A minimalistic glass mushroom lamp that gives out a cozy, warm amber glow. A perfect addition to your nightstand aesthetic.',
                'price' => 3200.00,
                'stock' => 25,
                'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Furniture']->id,
                'name' => 'Cloud Shaped Small Area Rug',
                'description' => 'Extremely soft faux sheepskin rug shaped like a cloud. Ideal for placing next to your bed or beneath your study desk.',
                'price' => 2900.00,
                'stock' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?q=80&w=1469&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Cute Furniture']->id,
                'name' => 'Aesthetic Wall Grid Panel',
                'description' => 'Rose gold wire grid panel for organizing polaroids, to-do lists, and fairy lights. Adds an instant room glow-up.',
                'price' => 1500.00,
                'stock' => 70,
                'image_url' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1469&auto=format&fit=crop',
            ],

            // Small Home Appliances
            [
                'category_id' => $categories['Small Home Appliances']->id,
                'name' => 'Mini Skincare Fridge (4L)',
                'description' => 'A compact baby pink fridge meant to keep your jade rollers, face masks, and serums perfectly chilled. Silent and energy-efficient.',
                'price' => 6500.00,
                'stock' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1584286595398-a59f21d313f5?q=80&w=1374&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Small Home Appliances']->id,
                'name' => 'Portable Bear Mini Blender',
                'description' => 'A rechargeable, travel-friendly mini blender shaped like a cute bear. Make fresh smoothies or iced lattes on the go.',
                'price' => 3800.00,
                'stock' => 35,
                'image_url' => 'https://images.unsplash.com/photo-1570222094114-d054a817e56b?q=80&w=1505&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Small Home Appliances']->id,
                'name' => 'Aesthetic Electric Kettle',
                'description' => 'A retro-style matte pastel electric kettle with a gooseneck spout. Boils water in minutes for tea and coffee lovers.',
                'price' => 4500.00,
                'stock' => 28,
                'image_url' => 'https://images.unsplash.com/photo-1594243455172-e568bb03a6c2?q=80&w=1470&auto=format&fit=crop',
            ],
            [
                'category_id' => $categories['Small Home Appliances']->id,
                'name' => 'Cat Ear Humidifier with Night Light',
                'description' => 'An adorable desk humidifier featuring cat ears and a glowing soft LED night light. Keeps your skin glowing in dry weather.',
                'price' => 2200.00,
                'stock' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1620025776263-ce341ee4ceae?q=80&w=1470&auto=format&fit=crop',
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate([
                'shop_id' => $shopId,
                'name' => $productData['name'],
            ], [
                'category_id' => $productData['category_id'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'image_url' => $productData['image_url'],
                'is_active' => true,
            ]);
        }

        // --- NEW DORMNEST SHOP PRODUCTS ---
        $dormNestShop = \App\Models\Shop::where('name', 'DormNest')->first();
        if (!$dormNestShop && $vendor) {
            $dormNestShop = \App\Models\Shop::create([
                'user_id' => $vendor->id,
                'name' => 'DormNest',
                'description' => 'DormNest is a curated micro-store designed for students who want their small dorm room to feel personal, cozy, and aesthetic — without spending a fortune. We offer compact, budget-friendly decor that transforms basic hostel spaces into organized, Instagram-worthy corners.',
                'is_active' => true,
            ]);
        }

        if ($dormNestShop) {
            $dormCategories = [
                'Wall Decor',
                'Lighting & LED',
                'Desk Accessories',
                'Bedding & Soft Furnishings',
                'Storage & Organization'
            ];

            foreach ($dormCategories as $catName) {
                Category::firstOrCreate(['name' => $catName], ['slug' => Str::slug($catName)]);
            }

            $catModels = Category::whereIn('name', $dormCategories)->get()->keyBy('name');

            $dormProducts = [
                [
                    'category_name' => 'Wall Decor',
                    'name' => 'Pastel Woven Moon Dreamcatcher',
                    'description' => 'A beautifully hand-woven dreamcatcher with soft pastel feathers and a crescent moon design. Perfect for hanging above your dorm bed.',
                    'price' => 1200.00,
                    'stock' => 30,
                    'image_url' => 'https://images.unsplash.com/photo-1596395819057-e37f55a8516d?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Wall Decor',
                    'name' => 'Rose Gold Wire Wall Grid',
                    'description' => 'Aesthetic metal wire grid for clipping polaroids, study notes, and fairy lights. Includes 10 wooden pegs.',
                    'price' => 1500.00,
                    'stock' => 50,
                    'image_url' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Wall Decor',
                    'name' => 'Botanical Art Print Set (A4)',
                    'description' => 'Set of 3 minimalist botanical line art prints on high-quality cream cardstock. Instantly elevates plain dorm walls.',
                    'price' => 800.00,
                    'stock' => 100,
                    'image_url' => 'https://images.unsplash.com/photo-1579783900864-5133c94de584?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Wall Decor',
                    'name' => 'Boho Macrame Tapestry',
                    'description' => 'Compact and elegant boho macrame wall hanging. Adds incredible texture and coziness to any small space.',
                    'price' => 1800.00,
                    'stock' => 25,
                    'image_url' => 'https://images.unsplash.com/photo-1522771731478-44bf105b38cb?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Lighting & LED',
                    'name' => 'Golden Hour Sunset Lamp',
                    'description' => 'Recreates a stunning, warm sunset glow in your room. Perfect for aesthetic photos and relaxing study nights.',
                    'price' => 2200.00,
                    'stock' => 40,
                    'image_url' => 'https://images.unsplash.com/photo-1629828453472-747f4f6b4dd9?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Lighting & LED',
                    'name' => 'Warm White Fairy Lights (10m)',
                    'description' => 'Delicate copper wire string lights to drape around your mirror, bed frame, or wall grid. USB powered.',
                    'price' => 650.00,
                    'stock' => 150,
                    'image_url' => 'https://images.unsplash.com/photo-1513702113337-b4d0eb6dc8b0?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Lighting & LED',
                    'name' => 'Neon Peach Cloud Sign',
                    'description' => 'A vivid, glowing neon sign shaped like a tiny cloud. Adds the perfect pop of color to a neutral room.',
                    'price' => 2800.00,
                    'stock' => 35,
                    'image_url' => 'https://images.unsplash.com/photo-1554290712-e640351074bd?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Lighting & LED',
                    'name' => 'Aesthetic Mushroom Table Lamp',
                    'description' => 'Minimalist glass mushroom lamp with a soothing soft, amber glow. Essential for late-night reading.',
                    'price' => 3500.00,
                    'stock' => 20,
                    'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Desk Accessories',
                    'name' => 'Clear Acrylic Desk Organizer',
                    'description' => 'Aesthetic transparent organizer with multiple compartments for pens, sticky notes, and lip gloss. Keeps your study space spotless.',
                    'price' => 1200.00,
                    'stock' => 60,
                    'image_url' => 'https://images.unsplash.com/photo-1593640495253-23196b27a87f?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Desk Accessories',
                    'name' => 'Mini Potted Faux Succulent',
                    'description' => 'Cute hassle-free greenery for your desk. Comes in a tiny geometric white ceramic pot.',
                    'price' => 500.00,
                    'stock' => 120,
                    'image_url' => 'https://images.unsplash.com/photo-1453904300235-0f2f60b15b5d?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Desk Accessories',
                    'name' => 'Digital Wood Cube Clock',
                    'description' => 'Sleek wooden desk clock with LED display showing time and temperature. Minimalist and functional.',
                    'price' => 1800.00,
                    'stock' => 45,
                    'image_url' => 'https://images.unsplash.com/photo-1520697960685-64bc4a7e9373?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Desk Accessories',
                    'name' => 'Pastel Keyboard & Mouse Mat',
                    'description' => 'Large, soft extended mousepad in a soothing matcha pastel tone. Protects your desk and looks incredible.',
                    'price' => 1400.00,
                    'stock' => 80,
                    'image_url' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Bedding & Soft Furnishings',
                    'name' => 'Fluffy Cloud Throw Blanket',
                    'description' => 'Incredibly soft and cozy faux fur blanket in warm ivory. Perfect for keeping warm during cram sessions.',
                    'price' => 4500.00,
                    'stock' => 30,
                    'image_url' => 'https://images.unsplash.com/photo-1583847268964-b28e5dbc1348?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Bedding & Soft Furnishings',
                    'name' => 'Daisy Flower Floor Cushion',
                    'description' => 'Plush, comfortable cushion shaped like a daisy. Perfect to sit on when studying on your dorm floor with friends.',
                    'price' => 3200.00,
                    'stock' => 25,
                    'image_url' => 'https://images.unsplash.com/photo-1620025776263-ce341ee4ceae?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Bedding & Soft Furnishings',
                    'name' => 'Faux Silk Pillowcase Set',
                    'description' => 'Set of 2 blush pink silk-like pillowcases. Gentle on your skin and hair, plus it elevates your bed’s look instantly.',
                    'price' => 1500.00,
                    'stock' => 70,
                    'image_url' => 'https://images.unsplash.com/photo-1522771731478-44bf105b38cb?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Bedding & Soft Furnishings',
                    'name' => 'Knot Ball Decorative Pillow',
                    'description' => 'Trendy handmade knot pillow in muted sage green. A unique statement piece for your dorm bed.',
                    'price' => 2100.00,
                    'stock' => 40,
                    'image_url' => 'https://images.unsplash.com/photo-1584916201218-f4242ceb4809?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Storage & Organization',
                    'name' => '3-Tier Rolling Utility Cart',
                    'description' => 'Compact metal cart on wheels. An absolute lifesaver for storing textbooks, snacks, and toiletries in tiny rooms.',
                    'price' => 5200.00,
                    'stock' => 15,
                    'image_url' => 'https://images.unsplash.com/photo-1595514535310-7ab1730bb0f8?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Storage & Organization',
                    'name' => 'Under-bed Storage Bags (2 Pack)',
                    'description' => 'Breathable fabric organizers with clear windows. The smartest way to hide your out-of-season clothes and extra blankets.',
                    'price' => 1600.00,
                    'stock' => 55,
                    'image_url' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Storage & Organization',
                    'name' => 'Over The Door Shoe Organizer',
                    'description' => '24 clear pockets that hang over your closet door. Great for shoes, or maximizing space for hair tools and snacks.',
                    'price' => 950.00,
                    'stock' => 100,
                    'image_url' => 'https://images.unsplash.com/photo-1596484552834-6a58f850e0a1?q=80&w=600&auto=format&fit=crop',
                ],
                [
                    'category_name' => 'Storage & Organization',
                    'name' => 'Woven Rope Storage Basket',
                    'description' => 'Minimalist cotton rope basket. Perfect for holding laundry or extra pillows while keeping your room aesthetic intact.',
                    'price' => 2400.00,
                    'stock' => 35,
                    'image_url' => 'https://images.unsplash.com/photo-1584916201218-f4242ceb4809?q=80&w=600&auto=format&fit=crop',
                ],
            ];

            foreach ($dormProducts as $p) {
                Product::firstOrCreate([
                    'shop_id' => $dormNestShop->id,
                    'name' => $p['name'],
                ], [
                    'category_id' => $catModels[$p['category_name']]->id,
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image_url' => $p['image_url'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
