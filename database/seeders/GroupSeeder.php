<?php

use App\Models\Group;

public function run(): void
{
    $groups = [
        'Lekki Group',
        'Victoria Island Group',
        'Alasia Group',
        'Ikoyi Group 1',
        'Ikoyi Group 2',
        'Ajiwe Group',
        'Obalende Group',
        'Mobil Road Group',
        'Chevron Group',
        'Onisho Group',
        'Ajah Group',
        'Kajola Group',
        'Lekki phase 1 Group',
        'Epe Group',
        'Lagos Island Group',
        'Youth church Group',
        'Owode Badore Group',
        'Trade Free Group',
        'Eputu Group',
        'Ogombo Group',
    ];

    foreach ($groups as $name) {
        Group::create(['name' => $name]);
    }
}
