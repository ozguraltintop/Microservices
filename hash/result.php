<?php 

	$servername = "";
	$username   = "";
	$password   = "";
	$dbname     = "";

	// Create connection
	$conn       = new mysqli($servername, $username, $password, $dbname);
	// Check connection

	$html =
    "
	<style>
		table {
			width:30%;
			height:100%;
			border-collapse:collapse;
			padding:5px;
		}
		table th {
			padding:5px;
			background: #f0f0f0;
		}
		table td {
			padding:5px;
			background: #ffffff;
			text-align: center;

		}
	</style>
    <p>Merhabalar </p>
    <p>*** Talebi Platformuna Hoşgeldiniz.</p>
    <p style='color:red'>Lütfen geri dönüş yapmayınız.</p>
	<p>Aşağıdaki bilgileri kullanarak giriş yapabilirsiniz.</p>

	<p>Bilginize</p><br><br>
    <b>#002</b><br><br>
    <table>
		<thead>
			<tr>
				<th>Kullanıcı Adı</th>
				<th>Şifre</th>
			</tr>
    ";
	
	if ($conn->connect_error) 
	{
		  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM '' where status=0";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
		    $mailNaibi  = $row["mail"];
		    $mailStat   = $row["status"];

		   	if($mailNaibi)
            {
            	echo $mailNaibi;
            	  	$ser     = '';
                    $user    = '';
                    $pass    = '';
                    $db      = '';

                    $connOd     = odbc_connect("DRIVER=SQL Server;SERVER=".$ser.";UID=".$user.";PWD=".$pass.";DATABASE=".$db.";Address=".$ser.",1433",";charset=UTF8;","");

                    $conEmail = $mailNaibi;
                    
                    $sqlSlc      = "SELECT * FROM '' where Email='$conEmail'"; 
                    $resultSlc   = odbc_exec($connOd,$sqlSlc) or die (odbc_errormsg());
                    $rowSlc      = odbc_exec($connOd,$sqlSlc);

                 echo "-";

                    if(!$rowSlc)
                    {
                       echo 'yok';
                    }
                    else
                    {

                          while(odbc_fetch_row($rowSlc))
                        {
                            	$passCreate = rand(100000, 900000); // Çıktı: 78

                                $addHTML = "
                                <tr>
                                    <td>".$mailNaibi."</td>
                                    <td>".$passCreate."</td>
                                </tr>
                                </thead>
                                </table>
                                <b>destek.yildizteknopark.com.tr</b>

                                ";
                                $html = $html . $addHTML;
                                mailgonder($html,$mailNaibi);

                                $passHash = password_hash($passCreate, PASSWORD_DEFAULT); 

                                $sqlIns = "INSERT INTO '' (name, email,password)
                                VALUES ('Tester','$mailNaibi','$passHash')";
                                $conn->query($sqlIns);
                                

                                $sqlUpd = "UPDATE '' SET status=1 WHERE mail='$conEmail'";
                                $conn->query($sqlUpd);
                                

                        }
                         

                    }

            }

		  
		 }
		  $sqlUpd2 = "UPDATE arge_users SET status=1 WHERE mail='$mailNaibi'";
          $conn->query($sqlUpd2);

	} 
	else 
	{
		echo "0 results";
	}
	$conn->close();


	function mailgonder($msg,$mailWho){
	    require "../inc/class.phpmailer.php"; // PHPMailer dosyamızı çağırıyoruz
	    $mail = new PHPMailer();
	    $mail->IsSMTP();
	      $mail->From     = ""; //Gönderen kısmında yer alacak e-mail adresi
	    $mail->Sender   = "info@devialt.com";
	    $mail->FromName = "Ticket | Destek Sistemi";
	    $mail->Host     = ""; //SMTP server adresi
	    $mail->SMTPAuth = true;
	    $mail->Username = "info@devialt.com"; //SMTP kullanıcı adı
	    $mail->Password = "*"; //SMTP şifre
	    $mail->SMTPSecure="";
	    $mail->Port = "587";
	    $mail->CharSet = "utf-8";
	    $mail->WordWrap = 50;
	    $mail->IsHTML(true); //Mailin HTML formatında hazırlanacağını bildiriyoruz.
	    $mail->Subject  = "Servis Mesaj";

	    $mail->Body = $msg;

	    $mail->AltBody = strip_tags($msg);
	    $mail->AddAddress($mailWho);
	    return ($mail->Send())?true:false;
	    $mail->ClearAddresses();
	    $mail->ClearAttachments();
	}
	

?>