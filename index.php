<?php
    $connectionInfo = array("UID" => "appcenter", "pwd" => "app2015!", "Database" => "dustdata", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dustserver.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if (!$conn) {
        echo "conn: false";
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   $tsql= "SELECT t_pm1_0, t_pm10, t_pm2_5 FROM dust WHERE EventProcessedUtcTime = (SELECT MAX(EventProcessedUtcTime) FROM dust)";
   $getResults= sqlsrv_query($conn, $tsql);
   // echo ("Reading data from table".PHP_EOL);
   if ($getResults == FALSE){
       echo (sqlsrv_errors());
   }
   while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    //echo (" 초미세먼지 : ".$row['t_pm2_5']." / 미세먼지 : ".$row['t_pm10']." / 극초미세먼지 : ".$row['t_pm1_0'].PHP_EOL);
        $x0 = $row['t_pm2_5'];
        $y0 = $row['t_pm10'];
        $z0 = $row['t_pm1_0'];
    } 
    

    $tsql1= "SELECT t_pm1_0, t_pm10, t_pm2_5 FROM dust1 WHERE EventProcessedUtcTime = (SELECT MAX(EventProcessedUtcTime) FROM dust1)";
    $getResults1= sqlsrv_query($conn, $tsql1);
    // echo ("Reading data from table".PHP_EOL);
    if ($getResults1 == FALSE){
        echo (sqlsrv_errors());
    }
    while ($row1 = sqlsrv_fetch_array($getResults1, SQLSRV_FETCH_ASSOC)) {
     //echo (" 초미세먼지 : ".$row['t_pm2_5']." / 미세먼지 : ".$row['t_pm10']." / 극초미세먼지 : ".$row['t_pm1_0'].PHP_EOL);
         $x5 = $row1['t_pm2_5'];
         $y5 = $row1['t_pm10'];
         $z5 = $row1['t_pm1_0'];
     } 


     $tsql2= "SELECT t_pm1_0, t_pm10, t_pm2_5 FROM dust2 WHERE EventProcessedUtcTime = (SELECT MAX(EventProcessedUtcTime) FROM dust2)";
     $getResults2= sqlsrv_query($conn, $tsql2);
     // echo ("Reading data from table".PHP_EOL);
     if ($getResults2 == FALSE){
         echo (sqlsrv_errors());
     }
     while ($row2 = sqlsrv_fetch_array($getResults2, SQLSRV_FETCH_ASSOC)) {
      //echo (" 초미세먼지 : ".$row['t_pm2_5']." / 미세먼지 : ".$row['t_pm10']." / 극초미세먼지 : ".$row['t_pm1_0'].PHP_EOL);
          $x3 = $row2['t_pm2_5'];
          $y3 = $row2['t_pm10'];
          $z3 = $row2['t_pm1_0'];
      } 
 
     sqlsrv_free_stmt( $stmt);  
    sqlsrv_close( $conn);  
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>map</title>
</head>
<body>
        <h1 style="text-align:center; border:thick"> 미세먼지 측정 데이터 </h1>
        <div id="map" style="float:left;width:49.5%;height:600px;"></div>
        <iframe name="img" id="img" style="float:right;width: 49.5%;height: 500px;"></iframe>
        <p>
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=cbaab2c9c534e6fcd7b5a9a06732adef"></script>
        </p>
        <p>&nbsp; </p>
        <script>
           
            var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
            mapOption = { 
                center: new kakao.maps.LatLng(35.158044, 129.041572), // 지도의 중심좌표
                level: 9 // 지도의 확대 레벨
            };
            var map = new kakao.maps.Map(mapContainer, mapOption);
            // 마우스 드래그와 모바일 터치를 이용한 지도 이동을 막는다
		    //map.setDraggable(false);
            // 마우스 휠과 모바일 터치를 이용한 지도 확대, 축소를 막는다
            map.setZoomable(false);
            // 마커가 표시될 위치입니다 
            var markerPosition  = [ 
                {//0
                    title: '신라대학교',
                    content: '<div style="padding:5px;">신라대학교<br><p> <?php  echo (" 초미세먼지 : ".$x0." <br> 미세먼지 : ".$y0." <br> 극초미세먼지 : ".$z0); ?> </p><a href="https://app.powerbi.com/view?r=eyJrIjoiMzBiN2M1MTctM2FkNy00ZjUzLWIwZmYtMmJlMDY5MTcyNjU0IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.169024, 128.995852)
                },
                {//1
                    title: '김해공항', 
                    content: '<div style="padding:5px;">김해공항<br><p> 초미세먼지 : 14 <br> 미세먼지 : 13 <br> 극초미세먼지 : 6 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiMjJkYWJhMjktMzg4ZS00ZTAyLWIyMDktNDZiNTI1ZWIwNzhlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.173097, 128.946298)
                },
                {//2
                    title: '을숙도', 
                    content: '<div style="padding:5px;">을숙도<br><p> 초미세먼지 : 5 <br> 미세먼지 : 4 <br> 극초미세먼지 : 1 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiOTAxNDdmMWItY2U4MC00MjM1LTk5YzUtZGFlYjU1ZjBiODdhIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>',
                    latlng: new kakao.maps.LatLng(35.101435, 128.941823)
                },
                {//3
                    title: '서면', 
                    content: '<div style="padding:5px;">서면<br><p> <?php  echo (" 초미세먼지 : ".$x3." <br> 미세먼지 : ".$y3." <br> 극초미세먼지 : ".$z3); ?> </p><a href="https://app.powerbi.com/view?r=eyJrIjoiOGY2ZGZhZDYtYmQ2Mi00MjFhLTg5MTItZjNhMzA0MjIzZTY3IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>',
                    latlng: new kakao.maps.LatLng(35.158498, 129.060071)
                },
                {//4
                    title: '연제구', 
                    content: '<div style="padding:5px;">연제구<br><p> 초미세먼지 : 15 <br> 미세먼지 : 16 <br> 극초미세먼지 : 12 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiYTZiMmEyMjYtYmNiNS00N2EwLTlhYTItZmU2ZjI1YmY2NDVlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.186080, 129.081461)
                },
                {//5
                    title: '해운대구', 
                    content: '<div style="padding:5px;">해운대구<br><p> <?php  echo (" 초미세먼지 : ".$x5." <br> 미세먼지 : ".$y5." <br> 극초미세먼지 : ".$z5); ?> </p><a href="https://app.powerbi.com/view?r=eyJrIjoiZDRiYWE5ZmQtNDg0Zi00MDg0LTkyMWYtNjNkNGYyMzU2YzdkIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D"  style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.158731, 129.160384)
                },
                {//6
                    title: '광안리해수욕장', 
                    content: '<div style="padding:5px;">광안리 해수욕장<br><p> 초미세먼지 : 12 <br> 미세먼지 : 12 <br> 극초미세먼지 : 9 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiNWYxZGU0YjItMjc2MS00YzIwLThlMWEtYTBjNTQ2YWUwYjZmIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.153141, 129.118674)
                },
                {//7
                    title: '중구', 
                    content: '<div style="padding:5px;">중구<br><p> 초미세먼지 : 10 <br> 미세먼지 : 14 <br> 극초미세먼지 : 12 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiNDgwZTkzOTItOGFhYS00YWViLTgyMmMtZjEyN2U2ZmJhN2JlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.105124, 129.037344)
                },
                {//8
                    title: '사하구',
                    content: '<div style="padding:5px;">사하구<br><p> 초미세먼지 : 10 <br> 미세먼지 : 14 <br> 극초미세먼지 : 12 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiZGZlZDg0MzItMDg0Mi00ZTc0LTk2YzQtNDY4M2QzMTY3YWFlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.085857, 128.978082)
                },
                {//9
                    title: '남구', 
                    content: '<div style="padding:5px;">남구<br><p> 초미세먼지 : 5 <br> 미세먼지 : 5 <br> 극초미세먼지 : 3 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiYmZkZGVkNDMtNjNlOC00NjBmLWEwY2YtZDJhOGJkYWIyYjlhIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.129797, 129.091496)
                },
                {//10
                    title: '북구', 
                    content: '<div style="padding:5px;">북구<br><p> 초미세먼지 : 9 <br> 미세먼지 : 9 <br> 극초미세먼지 : 8 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiZmQ1NWMxZGMtMzJhMy00YWZkLTk3NzQtMTE1OTdmNjQxY2VkIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.233968, 129.025698)
                },
                {//11
                    title: '서구', 
                    content: '<div style="padding:5px;">서구<br><p> 초미세먼지 : 13 <br> 미세먼지 : 16 <br> 극초미세먼지 : 9 </p><a href="https://app.powerbi.com/view?r=eyJrIjoiYjhkNDY3ZGYtNDZkZi00ZmE4LWFlM2MtZjA3NGVhNDM3ZmY4IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.089074, 129.020829)
                }
                
            ];
            // 마커를 생성합니다
            var redimg = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";
            var blueimg = "http://t1.daumcdn.net/localimg/localimages/07/2012/img/marker_p.png";
            // 마커 이미지의 이미지 크기 입니다
            var imageSize = new kakao.maps.Size(30, 35); 
            // 마커 이미지를 생성합니다    
            var markerImage = new kakao.maps.MarkerImage(redimg, imageSize); 
            var bluemarker = new kakao.maps.MarkerImage(blueimg, imageSize);
            if('<? $x >= 75 ?>'){
                var marker = new kakao.maps.Marker({
                    map: map, // 마커를 표시할 지도
                    title : markerPosition[0].title,
                    position: markerPosition[0].latlng, // 마커를 표시할 위치
                    image : markerImage // 마커 이미지 
                });
            }else if ('<? $x >= 50 ?>'){
                var marker = new kakao.maps.Marker({
                    map: map, // 마커를 표시할 지도
                    title : markerPosition[0].title,
                    position: markerPosition[0].latlng // 마커를 표시할 위치
                });
            }else{
                var marker = new kakao.maps.Marker({
                    map: map, // 마커를 표시할 지도
                    title : markerPosition[0].title,
                    position: markerPosition[0].latlng, // 마커를 표시할 위치
                    image : bluemarker // 마커 이미지 
                });
            }
            var infowindow = new kakao.maps.InfoWindow({
                content : markerPosition[0].content,
                removable : true // x 표시
            });

            var marker = new kakao.maps.Marker({
                map: map, // 마커를 표시할 지도
                title : markerPosition[5].title,
                position: markerPosition[5].latlng // 마커를 표시할 위치
            });
            var infowindow = new kakao.maps.InfoWindow({
                content : markerPosition[5].content,
                removable : true // x 표시
            });

            var marker = new kakao.maps.Marker({
                map: map, // 마커를 표시할 지도
                title : markerPosition[3].title,
                position: markerPosition[3].latlng, // 마커를 표시할 위치
                image : markerImage // 마커 이미지 
            });
            var infowindow = new kakao.maps.InfoWindow({
                content : markerPosition[3].content,
                removable : true // x 표시
            });


            for (var i = 0; i < markerPosition.length; i ++) {
                if(i == 0 || i == 3 || i == 5){
                   
                }else{
                    var marker = new kakao.maps.Marker({
                        map: map, // 마커를 표시할 지도
                        title : markerPosition[i].title,
                        position: markerPosition[i].latlng, // 마커를 표시할 위치
                        image : bluemarker // 마커 이미지 
                     });
                     var infowindow = new kakao.maps.InfoWindow({
                        content : markerPosition[i].content,
                        removable : true // x 표시
                    });
                }
                kakao.maps.event.addListener(marker, 'click', makeClick(map,marker,infowindow));
            }
          
    
    
            // 마커에 클릭이벤트를 등록합니다
            function makeClick(map, marker, infowindow) {
                return function() {
                    infowindow.open(map,marker);
                };
            }
            
    
  </script>
</body>
</html>

