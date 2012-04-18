
<?php
/**
* Resolves setup-options settings for Administator groups.
*
* 
* 
*/

$success= false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
$name_tab = array('articles-tab-template','articles-tab-advanced-settings','articles-tab-comments');    

 //add group users 
 $group_ed =  $object->xpdo->newObject('modUserGroup', array(
                                    "name"=>"Editors",
                                    "description"=>"Группа редакторов",
                                    "parent"=>"0",
                                    "rank"=>"0",
                                    "dashboard"=>"1"
                                    ));
 $group_ed->save();
 
 //add role

 $role_ed = $object->xpdo->newObject('modUserGroupRole',array(
                                    "name"=>"EditorRole",
                                    "description"=>"",
                                    "authority"=>"666"));
 $role_ed->save();
 
 //add template access
 $template_access = $object->xpdo->newObject("modAccessPolicy",array(
                                            "name"=>"Editors",
                                            "description"=>"Context editors policy with limited.",
                                            "parent"=>"0",
                                            "template"=>"1",
                                            "data"=>'{"about":false,"access_permissions":false,"actions":false,"change_password":false,"change_profile":true,"charsets":false,"class_map":true,"components":false,"content_types":false,"countries":true,"create":false,"credits":false,"customize_forms":false,"dashboards":false,"database":false,"database_truncate":false,"delete_category":false,"delete_chunk":false,"delete_context":false,"delete_document":true,"delete_eventlog":false,"delete_plugin":false,"delete_propertyset":false,"delete_role":false,"delete_snippet":false,"delete_template":false,"delete_tv":false,"delete_user":false,"directory_chmod":false,"directory_create":false,"directory_list":false,"directory_remove":false,"directory_update":false,"edit_category":false,"edit_chunk":false,"edit_context":false,"edit_document":true,"edit_locked":false,"edit_plugin":false,"edit_propertyset":false,"edit_role":false,"edit_snippet":false,"edit_template":false,"edit_tv":false,"edit_user":false,"element_tree":false,"empty_cache":false,"error_log_erase":false,"error_log_view":false,"export_static":false,"file_create":false,"file_list":false,"file_manager":false,"file_remove":false,"file_tree":false,"file_update":false,"file_upload":false,"file_view":false,"flush_sessions":false,"frames":true,"help":true,"home":true,"import_static":false,"languages":false,"lexicons":false,"list":true,"load":true,"logout":true,"logs":false,"menus":false,"menu_reports":true,"menu_security":false,"menu_site":true,"menu_support":true,"menu_system":false,"menu_tools":true,"menu_user":true,"messages":false,"namespaces":false,"new_category":false,"new_chunk":false,"new_context":false,"new_document":true,"new_document_in_root":false,"new_plugin":false,"new_propertyset":false,"new_role":false,"new_snippet":false,"new_static_resource":false,"new_symlink":false,"new_template":false,"new_tv":false,"new_user":false,"new_weblink":false,"packages":false,"policy_delete":false,"policy_edit":false,"policy_new":false,"policy_save":false,"policy_template_delete":false,"policy_template_edit":false,"policy_template_new":false,"policy_template_save":false,"policy_template_view":false,"policy_view":false,"property_sets":false,"providers":false,"publish_document":false,"purge_deleted":false,"remove":false,"remove_locks":false,"resourcegroup_delete":false,"resourcegroup_edit":false,"resourcegroup_new":false,"resourcegroup_resource_edit":false,"resourcegroup_resource_list":false,"resourcegroup_save":false,"resourcegroup_view":false,"resource_duplicate":true,"resource_quick_create":false,"resource_quick_update":false,"resource_tree":true,"save":false,"save_category":false,"save_chunk":false,"save_context":false,"save_document":true,"save_plugin":false,"save_propertyset":false,"save_role":false,"save_snippet":false,"save_template":false,"save_tv":false,"save_user":false,"search":false,"settings":false,"sources":false,"source_delete":false,"source_edit":false,"source_save":false,"source_view":true,"steal_locks":false,"tree_show_element_ids":false,"tree_show_resource_ids":true,"undelete_document":false,"unlock_element_properties":false,"unpublish_document":false,"usergroup_delete":false,"usergroup_edit":false,"usergroup_new":false,"usergroup_save":false,"usergroup_user_edit":false,"usergroup_user_list":false,"usergroup_view":false,"view":true,"view_category":false,"view_chunk":false,"view_context":false,"view_document":true,"view_element":false,"view_eventlog":false,"view_offline":false,"view_plugin":false,"view_propertyset":false,"view_role":false,"view_snippet":false,"view_sysinfo":false,"view_template":false,"view_tv":false,"view_unpublished":false,"view_user":false,"workspaces":false}'
                                            ));

 $template_access->save(); 
 
 //add fc edit profile
 $fc_profile = $object->xpdo->newObject('modFormCustomizationProfile',array(
                                        "name"=>"Editor",
                                        "description"=>"Editor profile",
                                        "active"=>"1",
                                        "rank"=>"0"
                                        ));
 $fc_profile->save();
 

 
//add fc setc
$fc_setc = $object->xpdo->newObject('modFormCustomizationSet',array(
                                    "profile"=>$fc_profile->get('id'),
                                    "action"=>"55",
                                    "active"=>"1",
                                    "template"=>$options['edit_template'],
                                    "constraint_class"=>"modResource"
                                    ));
$fc_setc->save();
 
$fc_setc2 = $object->xpdo->newObject('modFormCustomizationSet',array(
                                        "profile"=>$fc_profile->get('id'),
                                        "action"=>"30",
                                        "active"=>"1",
                                        "template"=>$options['edit_template'],
                                        "constraint_class"=>"modResource"));
