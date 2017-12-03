 <?php

require("./phpMQTT/phpMQTT.php");

$server = "m14.cloudmqtt.com";
$port = 19422; 
$username = "ielzboam";
$password = "OBOVMmpfc_yL";
$client_id = "mqtt-subscibe";




$mqtt = new Bluerhinos\phpMQTT($server,$port,$client_id);

if(!$mqtt->connect(true, NULL, $username,$password)) {
	exit(1);
}

$topics['Lampotila'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);
while($mqtt->proc()){
	}

$mqtt->close();
function procmsg($topic, $msg){
	echo json_encode($msg);
	exit;
}

        // Create connection

  	// $mysqli = new mysqli($servername, $username, $password, $dbname);




        // Check connection

    	// if ($mysqli->connect_error) {

               // die("EI YHDISTA");

               // print "ei yhdistä";

                                                         


 //                       $data_points = ;
                 //       $result = mysqli_query($mysqli,"SELECT * FROM Mittaukset order by id ");

                   //     while($row = mysqli_fetch_array($result))
                     //   {        
                       //     $point = array($row['aika'],$row['kosteus'],$row['latitudeDegree'],$row['latitude'],$row['longitudedegree'],$row['longitude']);
                         //   array_push($data_points, $point);        
                       // }



                        //output the return value of json encode using the echo function.

 
   //                             echo json_encode($data_points, JSON_NUMERIC_CHECK);

?>
