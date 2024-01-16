<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Tambahkan library jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="ex">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi rem commodi eligendi ut illo consectetur eveniet ad accusantium voluptatibus autem hic, nihil unde, odio esse quo incidunt labore excepturi facere!
    </div>

    <script>
        // Gunakan jQuery untuk menangani peristiwa mouseenter
        $('.ex').mouseenter(() => {
            // Lakukan permintaan AJAX di sini
            $.ajax({
                url: 'https://jsonplaceholder.typicode.com/posts/1', // Gantilah URL sesuai kebutuhan Anda
                method: 'GET',
                success: function(data) {
                    console.log('Cursor hovered on element with class "ex"');
                    console.log('Response from AJAX request:', data);
                    // Lakukan tindakan lebih lanjut di sini dengan data yang diterima
                },
                error: function(error) {
                    console.error('Error during AJAX request:', error);
                }
            });
        });
        console.log("djfhdjh")

    </script>
</body>
</html>
