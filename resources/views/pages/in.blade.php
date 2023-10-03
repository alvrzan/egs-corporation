<!DOCTYPE html>
<html>
<head>
    <title>Formulir Input</title>
    <!-- Tambahkan link ke file Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulir Input Data</h2>
        <form method="POST" action="{{ url('/out') }}">
            @csrf
            <div class="form-group">
                <label for="A-P1">A-P1:</label>
                <input type="text" class="form-control numeric" id="A-P1" name="A-P1" required maxlength="4" value="2.4">
            </div>
            <div class="form-group">
                <label for="A-P2">A-P2:</label>
                <input type="text" class="form-control numeric" id="A-P2" name="A-P2" required maxlength="4"value="3.5">
            </div>
            <div class="form-group">
                <label for="B-P3">B-P3:</label>
                <input type="text" class="form-control numeric" id="B-P3" name="B-P3" required maxlength="4"value="3.4">
            </div>
            <div class="form-group">
                <label for="B-P4">B-P4:</label>
                <input type="text" class="form-control numeric" id="B-P4" name="B-P4" required maxlength="4"value="2.4">
            </div>
            <div class="form-group">
                <label for="B-P5">B-P5:</label>
                <input type="text" class="form-control numeric" id="B-P5" name="B-P5" required maxlength="4"value="3.5">
            </div>
            <div class="form-group">
                <label for="B-P6">B-P6:</label>
                <input type="text" class="form-control numeric" id="B-P6" name="B-P6" required maxlength="4"value="3.1">
            </div>
            <div class="form-group">
                <label for="C-P7">C-P7:</label>
                <input type="text" class="form-control numeric" id="C-P7" name="C-P7" required maxlength="4"value="2.9">
            </div>
            <div class="form-group">
                <label for="C-P8">C-P8:</label>
                <input type="text" class="form-control numeric" id="C-P8" name="C-P8" required maxlength="4"value="4.0">
            </div>
            <div class="form-group">
                <label for="C-P9">C-P9:</label>
                <input type="text" class="form-control numeric" id="C-P9" name="C-P9" required maxlength="4"value="3.4">
            </div>
            <div class="form-group">
                <label for="C-P10">C-P10:</label>
                <input type="text" class="form-control numeric" id="C-P10" name="C-P10" required maxlength="4"value="2.5">
            </div>
            <div class="form-group">
                <label for="C-P11">C-P11:</label>
                <input type="text" class="form-control numeric" id="C-P11" name="C-P11" required maxlength="4"value="2.8">
            </div>
            <div class="form-group">
                <label for="C-P12">C-P12:</label>
                <input type="text" class="form-control numeric" id="C-P12" name="C-P12" required maxlength="4"value="3.7">
            </div>
            <div class="form-group">
                <label for="C-P13">C-P-13:</label>
                <input type="text" class="form-control numeric" id="C-P-13" name="C-P-13" required maxlength="4"value="2.4">
            </div>
            <div class="form-group">
                <label for="C-P14">C-P14:</label>
                <input type="text" class="form-control numeric" id="C-P14" name="C-P14" required maxlength="4"value="3.5">
            </div>
            <div class="form-group">
                <label for="D-P15">D-P15:</label>
                <input type="text" class="form-control numeric" id="D-P15" name="D-P15" required maxlength="4"value="3.4">
            </div>
            <div class="form-group">
                <label for="D-P16">D-P16:</label>
                <input type="text" class="form-control numeric" id="D-P16" name="D-P16" required maxlength="4"value="4.0">
            </div>
            <div class="form-group">
                <label for="D-P17">D-P17:</label>
                <input type="text" class="form-control numeric" id="D-P17" name="D-P17" required maxlength="3"value="2.4">
            </div>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Tambahkan script ke file Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Validasi input numerik -->
    <script>
        $(document).ready(function() {
            $(".numeric").on("input", function() {
                var value = $(this).val();
                var newValue = value.replace(/[^0-9]/g, ''); // Hanya izinkan angka
                if (newValue.length > 3) {
                    newValue = newValue.substring(0, 3); // Batasi maksimal tiga angka
                }
                if (newValue.length > 1) {
                    newValue = newValue.slice(0, 1) + '.' + newValue.slice(1); // Tambahkan koma setelah angka pertama
                }
                $(this).val(newValue);
            });
        });
    </script>
</body>
</html>
 