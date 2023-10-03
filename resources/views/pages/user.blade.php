<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Tambahkan bagian header sesuai kebutuhan -->
    </header>
    <nav>
        <!-- Tambahkan bagian navigasi sesuai kebutuhan -->
    </nav>
    <main>
        <section>
            <div class="user-profile">
                <h1>User Information</h1>
                <div class="profile-picture" id="profile-picture">
                    <div class="edit-icon" id="edit-icon">
                        <!-- Tombol edit gambar profil -->
                        <label for="profile-image-upload" class="edit-button">
                            <i class="fas fa-pencil-alt"></i>
                        </label>
                        <input type="file" id="profile-image-upload" accept="image/*">
                    </div>
                    <img class="account rounded-circle" id="account-icon" src="{{ asset('storage/images/' . Auth::user()->profile_picture) }}" alt="{{Auth::user()->profile_picture}}">
                </div>
                
                <div class="profile-info">
                    <div class="profile-item">
                        <span class="item-label">Email:</span>
                        <span class="item-value">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="profile-item">
                        <span class="item-label">Username:</span>
                        <span class="item-value">{{ Auth::user()->username }}</span>
                        <!-- Tombol edit username -->
                        <a href="#" class="edit-button"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
    <footer>
        <!-- Tambahkan bagian footer sesuai kebutuhan -->
    </footer>
    <!-- Tambahkan script JavaScript sesuai kebutuhan -->
    <script>
        // JavaScript

        // Mendapatkan elemen input file
        const imageUploadInput = document.getElementById('profile-image-upload');
        imageUploadInput.addEventListener('change', function () {
            const selectedFile = imageUploadInput.files[0];
            if (selectedFile) {
                // Di sini Anda dapat mengirimkan gambar yang dipilih ke server atau menggunakannya secara lokal
                // Contoh: Anda dapat mengatur gambar profil dengan URL gambar yang dipilih:
                const accountIcon = document.getElementById('account-icon');
                accountIcon.src = URL.createObjectURL(selectedFile);
            }
        });

    </script>
</body>

</html>
