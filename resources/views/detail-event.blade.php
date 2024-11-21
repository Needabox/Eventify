<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <link rel="{{ asset('css/custom/detail-event.css') }}" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Styles */
        .event-header {
            background-color: #6a1b9a;
            color: white;
            text-align: center;
            padding: 50px 20px;
        }

        .event-header h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .event-image-placeholder img {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            display: block;
            border-radius: 8px;
        }

        .btn.buy-tickets {
            display: inline-block;
            background-color: #24a6c3;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn.buy-tickets:hover {
            background-color: #107693;
        }

        /* Main Content */
        .event-details {
            background-color: #f9f9f9;
            padding: 50px 20px;
        }

        .event-details h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #6a1b9a;
        }

        .event-details p,
        .event-details ul {
            font-size: 1rem;
            line-height: 1.6;
        }

        .event-details ul {
            padding-left: 20px;
        }

        .event-details ul li {
            margin-bottom: 10px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        form input[type="file"],
        form select,
        form input[type="text"] {
            display: block;
            margin: 10px 0 20px;
            padding: 10px;
            width: 100%;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        form button {
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        form input[type="text"]:focus,
        form select:focus,
        form button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(66, 165, 245, 0.6);
            border: 1px solid #42a5f5;
        }

        .hidden {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .event-header h1 {
                font-size: 2rem;
            }

            .btn.buy-tickets {
                font-size: 0.9rem;
            }

            .event-details h2 {
                font-size: 1.5rem;
            }

            .event-details p,
            .event-details ul {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <header class="event-header">
        <div class="container">
            <h1>{{ $event->name }}</h1>
            <div class="event-image-placeholder">
                <img src="{{ asset('storage/' . $event->photo) }}" alt="Event Image" width="100">
            </div>
        </div>
    </header>

    <main class="event-details">
        <div class="container">
            <section class="event-description">
                <h2>Description</h2>
                <p>
                    {{ $event->description }}
                </p>
            </section>

            {{-- <section class="event-highlights">
                <h2>Apa yang Akan Kamu Temukan?</h2>
                <ul>
                    <li><strong>Fashion Show:</strong> Saksikan peragaan busana yang menakjubkan, di mana mahasiswa
                        berbakat kami akan memamerkan koleksi terbaru mereka.</li>
                    <li><strong>Workshop Kreatif:</strong> Ikuti rahasia di balik penampilan yang stylish dengan
                        bergabung di workshop interaktif kami.</li>
                    <li><strong>Bazaar Fashion:</strong> Temukan produk fashion unik dari desainer brand lokal yang
                        mengusung keunikan gaya kamu!</li>
                </ul>
            </section> --}}

            {{-- <section class="event-ticket">
                <h2>Tiket</h2>
                <p>Mahasiswa UNJ: Rp 20.000</p>
                <p>Umum: Rp 30.000</p>
            </section> --}}

            <section class="event-contact">
                <h2>Informasi Lebih Lanjut</h2>
                <p>Email: eventify@unj.ac.id</p>
                <p>Instagram: @eventify_unj</p>
            </section>

            @if ($event->event_type == 1)
                <a href="#" class="btn buy-tickets">Register</a>
            @else
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Pilihan Tipe Pembayaran -->
                    <label for="payment_type">Pilih Tipe Pembayaran:</label>
                    <select name="payment_type" id="payment_type">
                        <option value="" selected disabled>Pilih Tipe Pembayaran</option>
                        <option value="bca">BCA Virtual Account</option>
                        <option value="mandiri">Mandiri Virtual Account</option>
                        <option value="bri">BRI Virtual Account</option>
                    </select>

                    <!-- Virtual Account -->
                    <div id="virtual_account_container" class="hidden">
                        <div class="virtual-account">
                            Nomor Virtual Account Anda: <strong id="virtual_account_number"></strong>
                        </div>
                    </div>
                    <br>
                    <a href="#" class="btn buy-tickets">Pay</a>
                </form>
            @endif
        </div>
    </main>
    <script>
        // JavaScript untuk menampilkan Virtual Account secara otomatis
        const paymentTypeSelect = document.getElementById('payment_type');
        const virtualAccountContainer = document.getElementById('virtual_account_container');
        const virtualAccountNumber = document.getElementById('virtual_account_number');

        // Fungsi untuk menghasilkan nomor Virtual Account acak
        function generateVirtualAccount(type) {
            const prefix = {
                bca: '888',
                mandiri: '123',
                bri: '321'
            } [type] || '000';

            const randomNumber = Math.floor(100000000 + Math.random() * 900000000); // Nomor acak 9 digit
            return `${prefix}${randomNumber}`;
        }

        // Event listener untuk menampilkan Virtual Account
        paymentTypeSelect.addEventListener('change', function() {
            if (this.value) {
                const vaNumber = generateVirtualAccount(this.value); // Generate nomor VA berdasarkan tipe
                virtualAccountNumber.textContent = vaNumber; // Tampilkan nomor di elemen
                virtualAccountContainer.classList.remove('hidden'); // Tampilkan container
            } else {
                virtualAccountContainer.classList.add('hidden'); // Sembunyikan jika tidak ada tipe pembayaran
            }
        });
    </script>
</body>

</html>
