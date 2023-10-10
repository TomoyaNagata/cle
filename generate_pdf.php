<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('tcpdf_autoconfig.php');
require_once('tcpdf.php'); 

$fontPath = TCPDF_FONTS::addTTFfont('path_to_your_font_file.ttf', 'TrueTypeUnicode', '', 96);
$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$html .= '<table border="1">';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator('Your Name');
$pdf->SetTitle('Room Table PDF');
$pdf->SetFont('kozminproregular', '', 12);// 日本語フォント
$pdf->AddPage();

$html = '<table border="1">';

$html .= '<tr><td>No</td><td>風呂</td><td>ベッド</td><td>点検</td></tr>';

for ($room = 1; $room < 31; $room++) {
    $html .= '<tr>';
    $html .= '<td>' . $room . '</td>';
    $html .= '<td>' . $_SESSION['bath_room' . $room] . '</td>';
    $html .= '<td>' . $_SESSION['bed_room' . $room] . '</td>';
    $html .= '<td>' . $_SESSION['check_room' . $room] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$filename = 'room_table_' . date('Ymd') . '.pdf'; // ファイル名に現在の日付を追加
$pdf->Output($filename, 'D');
?>
