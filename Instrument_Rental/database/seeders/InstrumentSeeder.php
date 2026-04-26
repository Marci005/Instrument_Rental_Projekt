<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instrument;

class InstrumentSeeder extends Seeder
{
    /*
     * ─── BRAND ID MAPPING ────────────────────────────────────────────────────────
     *  1  = Yamaha          12 = Kawai           23 = Conn-Selmer
     *  2  = Fender          13 = Alesis          24 = Gear4music
     *  3  = Ibanez          14 = Millenium       25 = Buffet Crampon
     *  4  = Casio           15 = Stentor         26 = Yanagisawa
     *  5  = Cort            16 = Gewa            27 = Squier
     *  6  = Takamine        17 = Primavera       28 = Jackson
     *  7  = Epiphone        18 = Stagg           29 = Gibson
     *  8  = Harley Benton   19 = Hidersine       30 = PRS
     *  9  = Sigma           20 = Jupiter         31 = ESP
     * 10  = Roland          21 = Selmer          32 = Schecter
     * 11  = Korg            22 = Trevor James    33 = Ismeretlen
     *
     * ─── CATEGORY ID MAPPING ─────────────────────────────────────────────────────
     *  1 = Akusztikus gitár      4 = Hegedű
     *  2 = Digitális zongora     5 = Alt szaxofon
     *  3 = Dobfelszerelés        6 = Elektromos gitár
     *
     * FONTOS: A brand_id értékek feltételezik, hogy a BrandSeeder a fenti
     * sorrendben szúrja be a márkákat. Ellenőrizd a BrandSeeder-t!
     *
     * MEGJEGYZÉS: A "Fender Squier Telecaster" bejegyzésnél brand_id=2 (Fender)
     * lett megadva, mivel a dokumentumban Fender márkaként szerepel.
     * A "Squier Stratocaster"-nél brand_id=27 (Squier) lett megadva.
     */

