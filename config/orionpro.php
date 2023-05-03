<?php

return [
    'enabled' => (bool) env('ORION_RFID_ENABLED', false),
    'OrionSoapURL' => env('ORION_RFID_SOAP_URL', 'http://127.0.0.1:8090/wsdl/IOrionPro'),
];
