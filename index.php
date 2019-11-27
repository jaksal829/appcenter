<?php
$ch = curl_init();
$url = 'http://openapi.airkorea.or.kr/openapi/services/rest/ArpltnInforInqireSvc/getCtprvnMesureSidoLIst'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=vl5nMSbWa4z9hEuUjEmt%2BsIIdYzcZMPu%2B%2FavsUjOKTrKzOzxOnO49%2B34605RYPxiskgq4KRCYKszKXkNdmm5eg%3D%3D'; /*Service Key*/
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /*한 페이지 결과 수*/
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*페이지 번호*/
$queryParams .= '&' . urlencode('sidoName') . '=' . urlencode('부산'); /*시도 이름 (서울, 부산, 대구, 인천, 광주, 대전, 울산, 경기, 강원, 충북, 충남, 전북, 전남, 경북, 경남, 제주, 세종)*/
$queryParams .= '&' . urlencode('searchCondition') . '=' . urlencode('DAILY'); /*요청 데이터기간 (시간 : HOUR, 하루 : DAILY)*/

curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

var_dump($response);
?>