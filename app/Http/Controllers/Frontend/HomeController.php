<?php


namespace App\Http\Controllers\Frontend;


use App\Facades\Garage;
use App\Http\Controllers\Controller;
use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use App\Models\TecDoc\ShortCut\ShortCut;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
//        $popularBrands = [
//            'ALFA ROMEO',
//            'AUDI',
//            'BMW',
//            'CHRYSLER',
//            'CITROËN',
//            'DAEWOO',
//            'DAF',
//            'DAIHATSU',
//            'FIAT',
//            'FORD',
//            'HONDA',
//            'HYUNDAI',
//            'ISUZU',
//            'JAGUAR',
//            'JEEP',
//            'KIA',
//            'LADA',
//            'MAZDA',
//            'MERCEDES-BENZ',
//            'MINI',
//            'MITSUBISHI',
//            'NISSAN',
//            'OPEL',
//            'PEUGEOT',
//            'PORSCHE',
//            'RENAULT',
//            'ROVER',
//            'SAAB',
//            'SEAT',
//            'SKODA',
//            'SMART',
//            'SUZUKI',
//            'TOYOTA',
//            'VOLVO',
//            'VW',
//        ];
//
//        $allBrands = [
//            'ABARTH',
//            'AC',
//            'ACURA',
//            'AIXAM',
//            'ALFA ROMEO',
//            'ALPINA',
//            'ALPINE',
//            'AMC',
//            'ARO',
//            'ARTEGA',
//            'ASIA MOTORS',
//            'ASTON MARTIN',
//            'AUDI',
//            'AUSTIN',
//            'AUSTIN-HEALEY',
//            'AUTO UNION',
//            'AUTOBIANCHI',
//            'BENTLEY',
//            'BERTONE',
//            'BIO AUTO',
//            'BITTER',
//            'BMW',
//            'BOGDAN',
//            'BOND',
//            'BORGWARD',
//            'BRISTOL',
//            'BUGATTI',
//            'BUICK',
//            'BYD',
//            'CADILLAC',
//            'CALLAWAY',
//            'CARBODIES',
//            'CATERHAM',
//            'CHANGAN',
//            'CHANGHE',
//            'CHECKER',
//            'CHERY',
//            'CHEVROLET',
//            'CHEVROLET (SGM)',
//            'CHRYSLER',
//            'CITROËN',
//            'CUPRA',
//            'DACIA',
//            'DAEWOO',
//            'DAF',
//            'DAIHATSU',
//            'DAIMLER',
//            'DALLAS',
//            'DATSUN',
//            'DE LOREAN',
//            'DE TOMASO',
//            'DODGE',
//            'DS',
//            'EMGRAND',
//            'FAW (TIANJIN)',
//            'FERRARI',
//            'FIAT',
//            'FISKER',
//            'FORD',
//            'FORD ASIA &amp; OCEANIA',
//            'FORD AUSTRALIA',
//            'FORD OTOSAN',
//            'FORD USA',
//            'FSO',
//            'GAZ',
//            'GEELY',
//            'GENESIS',
//            'GEO',
//            'GINETTA',
//            'GLAS',
//            'GLEAGLE',
//            'GMC',
//            'GREAT WALL',
//            'GROZ',
//            'HAFEI',
//            'HAVAL',
//            'HINDUSTAN',
//            'HOBBYCAR',
//            'HONDA',
//            'HONDA (GAC)',
//            'HUANGHAI',
//            'HUMMER',
//            'HYUNDAI',
//            'HYUNDAI (HUATAI)',
//            'INDIGO',
//            'INFINITI',
//            'INNOCENTI',
//            'IRAN KHODRO',
//            'IRMSCHER',
//            'ISDERA',
//            'ISUZU',
//            'IVECO',
//            'IZH',
//            'JAC',
//            'JAGUAR',
//            'JEEP',
//            'JENSEN',
//            'KIA',
//            'KTM',
//            'LADA',
//            'LAMBORGHINI',
//            'LANCIA',
//            'LAND ROVER',
//            'LANDWIND (JMC)',
//            'LEXUS',
//            'LIFAN',
//            'LIGIER',
//            'LINCOLN',
//            'LOTUS',
//            'LTI',
//            'LUAZ',
//            'MAHINDRA',
//            'MAPLE (SMA)',
//            'MARCOS',
//            'MASERATI',
//            'MAYBACH',
//            'MAZDA',
//            'MCLAREN',
//            'MEGA',
//            'MERCEDES-BENZ',
//            'MERCURY',
//            'METROCAB',
//            'MG',
//            'MG (SAIC)',
//            'MIDDLEBRIDGE',
//            'MINELLI',
//            'MINI',
//            'MITSUBISHI',
//            'MITSUOKA',
//            'MORGAN',
//            'MORRIS',
//            'MOSKVICH',
//            'NISSAN',
//            'NISSAN (DFAC)',
//            'NSU',
//            'OLDSMOBILE',
//            'OLTCIT',
//            'OPEL',
//            'OSCA',
//            'PANOZ',
//            'PANTHER',
//            'PEUGEOT',
//            'PIAGGIO',
//            'PININFARINA',
//            'PLYMOUTH',
//            'PONTIAC',
//            'PORSCHE',
//            'PREMIER',
//            'PROTON',
//            'PUCH',
//            'RANGER',
//            'RAVON',
//            'RAYTON FISSORE',
//            'RELIANT',
//            'RENAULT',
//            'RILEY',
//            'ROLLS-ROYCE',
//            'ROVER',
//            'RUF',
//            'SAAB',
//            'SAIPA',
//            'SAMSUNG',
//            'SANTANA',
//            'SATURN',
//            'SEAT',
//            'SHELBY',
//            'SIPANI',
//            'SKODA',
//            'SMART',
//            'SOUEAST',
//            'SPECTRE',
//            'SPYKER',
//            'SSANGYONG',
//            'STANDARD AUTOMOBILE',
//            'STEYR',
//            'STREETSCOOTER',
//            'SUBARU',
//            'SUZUKI',
//            'TALBOT',
//            'TATA',
//            'TAZZARI',
//            'TESLA',
//            'THINK',
//            'TOFAS',
//            'TOYOTA',
//            'TOYOTA (FAW)',
//            'TOYOTA (GAC)',
//            'TRABANT',
//            'TRIUMPH',
//            'TVR',
//            'UAZ',
//            'UMM',
//            'UZ-DAEWOO',
//            'VAUXHALL',
//            'VECTOR',
//            'VOLVO',
//            'VW',
//            'WARTBURG',
//            'WESTFIELD',
//            'WIESMANN',
//            'WOLSELEY',
//            'YUGO',
//            'YULON',
//            'ZASTAVA',
//            'ZAZ',
//            'ZHONGHUA (BRILLIANCE)',
//            'ZHONGXING (ZX AUTO)',
//        ];
//
//        //        Garage::clearVehicles();
//
        $manufacturers = Manufacturer::onlyIsFavorite()->orderBy('manuName')->get();
