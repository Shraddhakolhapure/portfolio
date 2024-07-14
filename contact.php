<?php
require 'PHPExcel/Classes/PHPExcel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $file = 'contacts.xlsx';

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    if (file_exists($file)) {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
    } else {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Email')
            ->setCellValue('C1', 'Message');
    }

    // Get the active sheet
    $sheet = $objPHPExcel->getActiveSheet();
    $highestRow = $sheet->getHighestRow() + 1;

    // Add data
    $sheet->setCellValue('A' . $highestRow, $name)
        ->setCellValue('B' . $highestRow, $email)
        ->setCellValue('C' . $highestRow, $message);

    // Save Excel 2007 file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($file);

    echo "Thank you for contacting us!";
} else {
    echo "Invalid request.";
}
?>
