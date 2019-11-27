<?php
    $serverName = "https://leejgapp.azurewebsites.net"; // update me
    $connectionOptions = array(
        "Database" => "dustdata", // update me
        "Uid" => "appcenter", // update me
        "PWD" => "app2015!" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    /*$tsql= "SELECT MAX(t_pm2_5) as maxpm
            FROM [dbo].[dust]";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table".PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
     echo ($row['maxpm']);
    }
    sqlsrv_free_stmt($getResults);*/

    $tsql= "SELECT MAX(t_pm2_5) as maxpm FROM [dbo].[dust];";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo ($row['maxpm'] . PHP_EOL);
    }
    sqlsrv_free_stmt($getResults);

    function FormatErrors( $errors )
    {
        /* Display errors. */
        echo "Error information: ";

        foreach ( $errors as $error )
        {
            echo "SQLSTATE: ".$error['SQLSTATE']."";
            echo "Code: ".$error['code']."";
            echo "Message: ".$error['message']."";
        }
    }
?>
	
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>map</title>
</head>
<body>
        <h1 style="text-align:center; border:thick"> 미세먼지 측정 데이터 </h1>
        <div id="map" style="float:left;width:49%;height:600px;"></div>
        <iframe name="img" id="img" style="float: right;width: 49%;height: 600px;"></iframe>
        <p>
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=cbaab2c9c534e6fcd7b5a9a06732adef"></script>
        </p>
        <p>&nbsp; </p>
        <script>
            
            var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
            mapOption = { 
                center: new kakao.maps.LatLng(35.158044, 129.059990), // 지도의 중심좌표
                level: 9 // 지도의 확대 레벨
            };
            var map = new kakao.maps.Map(mapContainer, mapOption);
    
            // 마커가 표시될 위치입니다 
            var markerPosition  = [ 
                {
                    title: '신라대학교',
                    content: '<div style="padding:5px;">신라대학교<br><a href="https://app.powerbi.com/view?r=eyJrIjoiZmQ1NWMxZGMtMzJhMy00YWZkLTk3NzQtMTE1OTdmNjQxY2VkIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.169024, 128.995852)
                },
                {
                    title: '김해공항', 
                    content: '<div style="padding:5px;">김해공항<br><a href=""https://app.powerbi.com/view?r=eyJrIjoiMjJkYWJhMjktMzg4ZS00ZTAyLWIyMDktNDZiNTI1ZWIwNzhlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D"" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.173097, 128.946298)
                },
                {
                    title: '을숙도', 
                    content: '<div style="padding:5px;">을숙도<br><a href="https://app.powerbi.com/view?r=eyJrIjoiOTAxNDdmMWItY2U4MC00MjM1LTk5YzUtZGFlYjU1ZjBiODdhIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>',
                    latlng: new kakao.maps.LatLng(35.101435, 128.941823)
                },
                {
                    title: '서면', 
                    content: '<div style="padding:5px;">서면<br><a href="https://app.powerbi.com/view?r=eyJrIjoiOGY2ZGZhZDYtYmQ2Mi00MjFhLTg5MTItZjNhMzA0MjIzZTY3IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>',
                    latlng: new kakao.maps.LatLng(35.158498, 129.060071)
                },
                {
                    title: '연제구', 
                    content: '<div style="padding:5px;">연제구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiYTZiMmEyMjYtYmNiNS00N2EwLTlhYTItZmU2ZjI1YmY2NDVlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.186080, 129.081461)
                },
                {
                    title: '해운대구', 
                    content: '<div style="padding:5px;">해운대구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiZDRiYWE5ZmQtNDg0Zi00MDg0LTkyMWYtNjNkNGYyMzU2YzdkIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D"  style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.158731, 129.160384)
                },
                {
                    title: '광안리해수욕장', 
                    content: '<div style="padding:5px;">광안리 해수욕장<br><a href="https://app.powerbi.com/view?r=eyJrIjoiNWYxZGU0YjItMjc2MS00YzIwLThlMWEtYTBjNTQ2YWUwYjZmIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.153141, 129.118674)
                },
                {
                    title: '중구', 
                    content: '<div style="padding:5px;">중구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiNDgwZTkzOTItOGFhYS00YWViLTgyMmMtZjEyN2U2ZmJhN2JlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.105124, 129.037344)
                },
                {
                    title: '사하구',
                    content: '<div style="padding:5px;">사하구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiZGZlZDg0MzItMDg0Mi00ZTc0LTk2YzQtNDY4M2QzMTY3YWFlIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.085857, 128.978082)
                },
                {
                    title: '남구', 
                    content: '<div style="padding:5px;">남구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiYmZkZGVkNDMtNjNlOC00NjBmLWEwY2YtZDJhOGJkYWIyYjlhIiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.129797, 129.091496)
                },
                {
                    title: '북구', 
                    content: '<div style="padding:5px;">북구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiMzBiN2M1MTctM2FkNy00ZjUzLWIwZmYtMmJlMDY5MTcyNjU0IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.233968, 129.025698)
                },
                {
                    title: '서구', 
                    content: '<div style="padding:5px;">서구<br><a href="https://app.powerbi.com/view?r=eyJrIjoiYjhkNDY3ZGYtNDZkZi00ZmE4LWFlM2MtZjA3NGVhNDM3ZmY4IiwidCI6IjI2NmU2NDRkLWQzMzAtNGRhNi1iZTdjLTBlZGVkYThlMTk2NCIsImMiOjEwfQ%3D%3D" style="color:blue" target="img">상세정보조회</a></div>', 
                    latlng: new kakao.maps.LatLng(35.089074, 129.020829)
                }
                
            ];
            // 마커를 생성합니다
            for (var i = 0; i < markerPosition.length; i ++) {
                var marker = new kakao.maps.Marker({
                    map: map, // 마커를 표시할 지도
                    title : markerPosition[i].title,
                    position: markerPosition[i].latlng // 마커를 표시할 위치
                });
                var infowindow = new kakao.maps.InfoWindow({
                    content : markerPosition[i].content,
                    removable : true // 
                });
                kakao.maps.event.addListener(marker, 'click', makeClick(map,marker,infowindow));
            }
    
            // 마커가 지도 위에 표시되도록 설정합니다
    
    
            // 마커에 클릭이벤트를 등록합니다
            function makeClick(map, marker, infowindow) {
                return function() {
                    infowindow.open(map,marker);	
                };
            }
  </script>
</body>
</html>

