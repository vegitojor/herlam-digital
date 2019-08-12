<?php 

include ("excel/Classes/PHPExcel.php");
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("videotutoriales.es")
->setLastModifiedBy("videotutoriales.es")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 php")
->setCategory("Pruebas de Excel");

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'videotutoriales.es')
->setCellValue('A2', 'Cursos para descargar')
;

// indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="prueba.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');