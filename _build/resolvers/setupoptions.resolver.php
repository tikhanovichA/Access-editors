<?php
/**

 */
$success= false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

             
            
        

        $success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:

    
        $success= true;
        break;
}
return $success;