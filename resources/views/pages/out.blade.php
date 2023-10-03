<!-- resources/views/prediksi/hasil_prediksi.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Prediksi</title>
</head>
<body>
    <h1>Hasil Prediksi</h1>
    <p>Hasil Prediksi: {{ $hasil_prediksi }}</p>
    <a href="{{ url('/in') }}">Kembali ke Form Prediksi</a>
</body>
</html>
