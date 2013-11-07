participle
==========

php简单分词类库
不需要安装扩展，自带字典，使用方法简单,请参考index.php文件示例：
<code>
header("Content-Type:text/html; charset=utf-8");
define('APP_ROOT', str_replace('\\', '/', dirname(__FILE__)));

$con = '最高价值1140元的美丽田园SPA润白护理套餐，女士专享。源自欧洲，护肤名门，美丽就在你身边，3市31店通用。优惠券限量限时发放，优惠后套餐价568元。

以下项目三选一：
1、SPM修颜洁肤精华护理+骨胶原眼膜+背部舒缓按摩+保湿滋润手膜
2、金妆胶原润白护理+骨胶原眼膜+背部舒缓按摩+保湿滋润手膜
3、SPM负压按摩任意部位1次+30分钟芳香精油局部按摩+骨胶原眼膜+背部舒缓按摩+保湿滋润手膜

流程：美容师分析肌肤状况→根据客人需求选择团购详情中的护理3选1项目→背部舒缓按摩→洁面液清洁皮肤→调整多余角质→芦荟洁后水再次清洁→水分精华液精华补水→骨胶原面膜→眼霜、面霜、防晒（补水防护）， 约100分钟';

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
</code>