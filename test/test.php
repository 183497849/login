<?php
	public function verifyCode() {
			header("Content-Type:image/png");

			$img = imagecreate(50, 25);

			$back = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

			$red = imagecolorallocate($img, 255, 0, 0);


			$str = getRandom(4) ;
			$_SESSION['verifyCode'] = $str;
			imagestring($img, 5, 7, 5, $str, $red);

			imagepng($img);

			imagedestroy($img);
		}
		function getRandom($len){
			$base="123456789asdfgh";
			$max = strlen($base);
			mt_rand();
			$rand='';
			for($i=0;$i<=$len;$i++){
				$rand .=$base[mt_rando(0,$max-1)];
			}
			return $rand;
	} 