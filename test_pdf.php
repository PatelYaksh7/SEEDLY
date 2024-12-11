<?php
require_once('vendor/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $input_data = $_GET['input_data'];
    $response = $_GET['response'];

    if (is_string($response)) {
        $response = json_decode($response, true);
    }

    if (is_string($input_data)) {
        $input_data = json_decode($input_data, true);
    }

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Soil Quality Prediction Report');
    $pdf->SetSubject('Prediction and User Input');
    $pdf->SetKeywords('Soil Quality, Prediction, User Input, Report');

    $pdf->SetHeaderData('', 0, 'Seedly Report', '', [0, 64, 255], [0, 64, 128]);
    $pdf->setHeaderFont(['helvetica', '', 12]);
    $pdf->setPrintHeader(true);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 12);

    $html = '<h1>Total Soil Report</h1>';

    $html .= '<h2>Input Data</h2>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr><th>Parameter</th><th>Value</th></tr>';
    $html .= '<tr><td>N (Nitrogen)</td><td>' . htmlspecialchars($input_data['N']) . '</td></tr>';
    $html .= '<tr><td>P (Phosphorus)</td><td>' . htmlspecialchars($input_data['P']) . '</td></tr>';
    $html .= '<tr><td>K (Potassium)</td><td>' . htmlspecialchars($input_data['K']) . '</td></tr>';
    $html .= '<tr><td>Temperature (°C)</td><td>' . htmlspecialchars($input_data['temperature']) . '</td></tr>';
    $html .= '<tr><td>Humidity (%)</td><td>' . htmlspecialchars($input_data['humidity']) . '</td></tr>';
    $html .= '<tr><td>pH</td><td>' . htmlspecialchars($input_data['ph']) . '</td></tr>';
    $html .= '<tr><td>Rainfall (mm)</td><td>' . htmlspecialchars($input_data['rainfall']) . '</td></tr>';
    $html .= '</table>';

    if (isset($response['error'])) {
        $html .= '<h2>Error</h2>';
        $html .= '<p>' . htmlspecialchars($response['error']) . '</p>';
    } else {
        $html .= '<h2>Predictions</h2>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr><th>Prediction</th><th>Value</th></tr>';
        $html .= '<tr><td>Soil Quality Prediction</td><td>' . htmlspecialchars($response['soil_quality_prediction']) . '</td></tr>';
        $html .= '<tr><td>Fertilizer Need Prediction</td><td>' . htmlspecialchars($response['fertilizer_need_prediction']) . '</td></tr>';
        $html .= '<tr><td>Water Quality Prediction</td><td>' . htmlspecialchars($response['water_quality_prediction']) . '</td></tr>';
        $html .= '<tr><td>Soil Quality Category</td><td>' . htmlspecialchars($response['soil_quality_category']) . '</td></tr>';
        $html .= '<tr><td>Soil Oxygen Level</td><td>' . htmlspecialchars($response['oxygen_level']) . ' ppm</td></tr>';
        $html .= '<tr><td>Nutrient Deficiency Prediction</td><td>' . htmlspecialchars($response['nutrient_deficiency_prediction']) . '</td></tr>';
        $html .= '<tr><td>Pest Disease Risk</td><td>' . htmlspecialchars($response['pest_disease_risk']) . '</td></tr>';
        $html .= '<tr><td>Soil Type</td><td>' . htmlspecialchars($response['classify_soil_type']) . '</td></tr>';
        $html .= '</table>';
    }

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('prediction_report.pdf', 'I');
}
?>
