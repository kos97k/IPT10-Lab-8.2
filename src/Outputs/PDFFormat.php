<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();

        
        $this->pdf->AddFont('Times', '', 'times.php'); 

        
        $founderUrl = 'https://www.auf.edu.ph/home/images/articles/bya.jpg';
        $this->pdf->Image($founderUrl, 90, 10, 30); 

        
        $this->pdf->Ln(50);

        
        $this->pdf->SetFont('Times', 'B', 20);
        $this->pdf->SetTextColor(50, 50, 50); // Darker grey for name
        $this->pdf->Cell(0, 10, 'Profile: ' . $profile->getName(), 0, 1, 'C');

        
        $this->pdf->Ln(10);

        
        $this->pdf->SetFont('Times', 'B', 14);
        $this->pdf->SetTextColor(80, 80, 80); 
        $this->pdf->Cell(0, 10, 'Story', 0, 1, 'C');

        
        $this->pdf->SetFont('Times', '', 12);
        $this->pdf->SetTextColor(60, 60, 60); 

        
        $this->pdf->MultiCell(0, 10, $profile->getStory(), 0, 'C');

        
        $this->pdf->Ln(5);
        $this->pdf->SetDrawColor(100, 100, 100);
        $this->pdf->Line(10, $this->pdf->GetY(), 200, $this->pdf->GetY());

        
        $this->pdf->Ln(10);
    }

    public function render()
    {
        // Output the PDF inline in browser with a unique timestamped filename
        return $this->pdf->Output('I', 'profile_' . time() . '.pdf');
    }
}
