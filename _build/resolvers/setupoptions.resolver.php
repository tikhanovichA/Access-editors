<?php
/**

 */
$success= false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $settings = array(
            'login_ed',
            'password_ed',
            'email_ed',
           
        );
//add user and attributes
  $user_ed =$object->xpdo->newObject('modUser', array('username'=>$options['login_ed']));
  $userProfile = $object->xpdo->newObject('modUserProfile');
  $userProfile->set('fullname',$options['login_ed']);
  $userProfile->set('email',$options['email_ed']);
  $successs = $user_ed->addOne($userProfile);
  $newp = $user_ed->generatePassword();
  $user_ed->set('password',$newp);
  $user_ed->changePassword($options['password_ed'],$newp);   
  $user_ed->save();
  $userProfile->save();
 
 //get id of user group              
 $member_id = $object->xpdo->getObject('modUserGroup',array('name'=>'Editors')); 
 $id_m = $member_id->get('id');


 //get id of user  
 $user_id = $object->xpdo->getObject('modUser',array('username'=>$options['login_ed']));

 $id_user=$user_id->get('id'); 
 
 //get id of user role 
 $role_ed_id = $object->xpdo->getObject('modUserGroupRole',array("name"=>"EditorRole"));
 $role_id = $role_ed_id->get('id'); 
 
 //add group member
 $member_ed = $object->xpdo->newObject('modUserGroupMember',array('user_group'=>$id_m,'member'=>$id_user,'role'=>$role_id,'rank'=>'0')) ;                
  $member_ed ->save();              
            
        

        $success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
    
    //delete user    
    //$user_ed = $object->xpdo->getObject("modUser",array('username'=>$options['login_ed']));
    //$user_ed->remove();
    
    //delete profile
    //$userProfile = $object->xpdo->getObject("modUserProfile",array('fullname'=>$options['login_ed']));
    //$userProfile->remove();
    
        $success= true;
        break;
}
return $success;