<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstrumentBrand;

class InstrumentBrandSeeder extends Seeder
{
    /*
     * SORRENDÉRTÉSÍTÉS: az InstrumentSeeder az itt definiált sorrend szerinti
     * brand_id-kre hivatkozik (1=Yamaha, 2=Fender, ..., 33=Ismeretlen).
     * NE változtass a sorrenden, különben az InstrumentSeeder hibás brand-ekre fog hivatkozni!
     */
    public function run(): void
    {
        $brands = [
            ['brand_name' => 'Yamaha',         'brand_description' => 'Japán hangszer- és elektronikai gyártó.'],
            ['brand_name' => 'Fender',         'brand_description' => 'Világhírű gitár- és basszusgyártó.'],
            ['brand_name' => 'Ibanez',         'brand_description' => 'Japán gitármárka, rock és metal játékosok kedvence.'],
            ['brand_name' => 'Casio',          'brand_description' => 'Digitális zongorák és szintetizátorok gyártója.'],
            ['brand_name' => 'Cort',           'brand_description' => 'Koreai gitárgyártó, kiváló ár-érték aránnyal.'],
            ['brand_name' => 'Takamine',       'brand_description' => 'Japán prémium akusztikus gitármárka.'],
            ['brand_name' => 'Epiphone',       'brand_description' => 'Gibson leányvállalata, megfizethető Les Paul és SG modellek.'],
            ['brand_name' => 'Harley Benton',  'brand_description' => 'Thomann saját márkája, kiváló ár-érték arány.'],
            ['brand_name' => 'Sigma',          'brand_description' => 'Martin által alapított, prémium akusztikusgitár-márka.'],
            ['brand_name' => 'Roland',         'brand_description' => 'Professzionális zenei eszközök gyártója.'],
            ['brand_name' => 'Korg',           'brand_description' => 'Szintetizátorok és digitális zongorák japán gyártója.'],
            ['brand_name' => 'Kawai',          'brand_description' => 'Japán zongoragyártó.'],
            ['brand_name' => 'Alesis',         'brand_description' => 'Elektromos dobok és stúdióeszközök gyártója.'],
            ['brand_name' => 'Millenium',      'brand_description' => 'Megfizethető dob- és ütőhangszerek.'],
            ['brand_name' => 'Stentor',        'brand_description' => 'Brit hegedűgyártó, zeneiskolai hangszerek specialistája.'],
            ['brand_name' => 'Gewa',           'brand_description' => 'Német vonós hangszergyártó.'],
            ['brand_name' => 'Primavera',      'brand_description' => 'Belépő szintű vonós hangszerek.'],
            ['brand_name' => 'Stagg',          'brand_description' => 'Belga hangszermárka.'],
            ['brand_name' => 'Hidersine',      'brand_description' => 'Brit vonós hangszermárka.'],
            ['brand_name' => 'Jupiter',        'brand_description' => 'Tajvani fúvóshangszer-gyártó.'],
            ['brand_name' => 'Selmer',         'brand_description' => 'Francia prémium szaxofongyártó.'],
            ['brand_name' => 'Trevor James',   'brand_description' => 'Brit fúvóshangszer-gyártó.'],
            ['brand_name' => 'Conn-Selmer',    'brand_description' => 'Amerikai fúvóshangszer-gyártó.'],
            ['brand_name' => 'Gear4music',     'brand_description' => 'Brit online hangszerkereskedő saját márkája.'],
            ['brand_name' => 'Buffet Crampon', 'brand_description' => 'Francia prémium fúvóshangszer-gyártó.'],
            ['brand_name' => 'Yanagisawa',     'brand_description' => 'Japán prémium szaxofongyártó.'],
            ['brand_name' => 'Squier',         'brand_description' => 'Fender leányvállalata, megfizethető modellek.'],
            ['brand_name' => 'Jackson',        'brand_description' => 'Amerikai gitármárka, rock és metal kedvence.'],
            ['brand_name' => 'Gibson',         'brand_description' => 'Legendás amerikai gitármárka, Les Paul és SG alkotója.'],
            ['brand_name' => 'PRS',            'brand_description' => 'Paul Reed Smith gitárok, kézzel készített prémium hangszerek.'],
            ['brand_name' => 'ESP',            'brand_description' => 'Japán gitármárka, rock és metal hangszerek specialistája.'],
            ['brand_name' => 'Schecter',       'brand_description' => 'Amerikai gitármárka, modern rock és metal modellekkel.'],
            ['brand_name' => 'Ismeretlen',     'brand_description' => 'Ismeretlen vagy vegyes gyártójú hangszerek.'],
        ];

        foreach ($brands as $brand) {
            InstrumentBrand::create($brand);
        }
    }
}