    public function run(): void
    {
        $instruments = [

            // ════════════════════════════════════════════════════════════════════
            //  1. AKUSZTIKUS GITÁR  (category_id: 1)
            // ════════════════════════════════════════════════════════════════════



            [
                'category_id'   => 1,
                'brand_id'      => 1,
                'condition'     => 'Használt',
                'title'         => 'Yamaha F310',
                'description'   => 'Kiváló belépő szintű dreadnought gitár, tömör lucfenyő tetőlappal.',
                'monthly_price' => 6000,
                'deposit'       => 15000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.KV_9oRgN5yEIOaLeFq9h8wHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 2,
                'condition'     => 'Használt',
                'title'         => 'Fender CD-60',
                'description'   => 'Gazdag, meleg hangzású dreadnought gitár, kezdőknek és haladóknak egyaránt.',
                'monthly_price' => 7000,
                'deposit'       => 18000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.FDncGMlUnYI_lM1xwuosoAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 3,
                'condition'     => 'Használt',
                'title'         => 'Ibanez V50',
                'description'   => 'Klasszikus dreadnought forma, könnyű játszhatóság, kezdők számára ideális.',
                'monthly_price' => 6500,
                'deposit'       => 16000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.Y1n-NPP4Uk91vI6AqYi86gHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 5,
                'condition'     => 'Újszerű',
                'title'         => 'Cort Earth70',
                'description'   => 'Solid spruce tetőlapú dreadnought, kiváló ár-érték arány.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.mkA6JorOeqGx1yIVjwNKzwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 6,
                'condition'     => 'Újszerű',
                'title'         => 'Takamine GD11M',
                'description'   => 'Mahagóni tetőlapú dreadnought gitár, kiváló rezonancia és tónusmélység.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
                'image'         => 'https://ts3.explicit.bing.net/th?id=OIP.Gu0VD3IAjst54p4crKng_wHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 7,
                'condition'     => 'Használt',
                'title'         => 'Epiphone DR-100',
                'description'   => 'Könnyű, barátságos akusztikus gitár, természetes és sunburst kivitelben.',
                'monthly_price' => 6500,
                'deposit'       => 17000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.yTodjplIDs6AfVRnULqEsgHaKT&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 8,
                'condition'     => 'Használt',
                'title'         => 'Harley Benton D-120CE',
                'description'   => 'Elektroakusztikus dreadnought cutaway gitár, beépített hangszedővel.',
                'monthly_price' => 5500,
                'deposit'       => 14000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.9OuDj1I1K2jMcCSW6pIg4gHaJ4&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 9,
                'condition'     => 'Újszerű',
                'title'         => 'Sigma DM-ST',
                'description'   => 'Természetes felületkezelésű solid top dreadnought, kiemelkedő hangminőség.',
                'monthly_price' => 9000,
                'deposit'       => 22000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.Sujyr509WVgTk-ZLqFZdEwHaHa&pid=15.1&o=7&rm=3',
            ],

            // ════════════════════════════════════════════════════════════════════
            //  2. DIGITÁLIS ZONGORA  (category_id: 2)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 2,
                'brand_id'      => 4,
                'condition'     => 'Újszerű',
                'title'         => 'Casio CDP-S110',
                'description'   => 'Kompakt 88 billentyűs digitális zongora, kezdőknek ideális.',
                'monthly_price' => 12000,
                'deposit'       => 30000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.jk4Tb8KeeL6mJPyKLJcy9wHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,
                'condition'     => 'Újszerű',
                'title'         => 'Roland FP-10',
                'description'   => 'Hordozható 88 billentyűs Roland, PHA-4 Standard mechanika.',
                'monthly_price' => 13000,
                'deposit'       => 35000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.pnsVAMzEQ8kEpns5REIVMwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha P-45',
                'description'   => '88 kalapácsos billentyűzet, tiszta Yamaha hangminőség.',
                'monthly_price' => 12500,
                'deposit'       => 28000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.IcCQnebXxeXGxxH4Gr-wxgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 11,
                'condition'     => 'Újszerű',
                'title'         => 'Korg B2',
                'description'   => '88 billentyűs Korg digitális zongora.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.04Xo95ECGL5oRQDVFOcDHwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 12,
                'condition'     => 'Új',
                'title'         => 'Kawai ES110',
                'description'   => 'Responsive Hammer Compact mechanika.',
                'monthly_price' => 15500,
                'deposit'       => 41000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.rq2m1CR1Oc69GCa4FongUwHaG2&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 4,
                'condition'     => 'Újszerű',
                'title'         => 'Casio PX-S1100',
                'description'   => 'Slim line Privia sorozat.',
                'monthly_price' => 14000,
                'deposit'       => 38000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.y0Ho_Nvy2hEBIFBNcceJiAHaF2&pid=15.1&o=7&rm=3',
            ],


                // ════════════════════════════════════════════════════════════════════
            //  3. DOBFELSZERELÉS  (category_id: 3)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Turbo Mesh Kit',
                'description'   => 'Elektromos dobszett mesh dobfejekkel, csendes játék, kezdőknek ideális.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.8oVZ09yiExnae9X0rMBuEAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Nitro Mesh Kit',
                'description'   => 'Elektromos dob mesh fejjel.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.OCK5Jibq8WjKWPj29-JYJAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland TD-1DMK',
                'description'   => 'Roland belépő szintű elektromos dob, mesh dobfejek.',
                'monthly_price' => 14000,
                'deposit'       => 38000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.yt85stDE0cTs-tzXEjXsywHaH7&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha DTX402K',
                'description'   => 'Yamaha DTX sorozat, 10 készlet, 287 hangszín.',
                'monthly_price' => 12000,
                'deposit'       => 30000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.a-DhvFjFZMA1oV7yCKLXrwHaGW&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 14,  // Millenium
                'condition'     => 'Újszerű',
                'title'         => 'Millenium MPS-850',
                'description'   => 'Mesh pad elektromos dobszett.',
                'monthly_price' => 10500,
                'deposit'       => 27000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.QvadRfJL239sdCrptkJ-QwHaHT&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Command Mesh',
                'description'   => 'Command Mesh Kit.',
                'monthly_price' => 13000,
                'deposit'       => 34000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.P_q9ENPhyZB_ni0BcI25VwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland TD-50KV2',
                'description'   => 'Csúcsmodell.',
                'monthly_price' => 30000,
                'deposit'       => 85000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP._JvyDGgI_n2rPhxuPKpYqAHaFE&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha DTX10K',
                'description'   => 'DTX10 sorozat.',
                'monthly_price' => 28000,
                'deposit'       => 80000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.kBuJIS0i3DirnR5BgzhCUQHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Strike Pro',
                'description'   => 'Strike Pro Kit.',
                'monthly_price' => 24000,
                'deposit'       => 68000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.M76jcX0vDCK91uisU-84mAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 14,  // Millenium
                'condition'     => 'Újszerű',
                'title'         => 'Millenium MPS-1000',
                'description'   => 'MPS-1000 elektromos dob.',
                'monthly_price' => 20000,
                'deposit'       => 55000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.W8NzLf6fQeDE02Bgbr_n8QHaEK&pid=15.1&o=7&rm=3',
            ],




