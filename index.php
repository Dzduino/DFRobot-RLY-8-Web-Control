<!--
Date         : 	22/08/2016
Author       : 	A Benkorich (Dzduino)
website      : 	www.dzduino.com
Description  : 	Control DFR RLY-8 ViaWebPage (JSON)
Refernces    : 	-> www.stackoverflow.com/questions/14081124/
				-> www.php.net/manual/en/function.fsockopen.php	
				
IMPORTANT : A Local web server is need since we are using PHP, XAMPP or USBWebserver (Portable) are recommanded
-->
<html>
<head>
	<title> RLY_8 Web Control - Dzduino.com </title>
	<style>
		#cmd { width: 80%; padding:5px}
		#submit { width: 18%; border-radius: 1px; height: 30px; border: 1px solid blue;}
		#container { width: 70%; margin: 10% auto; font-family: monospace; }
		#top {padding: 10px; border: Solid 1px blue; border-radius: 10px; }
	</style>
</head>
<body>
	<div id="container">
		<div id="top">
			<span style="text-align: center; "><h2> DFR RLY-8 Relay Web Control Tutorial </h2></span>
			<div id="">
				<!-- form to submit the JSON command -->
				<form name="cmd_form" method="post" action="" >
				<span ><h4> Type the commande as per dfrobot JSON Protocol [<a target="_blank" href="https://github.com/nxcosa/RLY-8-Relay-Controller/raw/master/RELY-8-POE-EN.pdf">View</a>]: </h4></span >
					<!-- Commnad input -->
					<input id="cmd" name ="cmd" type="text"  required="" value='{"relay1":"on", "relay2":"on	", "relay3":"on"}'>
					<!-- Submit button-->
					<input id="submit" name="subm" type="submit" value="Send to RLY-8">
					<span ><h4>Controller Feedback:</h4></span >
				</form>
			</div>
			<!-- all the communications with the RLY-8 controller happens hier -->
			<?php
				$addr = "192.168.1.10";   // RLY-8 Default Adress 
				$port = 2000;			  // RLY-8 Default port 
				$timeout = 30;			  // Connection Time out in Sec
				
				if (isset($_POST["cmd"])){  // check if a submit was done, otherwise the communicatino will start after page loading
					$cmd = $_POST["cmd"] ;  // Capture the input Command
					$fp = fsockopen ($addr, $port, $errno, $errstr, $timeout ); // initiate a socket connection 
					if (!$fp) {
						echo "($errno) $errstr\n";  // return the error if no connection was established
					} else {
						fwrite ($fp, $cmd); 		// Send the command to the connected device
						echo fread($fp, 128);		// Echo the return string from the device
						fclose ($fp);				// close the connection
					}
				}
			?>
			<!-- Done for the communication with the controller -->
		</div>
		<!-- The Credit for corse -->
		<span style="text-align: center; color: black"><h4> Dzduino Credited - 2016</br>www.dzduino.com </h4></span>
	</div>
</body>
</html>
