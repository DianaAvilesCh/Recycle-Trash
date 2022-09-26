<?php
session_start();
if ($_SESSION["newsession"] == "nothing" || $_SESSION["newsession"] == null) {
    header("Status: 301 Moved Permanently");
    header("Location: /");
    exit;
} else {
    require('../resources/fpdf/fpdf.php');
    class PDF extends FPDF
    {

        function Header()
        {
            $this->Image('../resources/logo.png', 10, 8, 22);
            $this->Image('../resources/logo.png', 178, 8, 22);
            $this->SetFont('Arial', 'B', 15);
            $this->SetTextColor(60, 60, 60);
            $this->SetX(50);
            $this->Write(20, '                   Reports the Containers');
            $this->Ln();
        }
        function Footer()
        {
            $this->SetFillColor(40, 180, 99);
            $this->Rect(0, 270, 220, 30, 'F');
            $this->SetY(-20);
            $this->SetFont('Arial', '', 10);
            $this->SetTextColor(255, 255, 255);
            $this->SetX(90);
            $this->Write(0, '');
            $this->Ln();
        }
    }
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetY(50);
    $pdf->SetX(40);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(40, 180, 99);
    $pdf->Cell(30, 9, 'Date', 0, 0, 'C', 1);
    $pdf->Cell(35, 9, 'Container name', 0, 0, 'C', 1);
    $pdf->Cell(35, 9, 'Type of waste', 0, 0, 'C', 1);
    $pdf->Cell(32, 9, 'Percentage', 0, 1, 'C', 1);

    include('../controller/conexion.php');
    if ($con) {
        $consulta = "SELECT st.date,con.name_container, gar.description as name_garbage,
        (sum(st.destance_porce)/count(all st.date)||'%') AS porcentaje from state st INNER join
        container_garbage cg on cg.id = st.state_id_garbage INNER join
        container con on con.id = cg.id_container INNER join
        garbage gar on gar.id = cg.id_garbage
        group by st.date,con.id, gar.id
        ORDER by st.date,con.id, gar.id";
        $resultado = pg_query($con, $consulta);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(240, 254, 255);
        if (pg_num_rows($resultado)) {
            while ($obj = pg_fetch_object($resultado)) {
                $date = $obj->date;
                $container = $obj->name_container;
                $garbage = $obj->name_garbage;
                $porcenta = $obj->porcentaje;
                $pdf->SetX(40);
                $pdf->Cell(30, 9, $date, 0, 0, 'C', 1);
                $pdf->Cell(35, 9, $container, 0, 0, 'C', 1);
                $pdf->Cell(35, 9, $garbage, 0, 0, 'C', 1);
                $pdf->Cell(32, 9, $porcenta, 0, 1, 'C', 1);
            }
        }
    }
    $pdf->Output();
}