$fc_setc2->save();
 
 
foreach($name_tab as $tab){

    $tab_articles = $object->xpdo->newObject('modActionField', array(
                                    "action"=>"30",
                                    "name"=>$tab,
                                    "type"=>"tab",
                                    "form"=>"modx-panel-resource",
                                    "rank"=>"4"));
    $tab_articles -> save(); 
    $tab_articles1 = $object->xpdo->newObject('modActionField', array(
                                    "action"=>"55",
                                    "name"=>$tab,
                                    "type"=>"tab",
                                    "form"=>"modx-panel-resource",
                                    "rank"=>"4"
                                    ));
    $tab_articles1 -> save();
    
    $actiondom = $object->xpdo->newObject('modActionDom',array(
                                        "set"=>$fc_setc->get('id'),
                                        "action"=>"55",
                                        "name"=>$tab,
                                        "container"=>"modx-resource-tabs",
                                        "rule"=>"tabVisible",
                                        "value"=>"0",
                                        "constraint_class"=>"modResource",
                                        "active"=>"1",
                                        "for_parent"=>"1",
                                        "rank"=>"2")); 
    $actiondom -> save();
    
    $actiondom2 = $object->xpdo->newObject('modActionDom',array(
                                        "set"=>$fc_setc2->get('id'),
                                        "action"=>"30",
                                        "name"=>$tab,
                                        "container"=>"modx-resource-tabs",
                                        "rule"=>"tabVisible",
                                        "value"=>"0",
                                        "constraint_class"=>"modResource",
                                        "active"=>"1",
                                        "for_parent"=>"0",
                                        "rank"=>"2")); 
    $actiondom2 -> save();
    
    }
 
//get context
 $contexts = $object->xpdo->getCollection('modContext');

//add access context for editor
foreach($contexts as $context){
    $access_context = $object->xpdo->newObject('modAccessContext',array(
                                                "target"=>$context->get('key'),
                                                "principal_class"=>"modUserGroup",
                                                "principal"=>$group_ed->get('id'),
                                                "authority"=>$role_ed->get('authority'),
                                                "policy"=>$template_access->get('id'),
                                                
                                                ));
    $access_context->save();
    
}

//add fc usergroups
   $query = 'INSERT INTO  modx_fc_profiles_usergroups (usergroup,profile) VALUES ('.$group_ed->get('id').','.$fc_profiles->get('id').')';
   $fc_usergroup = $object->xpdo->query($query);

//add User
  $user_ed =$object->xpdo->newObject('modUser', array('username'=>$options['login_ed']));
  
  $userProfile = $object->xpdo->newObject('modUserProfile');
  $userProfile->set('fullname',$options['login_ed']);
  $userProfile->set('email',$options['email_ed']);
  $successs = $user_ed->addOne($userProfile);  
  $new_password = $user_ed->generatePassword();
  $user_ed->set('password',$new_password);
  $user_ed->changePassword($options['password_ed'],$new_password);   
  $user_ed->save();
  $userProfile->save();
  $settings= $object->xpdo->newObject('modSystemSetting');
  $settings->fromArray(array(
                    'key' => 'access.login',
                    'value' => $options['login_ed'],
                    'xtype' => 'textfield',
                    'namespace' => 'access',
                    'area' => 'login',
                    ),'',true,true);        
$settings->save();                   
  //add group member
  $member_ed = $object->xpdo->newObject('modUserGroupMember',array('user_group'=>$group_ed->get('id'),'member'=>$user_ed->get('id'),'role'=>$role_ed->get('id'),'rank'=>'0')) ;                
  $member_ed ->save();  
        $success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $name_tab = array('articles-tab-template','articles-tab-advanced-settings','articles-tab-comments');  
      
        
        //delete articles tabs
        foreach($name_tab as $tab){
          $tab_articles = $object->xpdo->getObject('modActionField', array("name"=>$tab,"action"=>"30"));
          $tab_articles ->remove();
          $tab_articles1 = $object->xpdo->getObject('modActionField', array("name"=>$tab,"action"=>"55"));
          $tab_articles1 ->remove();
          //delete actiondom
          $actiondom = $object->xpdo->getCollection('modActionDom',array("name"=>$tab));
          foreach ($actiondom as $actiondom2){
            $actiondom2->remove();
          }
          
        }
    
        //delete group
        $group_ed =  $object->xpdo->getObject('modUserGroup', array("name"=>"Editors"));
        $group_ed->remove();
               
        //delete role
        $role_ed = $object->xpdo->getObject('modUserGroupRole',array("name"=>"EditorRole"));
        $role_ed->remove();
    
        //delete policy
        $template_access = $object->xpdo->getObject("modAccessPolicy",array("name"=>"Editors"));
        $template_access->remove();
        
        //delete fc profiles
        $fc_profiles = $object->xpdo->getObject('modFormCustomizationProfile',array("name"=>"Editor"));
        $fc_profiles_id = $fc_profiles->get('id');
        $fc_profiles->remove();
        
        //delete setc
        $fc_setc = $object->xpdo->getCollection('modFormCustomizationSet',array("profile"=>$fc_profiles_id));
        foreach($fc_setc as $fc){
            $fc->remove();
            
       }
        //delete user and settings
        $settings = $object->xpdo->getObject('modSystemSetting',array("key"=>"access.login"));
        $setting_login =  $settings->get('value');
        $user_ed = $object->xpdo->getObject('modUser', array('username'=>$setting_login));
        $user_ed->remove();        
        $settings->remove();
        
        
        $success= true;
        break;
}
return $success;

