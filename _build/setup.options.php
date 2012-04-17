<?php
/**
 * Build the setup options form.
 * @package Access
 */
/* set some default values */

$values = array(
    'login_ed' => '',
    'password_ed' => '',
    'email_ed' =>'',
);

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
    break;
    case xPDOTransport::ACTION_UNINSTALL: break;
}
  
$output =  '<label for="access-login">Login for editor:</label>
<input type="text" name="login_ed" id="access-login" width="300" value="'.$values['login_ed'].'" />
<br /><br />';
$output .= '<label for="access-password">Password for editor:</label>
<input type="password" name="password_ed" id="access-password" width="300" value="'.$values['password_ed'].'" />
<br /><br />';
$output .= '<label for="access-email">Email for editor:</label>
<input type="text" name="email_ed" id="access-email" width="300" value="'.$values['email_ed'].'" />
<br /><br />';
$qwerty = $modx->getCollection('modTemplate');
$output .= '<label for="access-template">Template for articles</label>
<select name="edit_template" >';

foreach($qwerty as $qw){
        $output .= '<option value="'.$qw->get('id').'">'.$qw->get('templatename').'</option>';
    }

$output .= '</select>';

 
return $output;