<?php

    
function langg( $phrase ) {

    static $langg = array(

        'MESSAGE' => 'مرحبا بكم في اللغة العربية',
        'ADMIN' => 'الادمن'

    );
    return $langg [$phrase];
}



?>