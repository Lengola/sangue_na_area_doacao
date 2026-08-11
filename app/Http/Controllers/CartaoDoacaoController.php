<?php

namespace App\Http\Controllers;

use App\Models\Doador;
use Barryvdh\DomPDF\Facade\Pdf;

class CartaoDoacaoController extends Controller
{

    public function downloadPdf($id)
{
    $doador = Doador::with('user')->findOrFail($id);

    $pdf = Pdf::loadView('cartao.pdf', compact('doador'));

    return response($pdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="cartao.pdf"');
}



    public function show($id)
    {
        $doador = Doador::with('user')->findOrFail($id);

        return view('cartao.show', compact('doador'));
    }

    public function downloadPdf1($id)
    {
        $doador = Doador::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('cartao.pdf', compact('doador'));

        return $pdf->download('cartao-doacao.pdf');
    }
}