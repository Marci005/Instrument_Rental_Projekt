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
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Használt',
                'title'         => 'Yamaha F310',
                'description'   => 'Kiváló belépő szintű dreadnought gitár, tömör lucfenyő tetőlappal.',
                'monthly_price' => 6000,
                'deposit'       => 15000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Használt',
                'title'         => 'Fender CD-60',
                'description'   => 'Gazdag, meleg hangzású dreadnought gitár, kezdőknek és haladóknak egyaránt.',
                'monthly_price' => 7000,
                'deposit'       => 18000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Használt',
                'title'         => 'Ibanez V50',
                'description'   => 'Klasszikus dreadnought forma, könnyű játszhatóság, kezdők számára ideális.',
                'monthly_price' => 6500,
                'deposit'       => 16000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 5,   // Cort
                'condition'     => 'Használt',
                'title'         => 'Cort AD810',
                'description'   => 'Megbízható belépő szintű akusztikus gitár, természetes befejezéssel.',
                'monthly_price' => 6000,
                'deposit'       => 15000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 6,   // Takamine
                'condition'     => 'Újszerű',
                'title'         => 'Takamine GD11M',
                'description'   => 'Mahagóni tetőlapú dreadnought gitár, kiváló rezonancia és tónusmélység.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 7,   // Epiphone
                'condition'     => 'Használt',
                'title'         => 'Epiphone DR-100',
                'description'   => 'Könnyű, barátságos akusztikus gitár, természetes és sunburst kivitelben.',
                'monthly_price' => 6500,
                'deposit'       => 17000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 8,   // Harley Benton
                'condition'     => 'Használt',
                'title'         => 'Harley Benton D-120CE',
                'description'   => 'Elektroakusztikus dreadnought cutaway gitár, beépített hangszedővel.',
                'monthly_price' => 5500,
                'deposit'       => 14000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 9,   // Sigma
                'condition'     => 'Újszerű',
                'title'         => 'Sigma DM-ST',
                'description'   => 'Természetes felületkezelésű solid top dreadnought, kiemelkedő hangminőség.',
                'monthly_price' => 9000,
                'deposit'       => 22000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha FG800',
                'description'   => 'Solid spruce tetőlapú dreadnought, Yamaha megbízhatóságával.',
                'monthly_price' => 7500,
                'deposit'       => 19000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez AW54',
                'description'   => 'All-mahogany artwood sorozat, meleg és tömör hangzásvilág.',
                'monthly_price' => 8500,
                'deposit'       => 21000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Használt',
                'title'         => 'Yamaha FS800',
                'description'   => 'Kisebb concert méretű gitár, solid spruce tetőlappal, kényelmes játszhatóság.',
                'monthly_price' => 7000,
                'deposit'       => 18000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Újszerű',
                'title'         => 'Fender PM-1 Standard',
                'description'   => 'Prémium dreadnought, solid sitka spruce tetőlap, mahagóni oldal és hát.',
                'monthly_price' => 11000,
                'deposit'       => 30000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez PF15ECE',
                'description'   => 'Elektroakusztikus dreadnought cutaway, Fishman Sonicore hangszedővel.',
                'monthly_price' => 8500,
                'deposit'       => 22000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 5,   // Cort
                'condition'     => 'Újszerű',
                'title'         => 'Cort Earth70',
                'description'   => 'Solid spruce tetőlapú dreadnought, kiváló ár-érték arány.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 9,   // Sigma
                'condition'     => 'Újszerű',
                'title'         => 'Sigma 000M-15',
                'description'   => 'All-solid mahagóni 000-as méret, vintage karakter és telt tónus.',
                'monthly_price' => 10000,
                'deposit'       => 27000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Újszerű',
                'title'         => 'Fender Malibu Player',
                'description'   => 'Compact auditorium akusztikus gitár, kényelmes méret és élénk hangzás.',
                'monthly_price' => 9500,
                'deposit'       => 25000,
            ],
            [
                'category_id'   => 1,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez AEG50',
                'description'   => 'Elektroakusztikus cutaway, vékony test, Fishman Sonicore hangszedő, kényelmes.',
                'monthly_price' => 8500,
                'deposit'       => 23000,
            ],

            // ════════════════════════════════════════════════════════════════════
            //  2. DIGITÁLIS ZONGORA  (category_id: 2)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 2,
                'brand_id'      => 4,   // Casio
                'condition'     => 'Újszerű',
                'title'         => 'Casio CDP-S110',
                'description'   => 'Kompakt 88 billentyűs digitális zongora, kezdőknek ideális.',
                'monthly_price' => 12000,
                'deposit'       => 30000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland FP-10',
                'description'   => 'Hordozható 88 billentyűs Roland, PHA-4 Standard mechanika, autentikus érzet.',
                'monthly_price' => 13000,
                'deposit'       => 35000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha P-45',
                'description'   => '88 kalapácsos billentyűzet, tiszta Yamaha hangminőség, kompakt dizájn.',
                'monthly_price' => 12500,
                'deposit'       => 28000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 11,  // Korg
                'condition'     => 'Újszerű',
                'title'         => 'Korg B2',
                'description'   => '88 billentyűs Korg, Natural Weighted Hammer Action, 12 hangszín.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland FP-30X',
                'description'   => 'Fejlett PHA-4 Standard mechanika, SuperNATURAL hangminta, Bluetooth.',
                'monthly_price' => 15000,
                'deposit'       => 40000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 4,   // Casio
                'condition'     => 'Újszerű',
                'title'         => 'Casio PX-S1100',
                'description'   => 'Slim line Privia sorozat, 88 kalapácsos billentyű, hangstúdió funkciók.',
                'monthly_price' => 14000,
                'deposit'       => 38000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha P-125',
                'description'   => 'GHW mechanika, Pure CF hangminta, kiemelkedő hangminőség hordozható testben.',
                'monthly_price' => 16000,
                'deposit'       => 42000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 12,  // Kawai
                'condition'     => 'Új',
                'title'         => 'Kawai ES110',
                'description'   => 'Responsive Hammer Compact mechanika, 88 billentyű, kiváló játékérzet.',
                'monthly_price' => 15500,
                'deposit'       => 41000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 4,   // Casio
                'condition'     => 'Újszerű',
                'title'         => 'Casio CDP-S360',
                'description'   => 'Kompakt Casio, 700 hangszín, ritmusfunkciók és beépített effektek.',
                'monthly_price' => 13500,
                'deposit'       => 36000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland GO:PIANO',
                'description'   => 'Könnyű belépő szintű Roland, 61 billentyű, Bluetooth hangszórókapcsolat.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha NP-32',
                'description'   => '76 billentyűs piaggero sorozat, hordozható és könnyű, elemmel is működik.',
                'monthly_price' => 9500,
                'deposit'       => 24000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland FP-E50',
                'description'   => 'Entertainers piano, akkord funkciók, 88 billentyű, PHA-4 Standard mechanika.',
                'monthly_price' => 18000,
                'deposit'       => 48000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha DGX-670',
                'description'   => 'Grand piano érzet, CFX hangminta, automatikus kíséreti funkciókkal.',
                'monthly_price' => 20000,
                'deposit'       => 55000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 4,   // Casio
                'condition'     => 'Új',
                'title'         => 'Casio PX-770',
                'description'   => 'Privia bútorstílusú zongora, 88 kalapácsos billentyű, 3 pedálos rendszer.',
                'monthly_price' => 17000,
                'deposit'       => 45000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 12,  // Kawai
                'condition'     => 'Új',
                'title'         => 'Kawai ES120',
                'description'   => 'Újgenerációs Kawai portabilis, RHC mechanika, Bluetooth MIDI és audio.',
                'monthly_price' => 17500,
                'deposit'       => 47000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland FP-60X',
                'description'   => 'Prémium portabilis Roland, PHA-50 mechanika, SuperNATURAL modellezés.',
                'monthly_price' => 22000,
                'deposit'       => 60000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha P-515',
                'description'   => 'Csúcsminőségű hordozható Yamaha, GrandTouch-S mechanika, CFX és Bösendorfer hangminták.',
                'monthly_price' => 25000,
                'deposit'       => 70000,
            ],
            [
                'category_id'   => 2,
                'brand_id'      => 4,   // Casio
                'condition'     => 'Új',
                'title'         => 'Casio PC-S3100',
                'description'   => 'Privia X sorozat, kalapácsos mechanika, 96 polifónia, fejlett hangminőség.',
                'monthly_price' => 19000,
                'deposit'       => 52000,
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
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Nitro Mesh Kit',
                'description'   => '8 részes elektromos dobszett, 40 készlet, 385 hangszín, USB MIDI kimenet.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Újszerű',
                'title'         => 'Roland TD-1DMK',
                'description'   => 'Roland belépő szintű elektromos dob, mesh dobfejek, kompakt rack rendszer.',
                'monthly_price' => 14000,
                'deposit'       => 38000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha DTX402K',
                'description'   => 'Yamaha DTX sorozat, 10 készlet, 287 hangszín, Training funkciókkal.',
                'monthly_price' => 12000,
                'deposit'       => 30000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 14,  // Millenium
                'condition'     => 'Újszerű',
                'title'         => 'Millenium MPS-850',
                'description'   => 'Mesh pad elektromos dobszett, csendes játékfelület, haladó funkciók.',
                'monthly_price' => 10500,
                'deposit'       => 27000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland TD-07DMK',
                'description'   => 'Fejlett TD-07 modul, mesh dobfejek, Bluetooth, Steinberg Cubase AI.',
                'monthly_price' => 16000,
                'deposit'       => 42000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Surge Mesh',
                'description'   => '8 részes Surge Mesh Kit, 24 készlet, 60 track hangzókönyvtár.',
                'monthly_price' => 12500,
                'deposit'       => 32000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha DTX6K-X',
                'description'   => 'Professzionális DTX6 modul, silicon fejek, fejlett dob edzőprogram.',
                'monthly_price' => 18000,
                'deposit'       => 50000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland TD-17KVX',
                'description'   => 'TD-17 modul, V-Cymbal, mesh snare, prémium érzet és hangminőség.',
                'monthly_price' => 22000,
                'deposit'       => 60000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Command Mesh',
                'description'   => '8 részes Command Mesh Kit, fejlett modul, 70+ készlet, USB MIDI.',
                'monthly_price' => 13000,
                'deposit'       => 34000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland TD-27KV',
                'description'   => 'Csúcs Roland TD-27 modul, V-Cymbal Pro, prémium mesh dobok, profik számára.',
                'monthly_price' => 25000,
                'deposit'       => 70000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha DTX8K',
                'description'   => 'Csúcskategóriás DTX sorozat, DTX-PRO modul, 3 zónás dobfejek.',
                'monthly_price' => 23000,
                'deposit'       => 65000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Újszerű',
                'title'         => 'Alesis Crimson 2',
                'description'   => 'Crimson 2 Kit, 11 részes, fejlett Crimson II modul, 1210+ hangszín.',
                'monthly_price' => 14000,
                'deposit'       => 38000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 10,  // Roland
                'condition'     => 'Új',
                'title'         => 'Roland TD-50KV2',
                'description'   => 'Roland zászlóshajó dobszett, TD-50X modul, V-Drums Ultra hangminőség.',
                'monthly_price' => 30000,
                'deposit'       => 85000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha DTX10K',
                'description'   => 'Legfejlettebb Yamaha elektromos dobszett, tényleges dobbőr érzet, DTX-PRO modul.',
                'monthly_price' => 28000,
                'deposit'       => 80000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 13,  // Alesis
                'condition'     => 'Új',
                'title'         => 'Alesis Strike Pro',
                'description'   => 'Prémium Strike Pro szett, 14 részes, valósághű dobhangok, USB audio.',
                'monthly_price' => 24000,
                'deposit'       => 68000,
            ],
            [
                'category_id'   => 3,
                'brand_id'      => 14,  // Millenium
                'condition'     => 'Új',
                'title'         => 'Millenium MPS-1000',
                'description'   => 'Prémium Millenium elektromos dobszett, fejlett modul, mesh dobfejek.',
                'monthly_price' => 20000,
                'deposit'       => 55000,
            ],

            // ════════════════════════════════════════════════════════════════════
            //  4. HEGEDŰ  (category_id: 4)
            //  MEGJEGYZÉS: brand_id=33 (Ismeretlen) a készlethez szükséges egy
            //  "Ismeretlen" vagy "Vegyes" nevű brand bejegyzés a brands táblában.
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 4,
                'brand_id'      => 33,  // Ismeretlen / Kezdőszett
                'condition'     => 'Használt',
                'title'         => '4/4-es hegedű kezdőszett',
                'description'   => 'Teljes méretű hegedű kezdőszett vonóval és kofferrel, kezdőknek.',
                'monthly_price' => 5000,
                'deposit'       => 12000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Használt',
                'title'         => 'Stentor Student 1',
                'description'   => 'Belépő szintű Stentor hegedű, tömör tető és szett kiegészítők.',
                'monthly_price' => 5500,
                'deposit'       => 13000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Használt',
                'title'         => 'Stentor Student 2',
                'description'   => 'Fejlettebb Stentor Student, jobb hangminőség haladó kezdőknek.',
                'monthly_price' => 6500,
                'deposit'       => 16000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 16,  // Gewa
                'condition'     => 'Használt',
                'title'         => 'Gewa Allegro',
                'description'   => 'Német minőségű Gewa hegedű, tömör tetőlap, finom hangzás.',
                'monthly_price' => 7000,
                'deposit'       => 18000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha V3SKA',
                'description'   => 'Yamaha kezdő hegedűszett tokkal, vonóval és gyantával, megbízható minőség.',
                'monthly_price' => 8000,
                'deposit'       => 20000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 17,  // Primavera
                'condition'     => 'Használt',
                'title'         => 'Primavera 200',
                'description'   => 'Belépő szintű hegedű, vonóval és könnyű tokkal szállítva.',
                'monthly_price' => 6000,
                'deposit'       => 15000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 18,  // Stagg
                'condition'     => 'Használt',
                'title'         => 'Stagg VN-4/4',
                'description'   => 'Teljes méretű Stagg hegedű, tömör lucfenyő tetőlap, kényelmes kezdő hangszer.',
                'monthly_price' => 5000,
                'deposit'       => 12000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 16,  // Gewa
                'condition'     => 'Újszerű',
                'title'         => 'Gewa Ideale',
                'description'   => 'Középkategóriás Gewa, jobb hangzás és könnyebb intonálás.',
                'monthly_price' => 7500,
                'deposit'       => 19000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha V5SC',
                'description'   => 'Kézzel készített tető, haladó kezdőknek és zeneiskolásoknak ajánlott.',
                'monthly_price' => 9000,
                'deposit'       => 22000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 19,  // Hidersine
                'condition'     => 'Újszerű',
                'title'         => 'Hidersine Vivente',
                'description'   => 'Olasz tervezésű hegedű, Brazilwood vonó, könnyű hordozható tok.',
                'monthly_price' => 8500,
                'deposit'       => 21000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 17,  // Primavera
                'condition'     => 'Használt',
                'title'         => 'Primavera 100',
                'description'   => 'Alap szintű hegedű gyerekeknek és felnőtt kezdőknek egyaránt.',
                'monthly_price' => 5500,
                'deposit'       => 13500,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha V7SG',
                'description'   => 'Kézzel formált tető és bélés, prémium hegedű zeneiskolai szinten.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Újszerű',
                'title'         => 'Stentor Conservatoire',
                'description'   => 'Konzervatóriumi szintű Stentor, kézzel készített tető, prémium faanyag.',
                'monthly_price' => 8500,
                'deposit'       => 21000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 16,  // Gewa
                'condition'     => 'Újszerű',
                'title'         => 'Gewa Maestro',
                'description'   => 'Fejlett Gewa hegedű, mester szintű kézimunka, gazdag tónusmélység.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha V10G',
                'description'   => 'Professzionális Yamaha hegedű, kézzel formált tető, mester-szintű kivitel.',
                'monthly_price' => 12000,
                'deposit'       => 32000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 16,  // Gewa
                'condition'     => 'Újszerű',
                'title'         => 'Gewa Pure',
                'description'   => 'Komplett Gewa Pure hegedűszett tokkal és vonóval, kiváló minőség.',
                'monthly_price' => 9500,
                'deposit'       => 26000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 15,  // Stentor
                'condition'     => 'Újszerű',
                'title'         => 'Stentor Elysia',
                'description'   => 'Csúcskategóriás Stentor, kiváló vetítési képesség, professzionális szint.',
                'monthly_price' => 11500,
                'deposit'       => 30000,
            ],
            [
                'category_id'   => 4,
                'brand_id'      => 17,  // Primavera
                'condition'     => 'Újszerű',
                'title'         => 'Primavera 300',
                'description'   => 'Fejlettebb Primavera sorozat, erős hangvetítés, haladó zenészeknek.',
                'monthly_price' => 8000,
                'deposit'       => 22000,
            ],

            // ════════════════════════════════════════════════════════════════════
            //  5. ALT SZAXOFON  (category_id: 5)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha YAS-280',
                'description'   => 'Megbízható Yamaha szaxofon, kezdők és középhaladók számára, könnyen kezelhető.',
                'monthly_price' => 14000,
                'deposit'       => 40000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 20,  // Jupiter
                'condition'     => 'Újszerű',
                'title'         => 'Jupiter JAS500',
                'description'   => 'Könnyű és könnyen kezelhető Jupiter alt szaxofon, iskolai és kezdő szintre.',
                'monthly_price' => 13000,
                'deposit'       => 35000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 21,  // Selmer
                'condition'     => 'Újszerű',
                'title'         => 'Selmer Prelude AS711',
                'description'   => 'Selmer belépő szintű szaxofon, könnyű intonálás, kényelmes ergodesign.',
                'monthly_price' => 15000,
                'deposit'       => 45000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha YAS-26',
                'description'   => 'Megbízható iskolai Yamaha szaxofon, tartós réz hangtest, sima játék.',
                'monthly_price' => 14000,
                'deposit'       => 40000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 22,  // Trevor James
                'condition'     => 'Új',
                'title'         => 'Trevor James The Horn',
                'description'   => 'Trevor James professzionális szaxofon, kézzel vésett csengő, gazdag hang.',
                'monthly_price' => 16000,
                'deposit'       => 48000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 23,  // Conn-Selmer
                'condition'     => 'Újszerű',
                'title'         => 'Conn-Selmer AS650',
                'description'   => 'Könnyű Conn-Selmer, aranyozott hangtest, kezdő iskolai szintre.',
                'monthly_price' => 13500,
                'deposit'       => 36000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 24,  // Gear4music
                'condition'     => 'Újszerű',
                'title'         => 'Gear4music Alto Sax',
                'description'   => 'Belépő szintű alt szaxofon, sárgaréz hangtest, tokkal szállítva.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 20,  // Jupiter
                'condition'     => 'Új',
                'title'         => 'Jupiter JAS700',
                'description'   => 'Középkategóriás Jupiter, fém csengő, javított billenty\u0171 rendszer.',
                'monthly_price' => 17000,
                'deposit'       => 50000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 25,  // Buffet Crampon
                'condition'     => 'Új',
                'title'         => 'Buffet Crampon 100 Series',
                'description'   => 'Buffet Crampon belépő sorozat, pontosan hangolt billentyűk, tartós hangtest.',
                'monthly_price' => 18000,
                'deposit'       => 55000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha YAS-480',
                'description'   => 'Haladó Yamaha szaxofon, jobb intonáció, ergonomikus billentyűelrendezés.',
                'monthly_price' => 20000,
                'deposit'       => 60000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 22,  // Trevor James
                'condition'     => 'Újszerű',
                'title'         => 'Trevor James Alpha',
                'description'   => 'Kompakt Trevor James belépő modell, lakk befejezés, kényelmes játszhatóság.',
                'monthly_price' => 12500,
                'deposit'       => 33000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 21,  // Selmer
                'condition'     => 'Új',
                'title'         => 'Selmer Axos',
                'description'   => 'Prémium Selmer Axos, kézzel vésett, gazdag hangszín, professzionális szint.',
                'monthly_price' => 22000,
                'deposit'       => 65000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha YAS-62',
                'description'   => 'Professzionális Yamaha szaxofon, egyik legnépszerűbb profi modell.',
                'monthly_price' => 25000,
                'deposit'       => 75000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 20,  // Jupiter
                'condition'     => 'Új',
                'title'         => 'Jupiter JAS1100',
                'description'   => 'Prémium Jupiter modell, kézzel vésett csengő, prémium hangkarakter.',
                'monthly_price' => 21000,
                'deposit'       => 60000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 26,  // Yanagisawa
                'condition'     => 'Új',
                'title'         => 'Yanagisawa AWO1',
                'description'   => 'Japán prémium szaxofon, bronz hangtest, kivételes projekció és hangszín.',
                'monthly_price' => 28000,
                'deposit'       => 85000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 21,  // Selmer
                'condition'     => 'Új',
                'title'         => 'Selmer Series 2',
                'description'   => 'Világhírű Selmer Series II, a legtöbb profi szaxofonista választása.',
                'monthly_price' => 30000,
                'deposit'       => 90000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Új',
                'title'         => 'Yamaha YAS-875EX',
                'description'   => 'Yamaha csúcsmodell, egyedi réz ötvözet, kivételes hangszín és dinamika.',
                'monthly_price' => 35000,
                'deposit'       => 100000,
            ],
            [
                'category_id'   => 5,
                'brand_id'      => 25,  // Buffet Crampon
                'condition'     => 'Új',
                'title'         => 'Buffet Senzo',
                'description'   => 'Prémium Buffet szaxofon, kézzel vésett, komplex tónus és válaszkészség.',
                'monthly_price' => 27000,
                'deposit'       => 80000,
            ],

            // ════════════════════════════════════════════════════════════════════
            //  6. ELEKTROMOS GITÁR  (category_id: 6)
            //  MEGJEGYZÉS: "Fender Squier Telecaster" → brand_id=2 (Fender)
            //              "Squier Stratocaster"      → brand_id=27 (Squier)
            // ════════════════════════════════════════════════════════════════════

            [
                'category_id'   => 6,
                'brand_id'      => 27,  // Squier
                'condition'     => 'Újszerű',
                'title'         => 'Squier Stratocaster + erősítő',
                'description'   => 'Fender Squier Stratocaster szett kis erősítővel, kezdőknek tökéletes csomag.',
                'monthly_price' => 9000,
                'deposit'       => 20000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 7,   // Epiphone
                'condition'     => 'Újszerű',
                'title'         => 'Epiphone Les Paul Special 2',
                'description'   => 'Klasszikus Les Paul forma, mahagóni test, humbuckerek, kezdőknek.',
                'monthly_price' => 8500,
                'deposit'       => 20000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha Pacifica 112V',
                'description'   => 'Az egyik legjobb belépő szintű gitár, HSS konfiguráció, stabil hangolás.',
                'monthly_price' => 9500,
                'deposit'       => 22000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez GRX70QA',
                'description'   => 'Quilted Maple top, HSH hangszedők, dinamikus tremolo rendszer.',
                'monthly_price' => 9000,
                'deposit'       => 21000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Újszerű',
                'title'         => 'Fender Squier Telecaster',
                'description'   => 'Telecaster klasszikus hangzás, single coil hangszedők, kényelmes nyak.',
                'monthly_price' => 10000,
                'deposit'       => 25000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 8,   // Harley Benton
                'condition'     => 'Használt',
                'title'         => 'Harley Benton ST-20',
                'description'   => 'Legolcsóbb elektromos opció, Strat forma, 3 single coil hangszedő.',
                'monthly_price' => 6500,
                'deposit'       => 15000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 5,   // Cort
                'condition'     => 'Újszerű',
                'title'         => 'Cort X100',
                'description'   => 'Superstrat forma, HSS konfiguráció, Floyd Rose típusú tremolo.',
                'monthly_price' => 8000,
                'deposit'       => 19000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 28,  // Jackson
                'condition'     => 'Újszerű',
                'title'         => 'Jackson JS11 Dinky',
                'description'   => 'Metal-orientált Dinky test, HSS konfiguráció, gyors játszhatóság.',
                'monthly_price' => 9500,
                'deposit'       => 23000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 7,   // Epiphone
                'condition'     => 'Újszerű',
                'title'         => 'Epiphone SG Special',
                'description'   => 'SG forma, két open-coil humbucker, vékony nyak, könnyed játszhatóság.',
                'monthly_price' => 9000,
                'deposit'       => 22000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez RG421',
                'description'   => 'Mahagóni test, Quantum hangszedők, fixed bridge, pontosság és erő.',
                'monthly_price' => 11000,
                'deposit'       => 28000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 1,   // Yamaha
                'condition'     => 'Újszerű',
                'title'         => 'Yamaha Revstar RS320',
                'description'   => 'Egyedi Revstar dizájn, P90-stílusú hangszedők, karakteres tónusvilág.',
                'monthly_price' => 11500,
                'deposit'       => 26000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Újszerű',
                'title'         => 'Fender Player Stratocaster',
                'description'   => 'Mexikói gyártású Player sorozat, 3 Alnico V single coil, 2-point tremolo.',
                'monthly_price' => 14000,
                'deposit'       => 40000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 29,  // Gibson
                'condition'     => 'Új',
                'title'         => 'Gibson Les Paul Studio',
                'description'   => 'Valódi USA Gibson, BurstBucker hangszedők, mahagóni test, maple nyak.',
                'monthly_price' => 22000,
                'deposit'       => 70000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 3,   // Ibanez
                'condition'     => 'Újszerű',
                'title'         => 'Ibanez AZES40',
                'description'   => 'AZ sorozat belépő modell, prémium Ibanez mechanika, modern hangzás.',
                'monthly_price' => 12000,
                'deposit'       => 32000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 2,   // Fender
                'condition'     => 'Újszerű',
                'title'         => 'Fender Player Telecaster',
                'description'   => 'Mexikói Telecaster, 2 Player Series Alnico V Tele hangszedő, tartós hardver.',
                'monthly_price' => 13500,
                'deposit'       => 38000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 30,  // PRS
                'condition'     => 'Új',
                'title'         => 'PRS SE Custom 24',
                'description'   => 'PRS SE sorozat, 85/15 hangszedők, carved maple top, gyönyörű kivitel.',
                'monthly_price' => 15000,
                'deposit'       => 45000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 31,  // ESP
                'condition'     => 'Újszerű',
                'title'         => 'ESP LTD EC-256',
                'description'   => 'EC forma, Duncan Designed hangszedők, mahagóni test, arched top.',
                'monthly_price' => 12500,
                'deposit'       => 35000,
            ],
            [
                'category_id'   => 6,
                'brand_id'      => 32,  // Schecter
                'condition'     => 'Újszerű',
                'title'         => 'Schecter C-6 Deluxe',
                'description'   => 'Klasszikus C-forma, Duncan Designed hangszedők, könnyű és stabil test.',
                'monthly_price' => 11500,
                'deposit'       => 33000,
            ],

        ];

        foreach ($instruments as $instrument) {
            Instrument::create($instrument);
        }
    }
}