            // ════════════════════════════════════════════════════════════════════
            //  4. HEGEDŰ  (category_id: 4)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 4,
                'brand_id'      => 33,  // Ismeretlen / Kezdőszett
                'condition'     => 'Használt',
                'title'         => '4/4-es hegedű kezdőszett',
                'description'   => 'Teljes méretű hegedű kezdőszett vonóval és kofferrel, kezdőknek.',
                'monthly_price' => 5000,
                'deposit'       => 12000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.fk3M6_xCOAM3uPIuWFWu8AHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Használt',
                'title'         => 'Stentor Student 1',
                'description'   => 'Belépő szintű Stentor hegedű, tömör tető és szett kiegészítők.',
                'monthly_price' => 5500,
                'deposit'       => 13000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.aqtSNgAAC9bk4_8NfcaMOQHaFj&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 16,  // Gewa
                'condition'     => 'Használt',
                'title'         => 'Gewa Allegro',
                'description'   => 'Német minőségű Gewa hegedű.',
                'monthly_price' => 7000,
                'deposit'       => 18000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.LyHRobyrrzAoO2T4rIJJLQHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha V3SKA',
                'description'   => 'Yamaha kezdő hegedűszett.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.OV7nu1V17K05d1qVhNmveAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 17,  // Primavera
                'condition'     => 'Használt',
                'title'         => 'Primavera 200',
                'description'   => 'Belépő szintű hegedű.',
                'monthly_price' => 6000,
                'deposit'       => 15000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.PkqDU3t9opIxxf3t71dgvAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 18,  // Stagg
                'condition'     => 'Használt',
                'title'         => 'Stagg VN-4/4',
                'description'   => 'Teljes méretű Stagg hegedű.',
                'monthly_price' => 5000,
                'deposit'       => 12000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.Wxvdi067snPh5hFnyvEzhgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 19,  // Hidersine
                'condition'     => 'Újszerű',
                'title'         => 'Hidersine Vivente',
                'description'   => 'Minőségi Hidersine hegedű.',
                'monthly_price' => 8500,
                'deposit'       => 21000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.v7vRwSyHZGaOsQ27eImzGwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 17,  // Primavera
                'condition'     => 'Használt',
                'title'         => 'Primavera 100',
                'description'   => 'Belépő szintű hegedű.',
                'monthly_price' => 5500,
                'deposit'       => 13500,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.BmiDah8RcaB9fBqm5cBZ4QHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Újszerű',
                'title'         => 'Stentor Conservatoire',
                'description'   => 'Felső kategóriás Stentor modell.',
                'monthly_price' => 8500,
                'deposit'       => 21000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.2by8HCYH1Q2qQ_lq-bsMEgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Újszerű',
                'title'         => 'Stentor Elysia',
                'description'   => 'Felső kategóriás Stentor modell.',
                'monthly_price' => 11500,
                'deposit'       => 30000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.tKnLR969q0Xe8MM2AIVhSwHaHa&pid=15.1&o=7&rm=3',
            ],

            // ════════════════════════════════════════════════════════════════════
            //  5. ALT SZAXOFON  (category_id: 5)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Használt',
                'title'         => 'Yamaha YAS-280',
                'description'   => 'Megbízható belépő szintű alt szaxofon.',
                'monthly_price' => 14000,
                'deposit'       => 40000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.T93kIxeDVRR8RtGo7KDglwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 22,  // Trevor James
                'condition'     => 'Használt',
                'title'         => 'Trevor James The Horn',
                'description'   => 'Kedvelt diák hangszer.',
                'monthly_price' => 16000,
                'deposit'       => 48000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.OKvCxdiTWUSbuDU9BgdvpAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 23,  // Conn-Selmer
                'condition'     => 'Használt',
                'title'         => 'Conn-Selmer AS650',
                'description'   => 'Diák alt szaxofon.',
                'monthly_price' => 13500,
                'deposit'       => 36000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.dBTnEKWq_5KXwqg-ohPoKgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 24,  // Gear4music
                'condition'     => 'Használt',
                'title'         => 'Gear4music Alto Sax',
                'description'   => 'Belépő szintű alt szaxofon.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.s9GsVKOotA7zG-Tv4lyCbgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 20,  // Jupiter
                'condition'     => 'Használt',
                'title'         => 'Jupiter JAS700',
                'description'   => 'Haladó diák hangszer.',
                'monthly_price' => 17000,
                'deposit'       => 50000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.R4pZDftqAdPt4ofFcBmwbQHaHu&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 25,  // Buffet Crampon
                'condition'     => 'Használt',
                'title'         => 'Buffet Crampon 100 Series',
                'description'   => 'Minőségi alt szaxofon.',
                'monthly_price' => 18000,
                'deposit'       => 55000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.G1EVlGoYeCEplm3O4QieSAAAAA&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 22,  // Trevor James
                'condition'     => 'Használt',
                'title'         => 'Trevor James Alpha',
                'description'   => 'Könnyű fújhatóság.',
                'monthly_price' => 12500,
                'deposit'       => 33000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.mPFfLMXuCH3MqRapautybgHaLH&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha YAS-62',
                'description'   => 'Professzionális Yamaha alt szaxofon.',
                'monthly_price' => 25000,
                'deposit'       => 75000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.IUIPNzcZryapXC4u3xkR4QHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 20,  // Jupiter
                'condition'     => 'Újszerű',
                'title'         => 'Jupiter JAS1100',
                'description'   => 'Haladó Jupiter modell.',
                'monthly_price' => 21000,
                'deposit'       => 60000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.BHntntgBk_qG6dYyhZKEKgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 26,  // Yanagisawa
                'condition'     => 'Újszerű',
                'title'         => 'Yanagisawa AWO1',
                'description'   => 'Prémium japán alt szaxofon.',
                'monthly_price' => 28000,
                'deposit'       => 85000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.oDRQUtRcQajexygUWa-lBgHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 21,  // Selmer
                'condition'     => 'Újszerű',
                'title'         => 'Selmer Series 2',
                'description'   => 'Professzionális Selmer hangszer.',
                'monthly_price' => 30000,
                'deposit'       => 90000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.a2nb6DMb3FX2C1f7WQU1pQHaJe&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 25,  // Buffet Crampon
                'condition'     => 'Újszerű',
                'title'         => 'Buffet Senzo',
                'description'   => 'Prémium francia alt szaxofon.',
                'monthly_price' => 27000,
                'deposit'       => 80000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.AEXoraSyXQlfYxy-rEm1hwHaHa&pid=15.1&o=7&rm=3',
            ],


            // ════════════════════════════════════════════════════════════════════
            //  6. ELEKTROMOS GITÁR  (category_id: 6)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 6,
                'brand_id'      => 27,  // Squier
                'condition'     => 'Használt',
                'title'         => 'Squier Stratocaster + erősítő',
                'description'   => 'Kezdőknek ideális elektromos gitár szett.',
                'monthly_price' => 9000,
                'deposit'       => 20000,
                'image'         => 'https://ts3.mm.bing.net/th?id=OIP.zFuSmRWFTmPca01eO3xD2AHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 7,   // Epiphone
                'condition'     => 'Használt',
                'title'         => 'Epiphone Les Paul Special 2',
                'description'   => 'Belépő szintű Les Paul modell.',
                'monthly_price' => 8500,
                'deposit'       => 20000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.Z4BFf-0vM04O87Z2YQ_NfAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Használt',
                'title'         => 'Yamaha Pacifica 112V',
                'description'   => 'Kiváló ár-érték arányú Pacifica modell.',
                'monthly_price' => 9500,
                'deposit'       => 22000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.G6u_sZVEAa0_7oSFqwTuSAHaI2&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Használt',
                'title'         => 'Fender Squier Telecaster',
                'description'   => 'Klasszikus Telecaster forma.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.Ewi35LGrhF61mc66FhShagHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 8,   // Harley Benton
                'condition'     => 'Használt',
                'title'         => 'Harley Benton ST-20',
                'description'   => 'Belépő szintű ST modell.',
                'monthly_price' => 6500,
                'deposit'       => 15000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.AdW4izEqU4daB8TsEprsvAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 5,   // Cort
                'condition'     => 'Használt',
                'title'         => 'Cort X100',
                'description'   => 'Modern formájú elektromos gitár.',
                'monthly_price' => 8000,
                'deposit'       => 19000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.k7EwvVIEhE-rdcftzagX3QHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 28,  // Jackson
                'condition'     => 'Használt',
                'title'         => 'Jackson JS11 Dinky',
                'description'   => 'Metal orientált hangszer.',
                'monthly_price' => 9500,
                'deposit'       => 23000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.QelzF30QUqh5r5SO4aGLvQHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 29,  // Gibson
                'condition'     => 'Használt',
                'title'         => 'Gibson Les Paul Studio',
                'description'   => 'Prémium Les Paul modell.',
                'monthly_price' => 22000,
                'deposit'       => 70000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.VwQEb2cbfwhrc2ZeSxJA1wHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Használt',
                'title'         => 'Ibanez AZES40',
                'description'   => 'Modern Ibanez modell.',
                'monthly_price' => 12000,
                'deposit'       => 32000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.pBJH1tii9Fd_LjyY8ORykwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 30,  // PRS
                'condition'     => 'Használt',
                'title'         => 'PRS SE Custom 24',
                'description'   => 'Kedvelt PRS modell.',
                'monthly_price' => 15000,
                'deposit'       => 45000,
                'image'         => 'https://ts4.mm.bing.net/th?id=OIP.I0SRLFQccyUD-laDCZpzMAHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 31,  // ESP
                'condition'     => 'Használt',
                'title'         => 'ESP LTD EC-256',
                'description'   => 'Rock/metal orientált hangszer.',
                'monthly_price' => 12500,
                'deposit'       => 35000,
                'image'         => 'https://ts1.mm.bing.net/th?id=OIP.kL0igh5MNGMitCTpmPqrMwHaHa&pid=15.1&o=7&rm=3',
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 32,  // Schecter
                'condition'     => 'Használt',
                'title'         => 'Schecter C-6 Deluxe',
                'description'   => 'Belépő szintű metal gitár.',
                'monthly_price' => 11500,
                'deposit'       => 33000,
                'image'         => 'https://ts2.mm.bing.net/th?id=OIP.eTA4lVZbr-Kg3S4egl428wHaHa&pid=15.1&o=7&rm=3',
            ],

        ];

        foreach ($instruments as $instrument) {
            Instrument::create($instrument);
        }
    }
}
