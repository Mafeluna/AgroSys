<?php
require_once '../../models/conexion.php';
require_once '../../models/m_usuario.php';
require '../../vendor/autoload.php';

// Importar clases de PhpSpreadsheet al inicio del archivo
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

function exportarUsuariosPDF() {
    // Require FPDF library
    require('../../vendor/fpdf/fpdf.php');
    
    $usuario = new Usuario();
    $usuarios = $usuario->consultarUsuarios();
    
    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'Lista de Usuarios', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    
    // Headers
    $pdf->Cell(10, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Nombre', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Documento', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Email', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Rol', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Telefono', 1, 1, 'C');
    
    // Data
    $pdf->SetFont('Arial', '', 10);
    foreach ($usuarios as $user) {
        $pdf->Cell(10, 10, $user['id_usuario'], 1, 0, 'C');
        $pdf->Cell(40, 10, utf8_decode($user['nombre'].' '.$user['apellido']), 1, 0, 'L');
        $pdf->Cell(30, 10, $user['documento'], 1, 0, 'C');
        $pdf->Cell(50, 10, $user['email'], 1, 0, 'L');
        $pdf->Cell(30, 10, utf8_decode($user['rol']), 1, 0, 'L');
        $pdf->Cell(30, 10, $user['telefono'], 1, 1, 'C');
    }
    
    // Output PDF
    $pdf->Output('usuarios.pdf', 'D');
    exit;
}

function exportarUsuariosExcel() {
    // PHPSpreadsheet for Excel export - ya no necesitamos el require aquí
    // ni las declaraciones use porque ya están al inicio del archivo
    
    $usuario = new Usuario();
    $usuarios = $usuario->consultarUsuarios();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set headers
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Apellido');
    $sheet->setCellValue('D1', 'Documento');
    $sheet->setCellValue('E1', 'Email');
    $sheet->setCellValue('F1', 'Rol');
    $sheet->setCellValue('G1', 'Teléfono');
    $sheet->setCellValue('H1', 'Dirección');
    $sheet->setCellValue('I1', 'Fecha Registro');
    
    // Style headers
    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => [
                'argb' => 'FFB7DEE8',
            ],
        ],
    ];
    
    $sheet->getStyle('A1:I1')->applyFromArray($styleArray);
    
    // Data
    $row = 2;
    foreach ($usuarios as $user) {
        $sheet->setCellValue('A' . $row, $user['id_usuario']);
        $sheet->setCellValue('B' . $row, $user['nombre']);
        $sheet->setCellValue('C' . $row, $user['apellido']);
        $sheet->setCellValue('D' . $row, $user['documento']);
        $sheet->setCellValue('E' . $row, $user['email']);
        $sheet->setCellValue('F' . $row, $user['rol']);
        $sheet->setCellValue('G' . $row, $user['telefono']);
        $sheet->setCellValue('H' . $row, $user['direccion']);
        $sheet->setCellValue('I' . $row, $user['fecha_registro']);
        $row++;
    }
    
    // Auto size columns
    foreach(range('A','I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    // Create Excel file
    $writer = new Xlsx($spreadsheet);
    
    // Set headers to force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="usuarios.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
    exit;
}

// Handle export requests
if(isset($_GET['export'])) {
    $exportType = $_GET['export'];
    
    if($exportType == 'pdf') {
        exportarUsuariosPDF();
    } else if($exportType == 'excel') {
        exportarUsuariosExcel();
    }
}
?>