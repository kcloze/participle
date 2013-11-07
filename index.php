<?php
header("Content-Type:text/html; charset=utf-8");
define('APP_ROOT', str_replace('\\', '/', dirname(__FILE__)));

$con = '价值999元粤海喜来登酒店炫逸SPA中心精品SPA套餐优惠券！温柔指尖流淌，宁静心中安放！万种风情，歆享曼妙时光！
服务流程/时长：背部按摩，约15分钟→身体磨砂，约30分钟→蒸汽浴，约30分钟粤海喜来登酒店炫逸水疗中心拥有私人护理套房十间，提供一系列的护理项目，为您营造时光永驻的安逸之感，远离生活的压力。炫逸水疗中心的护理更可让您尽情体验伊人舒适的感官享受，抚慰全身，焕发活力。';

function get_tags_arr($title)
    {
		require(APP_ROOT.'/pscws4.class.php');
        $pscws = new PSCWS4();
		$pscws->set_dict(APP_ROOT.'/scws/dict.utf8.xdb');
		$pscws->set_rule(APP_ROOT.'/scws/rules.utf8.ini');
		$pscws->set_ignore(true);
		$pscws->send_text($title);
		$words = $pscws->get_tops(5);
		$tags = array();
		foreach ($words as $val) {
		    $tags[] = $val['word'];
		}
		$pscws->close();
		return $tags;
}

print_r(get_tags_arr($con));

function get_keywords_str($content){
	require(APP_ROOT.'/phpanalysis.class.php');
	PhpAnalysis::$loadInit = false;
	$pa = new PhpAnalysis('utf-8', 'utf-8', false);
	$pa->LoadDict();
	$pa->SetSource($content);
	$pa->StartAnalysis( false );
	$tags = $pa->GetFinallyResult();
	return $tags;
}

print(get_keywords_str($con));