//        $categories = ShortCut::orderBy('shortCutName')->get();
//        $assemblyGroups = AssemblyGroup::orderBy('assemblyGroupName')->get()->toArray();
//
//        $assemblyGroupsTree = $this->generateAssemblyGroupsTree($assemblyGroups);

        return view('frontend.home.index', [
            'manufacturers' => $manufacturers,
//            'categories' => $categories,
//            'assemblyGroups' => $assemblyGroupsTree,
//            'brands' => $allBrands,
//            'garageVehicles' => Garage::getVehicles(),
        ]);
    }

    /**
     * @param array $assemblyGroups
     * @param integer $parentId
     * @return array
     */
    private function generateAssemblyGroupsTree(&$assemblyGroups, $parentId = null)
    {
        $assemblyGroupsTree = [];

        foreach ($assemblyGroups as $assemblyGroup) {
            if ($assemblyGroup['parentNodeId'] == $parentId) {
                $children = $this->generateAssemblyGroupsTree($assemblyGroups, $assemblyGroup['assemblyGroupNodeId']);

                if ($children) {
                    $assemblyGroup['children'] = $children;
                }

                $assemblyGroupsTree[$assemblyGroup['assemblyGroupNodeId']] = $assemblyGroup;
                unset($assemblyGroups[$assemblyGroup['assemblyGroupNodeId']]);
            }
        }

        return $assemblyGroupsTree;
    }
}
