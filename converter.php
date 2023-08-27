<?php
$inputFilePath = $_POST['file_path'];

// Define the absolute path to the output PDF file
$outputFile = __DIR__ . '/uploads/output.pdf';

$libreOfficePath = 'C:\Program Files\LibreOffice\program\soffice.exe';

// Construct the command
$command = "\"$libreOfficePath\" --headless --convert-to pdf \"$inputFilePath\" --outdir \"" . __DIR__ . '/uploads"';

// Execute the command
exec($command, $output, $returnCode);

if ($returnCode === 0) {
    // unlink($inputFilePath);
    echo 'conversion successfull';
} else {
    // There was an error
    echo "Conversion failed. Return code: $returnCode";
    // Optionally, you can print the output for debugging
    print_r($output);
}
?>