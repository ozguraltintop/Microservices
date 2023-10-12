<?php 

$socket  = stream_socket_client('tcp://192.168.1.1');
//$socket2 = stream_socket_client('udp://192.168.10.219:9780');
    if ($socket) 
    {
        $sent = stream_socket_sendto($socket, 'message');
        if ($sent > 0) 
        {
            $server_response = fread($socket, 9780);
			echo '192.168.1.1 bağlantı başarılı : Sonuç :';
            echo $server_response;
            echo $sent;
			echo "<hr>";
			
			echo "<hr>";
			
			
			
		
		//son
        }
    }
    else
    {
        echo 'Unable to connect to server';
    }

	if (0) 
    {
        $sent2 = stream_socket_sendto($socket2, 'message');
        if ($sent > 0) 
        {
            $server_response2 = fread($socket2, 4096);
			echo '192.168.1.1 bağlantı başarılı : Sonuç :';
            echo $server_response2;
            echo $sent2;
			echo "<hr>";
			

        }
    }
    else
    {
        echo 'Unable to connect to server';
    }

stream_socket_shutdown($socket, STREAM_SHUT_RDWR);

/*$conn = stream_socket_server('tcp://127.0.0.1:4444');
while ($socket = stream_socket_accept($conn)) {
    $pkt = stream_socket_recvfrom($socket, 1500, 0, $peer);
    if (false === empty($pkt)) {
        stream_socket_sendto($socket, 'Received pkt ' . $pkt, 0, $peer);
    }
    fclose($socket);
    usleep(10000); //100ms delay
}
stream_socket_shutdown($conn, \STREAM_SHUT_RDWR);

192.168.10.229
*/

?>