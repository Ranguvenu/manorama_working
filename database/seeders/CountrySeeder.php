<?php

namespace Database\Seeders;

use App\Models\MasterData\Country;
use App\Models\MasterData\State;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesAndStates = [
            'country' => [
                'name' => 'India',
                'code' => 'IN',
                'states' => [
                    'AN' => [
                        'name' => 'Andaman and Nicobar Islands',
                        'code' => 'AN',
                    ],
                    'AD' => [
                        'name' => 'Andhra Pradesh',
                        'code' => 'AD',
                    ],
                    'AR' => [
                        'name' => 'Arunachal Pradesh',
                        'code' => 'AR',
                    ],
                    'AS' => [
                        'name' => 'Assam',
                        'code' => 'AS',
                    ],
                    'BR' => [
                        'name' => 'Bihar',
                        'code' => 'BR',
                    ],
                    'CN' => [
                        'name' => 'Chandigarh',
                        'code' => 'CN',
                    ],
                    'CG' => [
                        'name' => 'Chattisgarh',
                        'code' => 'CG',
                    ],
                    'DNHDD' => [
                        'name' => 'Dadra & Nagar Haveli and Daman & Diu',
                        'code' => 'DNHDD',
                    ],
                    'DL' => [
                        'name' => 'Delhi',
                        'code' => 'DL',
                    ],
                    'GA' => [
                        'name' => 'Goa',
                        'code' => 'GA',
                    ],
                    'GJ' => [
                        'name' => 'Gujarat',
                        'code' => 'GJ',
                    ],
                    'HR' => [
                        'name' => 'Haryana',
                        'code' => 'HR',
                    ],
                    'HP' => [
                        'name' => 'Himachal Pradesh',
                        'code' => 'HP',
                    ],
                    'JK' => [
                        'name' => 'Jammu and Kashmir',
                        'code' => 'JK',
                    ],
                    'JH' => [
                        'name' => 'Jharkhand',
                        'code' => 'JH',
                    ],
                    'KA' => [
                        'name' => 'Karnataka',
                        'code' => 'KA',
                    ],
                    'KL' => [
                        'name' => 'Kerala',
                        'code' => 'KL',
                    ],
                    'LA' => [
                        'name' => 'Ladakh',
                        'code' => 'LA',
                    ],
                    'LD' => [
                        'name' => 'Lakshadweep Islands',
                        'code' => 'LD',
                    ],
                    'MP' => [
                        'name' => 'Madhya Pradesh',
                        'code' => 'MP',
                    ],
                    'MH' => [
                        'name' => 'Maharashtra',
                        'code' => 'MH',
                    ],
                    'MN' => [
                        'name' => 'Manipur',
                        'code' => 'MN',
                    ],
                    'ML' => [
                        'name' => 'Meghalaya',
                        'code' => 'ML',
                    ],
                    'MZ' => [
                        'name' => 'Mizoram',
                        'code' => 'MZ',
                    ],
                    'NL' => [
                        'name' => 'Nagaland',
                        'code' => 'NL',
                    ],
                    'OD' => [
                        'name' => 'Odisha',
                        'code' => 'OD',
                    ],
                    'PY' => [
                        'name' => 'Pondicherry',
                        'code' => 'PY',
                    ],
                    'PB' => [
                        'name' => 'Punjab',
                        'code' => 'PB',
                    ],
                    'RJ' => [
                        'name' => 'Rajasthan',
                        'code' => 'RJ',
                    ],
                    'SK' => [
                        'name' => 'Sikkim',
                        'code' => 'SK',
                    ],
                    'TN' => [
                        'name' => 'Tamil Nadu',
                        'code' => 'TN',
                    ],
                    'TS' => [
                        'name' => 'Telangana',
                        'code' => 'TS',
                    ],
                    'TR' => [
                        'name' => 'Tripura',
                        'code' => 'TR',
                    ],
                    'UP' => [
                        'name' => 'Uttar Pradesh',
                        'code' => 'UP',
                    ],
                    'UK' => [
                        'name' => 'Uttarakhand',
                        'code' => 'UK',
                    ],
                    'WB' => [
                        'name' => 'West Bengal',
                        'code' => 'WB',
                    ],
                ],
            ],
        ];

        foreach ($countriesAndStates as $countryData) {
            $country = Country::updateOrCreate([
                'name' => $countryData['name'],
                'code' => $countryData['code'],
            ]);

            foreach ($countryData['states'] as $stateCode => $stateName) {
                $state = State::updateOrCreate([
                    'country_id' => $country->id,
                    'name' => $stateName['name'],
                    'code' => $stateCode,
                ]);
            }
        }
    }
}
