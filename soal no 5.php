<div style="text-align:center">
	<?php
	$base = 9;
		for($i=10;$i>0;$i--){
			$gone = $base - $i;
		
			if($gone % 2 == 0){	
				for($front=0;$front<($gone/2);$front++){
					echo "0";
				}

				for($a=0;$a<$i;$a++){		
					echo "*";		
				}

				for($back=0;$back<($gone/2);$back++){
					echo "0";
				}

				echo "<br>";
			}
		}
	?>
</div>