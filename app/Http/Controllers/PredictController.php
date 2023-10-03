<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PredictController extends Controller
{
public function res(Request $request)
{
    // Proses data prediksi jika diperlukan
    $dataPrediksi = $request->input('data_prediksi');
    // Panggil model Naive Bayes atau lakukan prediksi di sini

    // Simpan hasil prediksi ke dalam variabel
    $hasilPrediksi = 'Hasil Prediksi Disini'; // Ganti dengan hasil prediksi sebenarnya

    // Kembalikan hasil prediksi ke view
    return view('pages/out', ['hasil_prediksi' => $hasilPrediksi]);
}

}
