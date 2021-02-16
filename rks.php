<!DOCTYPE HTML>
<html>
	<head>
		<title>Phigros rks计算器</title>
		<meta charset="UTF-8">
		<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
		<style>
			select{height:500px;width:200px;}
		</style>
		<script>
			function addbox(){
				$("#form").append("<input type='text' name='input[]'></input><br/>"); 
			}
			function resetbox(){
				$("#form").children().remove();
			}
		</script>
	</head>
	<body>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
			<text>请输入谱名及ACC(例:Reimei$IN$100.00):</text><br/><br/>
			<button type="button" onclick="addbox()">添加</button>
			<button type="button" onclick="resetbox()">重置</button>
			<button type="submit">提交</button><br/>
			<input type="text" name="input[]"></input><br/>
			<div id="form"></div>
		</form>
		<?php
			if(array_key_exists('input',$_GET)){
				if($_GET['input'][0]==''){
					echo '<p>宁提交了个寂寞</p>';
					exit;
				}
				$rks_sum = 0;
				for($i=0; $i<20; $i++){
					if($i>=count($_GET['input'])){
						break;
					}
					$rks_sum = $rks_sum + output(explode("$",$_GET['input'][$i]));
				}
				$rks_all = $rks_sum / 20;
				echo '<p>rks:'.$rks_all.'</p>'.PHP_EOL;
			}
			function output($decode){
				$rksmap = array(
					//过去的章节
					array("Glaciaxion",2.7,5.4,11.2),
					array("Eradication Catastrophe",3.5,7.5,12.1),
					array("Credits",4.4,10.4,13.7),
					array("Dlyrotz",6.5,11.7,14.6),
					array("Engine x Start!! (melody mix)",4.7,10.5,13.4),
					array("光",4.9,8.4,13.6),
					array("Winter↑cube↓",6.7,11.6,13.4),
					array("混乱-Confusion",5.3,11.4,13.9),
					array("Cipher : /2&//<|0",6.8,10.8,14.9),
					array("FULi AUTO SHOOTER",4.1,11.3,15.3),
					array("HumaN",5.6,8.8,13.2),
					array("[PRAW]",4.4,11.8,14.6),
					array("Cereris",6.9,11.2,14.8),
					array("Pixel Rebelz",5.8,11.9,14.3),
					array("Non-Melodic Ragez",5.8,10.5,15.8),
					//第四章
					array("Sultan Rage",3.9,8.7,12.2),
					array("Class Memories",4.5,8.9,12.8),
					array("-SURREALISM-",4.6,7.8,13.4),
					array("Bonus Time",4.7,9.3,14.2),
					array("ENERGY SYNERGY MATRIX",5.9,10.7,14.8),
					//第五章
					array("NYA!!!",1.8,8.6,12.9),
					array("JunXion Between Life And Death(VIP Mix)",3.2,8.7,13.3),
					array("cryout",4.3,9.9,13.7),
					array("Reimei",6.8,12.7,15.3),
					array("尊師 ～The Guru～",3.6,9.4,15.2),
					array("Spasmodic",7.9,12.6,15.4),
					array("Leave All Behind",2.5,6.4,12.7),
					//第六章
					array("Colorful Days♪",4.6,7.1,12.7),
					array("micro.wav",6.2,10.7,14.5),
					array("重生",5.8,9.3,14.6),
					array("NO ONE YES MAN",5.5,11.8,15.1),
					array("望影の方舟Six",6.3,12.9,15.9),
					array("Igallta",7.7,12.7,15.8,16.7),
					//忘忧宫
					array("Ποσειδών",4.7,8.4,12.8),
					array("WATER",4.5,9.4,13.6),
					array("Miracle Forest (VIP Mix)",2.6,9.7,13.9),
					array("MOBILYS",4.8,9.7,14.4),
					array("Lyrith -迷宮リリス-",5.2,11.6,15.7),
					//闫东炜精选集
					array("Aphasia",4.2,8.8,13.1),
					array("开心病",5.5,9.3,13.8),
					array("華灯爱",5.5,9.3,13.8),
					//Rising Sun Traxx精选集
					array("Another Me",1.7,5.6,13.2),
					array("mechanted",2.7,11.3,14.7),
					array("life flashes before weeb eyes",6.7,11.9,14.8),
					array("Break Through The Barrier",5.9,10.8,14.9),
					array("Chronostasis",6.8,11.6,15.9),
					//HyuN精选集
					array("Infinity Heaven",3.3,8.4,13.6),
					array("Disorder",5.4,9.8,14.7),
					array("CROSS†SOUL",7.7,12.8,15.9),
					//GOOD精选集
					array("GOODTEK",5.8,10.8,14.2),
					array("GOODBOUNCE",5.7,11.6,14.4),
					array("GOODWORLD",3.2,11.4,14.5),
					array("GOODRAGE",4.6,7.8,15.8),
					//单曲
					array("dB doll",1.6,3.6,7.2),
					array("もぺもぺ",3.4,8.5,11.1,14.3),
					array("Next Time",4.8,9.2,12.6),
					array("Dash",2.5,5.7,11.5),
					array("Rubbish Sorting",3.3,9.4,12.8),
					array("云女孩",2.8,9.9,12.8),
					array("Sparkle New Life",4.2,9.2,12.9),
					array("萤火虫の怨",4.3,10.6,13.4),
					array("Dead Soul",4.3,11.7,13.4),
					array("Snow Desert",5.1,9.6,13.6),
					array("Electron",3.7,10.4,13.6),
					array("万吨匿名信",5.7,9.7,13.6),
					array("Äventyr",2.3,9.4,13.7),
					array("风屿",5.9,10.3,13.7),
					array("Get Back",6.6,11.4,13.8),
					array("Orthodox",4.7,10.6,14.2),
					array("End Me",5.8,7.5,14.3),
					array("狂喜蘭舞",6.8,10.8,14.4),
					array("Parallel Retrogression(Game Ver.)",6.8,10.7,14.4),
					array("The Mountain Eater",4.3,9.1,14.4),
					array("Find_Me",5.7,10.5,14.4),
					array("Drop It",3.8,9.6,14.4),
					array("MARENOL",1.9,10.2,14.5),
					array("Magenta Potion",6.3,11.3,14.5),
					array("Hardcore Kwaya",4.3,9.2,14.6),
					array("Cervelle Connexion",4.8,11.3,14.5),
					array("Träne",1.5,6.7,14.5),
					array("Speed Up!",4.3,10.3,14.6),
					array("modulus",3.7,10.1,15.4),
					array("Khronostasis Katharsis",5.2,10.8,14.6),
					array("Starduster",5.6,11.4,14.8),
					array("Burn",4.2,10.6,14.8),
					array("Doppelganger",4.8,9.4,14.8),
					array("Sein",4.6,9.2,14.9),
					array("雪降り、メリクリ",5.6,9.3,15.3),
					array("Aleph-0",4.5,12.2,15.5),
					array("SIGMA",4.8,11.5,15.6),
					array("Palescreen",5.6,11.8,15.5),
					array("RIPPER",7.8,12.4,15.7),
				);
				$song=$decode[0];
				switch($decode[1]){
					case "EZ": $diff=1; break;
					case "HD": $diff=2; break;
					case "IN": $diff=3; break;
					case "AT": $diff=4; break;
					default: 
						echo "宁输入的难度有问题";
						exit;
				}
				$acc=(double)$decode[2];
				if($acc>=70){
					foreach($rksmap as $value){
						if($value[0]==$song){
							if($acc==100){
								$diff=(double)$value[$diff];
								$rks=$diff;
							}else{
								$diff=(double)$value[$diff];
								$rks=pow(($acc-55)/45,2)*$diff;
							}
						}
					}
				}else{
					$rks=0;
				}
				return $rks;
			}
		?>
	</body>
</html>