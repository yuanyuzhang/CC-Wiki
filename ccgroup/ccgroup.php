<?php
require_once ( 'conf.php' );

if (!defined( 'MEDIAWIKI' )) {
        echo <<<EOT
To install my extension, put the folloeing line in LocalSettings.php:
require_once( "\$IP/extensions/ccgroup/ccgroup.php" );
EOT;
        exit( 1 );
}

$url = 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php';
//Interest
$wgExtensionCredits['specialpage']['Interest'] = array(
        'name' => 'Interest',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:Interest',
        'description' => 'This is CC Interest Specialpage',
        'descriptionmsg' => 'interest-desc',
        'version' => '0.0.0',
);
//Invite
$wgExtensionCredits['specialpage']['Invite'] = array(
        'name' => 'Invite',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:Invite',
        'description' => 'This is CC Invite Specialpage',
        'descriptionmsg' => 'invite-desc',
        'version' => '0.0.0',
);
//configure GB
$wgExtensionCredits['specialpage']['ConfigureGB'] = array(
        'name' => 'ConfigureGB',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:ConfigureGB',
        'description' => 'This is CC Configure Group buying Specialpage',
        'descriptionmsg' => 'cinfigureGB-desc',
        'version' => '0.0.0',
);

// AllCCPage
$wgExtensionCredits['specialpage']['AllCCPage'] = array(
        'name' => 'AllCCPage',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:AllCCPage',
        'description' => 'This is to list all cc pages',
        'descriptionmsg' => 'allccpages-desc',
        'version' => '0.0.0',
);
//All CC Template
$wgExtensionCredits['specialpage']['AllCCTemplate'] = array(
        'name' => 'AllCCTemplate',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:AllCCTemplate',
        'description' => 'This is to list all cc Templates',
        'descriptionmsg' => 'allcctemplates-desc',
        'version' => '0.0.0',
);

//configure Weibo
$wgExtensionCredits['specialpage']['ConfigureWeibo'] = array(
        'name' => 'ConfigureWeibo',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:ConfigureWeibo',
        'description' => 'This is CC Configure Weibo Specialpage',
        'descriptionmsg' => 'cinfigureWeibo-desc',
        'version' => '0.0.0',
);


//Participate
$wgExtensionCredits['specialpage']['Participate'] = array(
        'name' => 'Participate',
        'author' => 'Yuan Yuzhang',
        'url' => $url . '/special:Participate',
        'description' => 'This is CC Participate Specialpage',
        'descriptionmsg' => 'participate-desc',
        'version' => '0.0.0',
);

$dir = dirname(__FILE__) . '/';
$specialdir = $dir . 'special/';
//Interest

$dir = dirname(__FILE__) . '/';
$specialdir = $dir . 'special/';
//Interest

$dir = dirname(__FILE__) . '/';
$specialdir = $dir . 'special/';
//Interest
$wgAutoloadClasses['SpecialInterest'] = $specialdir . 'SpecialInterest.php';
$wgExtensionMessagesFiles['Interest'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['Interest'] =  'SpecialInterest';
$wgSpecialPageGroups['Interest'] = 'other';
//Invite
$wgAutoloadClasses['SpecialInvite'] = $specialdir . 'SpecialInvite.php';
$wgExtensionMessagesFiles['Invite'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['Invite'] =  'SpecialInvite';
$wgSpecialPageGroups['Invite'] = 'other';
//configure GB
$wgAutoloadClasses['SpecialConfigureGB'] = $specialdir . 'SpecialConfigureGB.php';
$wgExtensionMessagesFiles['ConfigureGB'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['ConfigureGB'] =  'SpecialConfigureGB';
$wgSpecialPageGroups['ConfigureGB'] = 'other';
// AllCCPage 
$wgAutoloadClasses['SpecialAllCCPage'] = $specialdir . 'SpecialAllCCPage.php';
$wgExtensionMessagesFiles['AllCCPage'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['AllCCPage'] =  'SpecialAllCCPage';
$wgSpecialPageGroups['AllCCPage'] = 'other';
// AllCCTemplate 
$wgAutoloadClasses['SpecialAllCCTemplate'] = $specialdir . 'SpecialAllCCTemplate.php';
$wgExtensionMessagesFiles['AllCCTemplate'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['AllCCTemplate'] =  'SpecialAllCCTemplate';
$wgSpecialPageGroups['AllCCTemplate'] = 'other';
//configure Weibo
$wgAutoloadClasses['SpecialConfigureWeibo'] = $specialdir . 'SpecialConfigureWeibo.php';
$wgExtensionMessagesFiles['ConfigureWeibo'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['ConfigureWeibo'] =  'SpecialConfigureWeibo';
$wgSpecialPageGroups['ConfigureWeibo'] = 'other';
//Participate
$wgAutoloadClasses['SpecialParticipate'] = $specialdir . 'SpecialParticipate.php';
$wgExtensionMessagesFiles['Participate'] = $dir . 'ccgroup.i18n.php';
$wgSpecialPages['Participate'] =  'SpecialParticipate';
$wgSpecialPageGroups['Participate'] = 'other';
?>
