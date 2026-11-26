<?php

return [
    'whatsapp' => env('DAPURRASA_WHATSAPP', '6283156458274'),
    'alamat'   => env('DAPURRASA_ALAMAT', 'Jl. Pencari Cinta No.08, Sukasenang, Bandar Neira'),
    'email'    => env('DAPURRASA_EMAIL', 'dapurrasa01@gmail.com'),
    'gmaps'    => env('DAPURRASA_GMAPS', 'https://www.google.com/maps/search/?api=1&query=' . urlencode(env('DAPURRASA_ALAMAT', 'Jl. Pencari Cinta No.08, Sukasenang, Bandar Neira'))),
];
