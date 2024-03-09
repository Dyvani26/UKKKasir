<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #customers tr:hover {
            background-color: #ddd;
        }
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        @media print {
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                -webkit-print-color-adjust: exact;
                /* Chrome */
                color-adjust: exact;
                /* Firefox */
            }
            #customers td,
            #customers th {
                border: 1px solid #ddd;
                padding: 8px;
                -webkit-print-color-adjust: exact;
                /* Chrome */
                color-adjust: exact;
                /* Firefox */
            }
            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
                -webkit-print-color-adjust: exact;
                /* Chrome */
                color-adjust: exact;
                /* Firefox */
            }
            #customers tr:hover {
                background-color: #ddd;
                -webkit-print-color-adjust: exact;
                /* Chrome */
                color-adjust: exact;
                /* Firefox */
            }
            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
                -webkit-print-color-adjust: exact;
                /* Chrome */
                color-adjust: exact;
                /* Firefox */
            }
        }
    </style>
</head>

<body>

    <h1>Laporan Transaksi Periode {{ $bulan_tahun }}</h1>

    <table id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Total Transaksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $i)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $i->detail_penjualan->nama_pemesan}}</td>
                <td>{{ $i->tgl_penjualan }}</td>
                <td>{{ formatrupiah($i->total_harga) }}</td>
                <td>
                    {{ $i->status }}
                </td>
            </tr>

        @endforeach



    </table>
    <div style="width: 100%; display: flex; flex-direction: column; align-items: flex-end; margin-right: 5%;">
        <label style="margin-top: 2%;">Kediri, {{ now() }}</label>
        <div id="qrcode" style="margin-top: 2%;"></div>
        <label style="margin-top: 2%;">{{ Auth::user()->name }}</label>
    </div>


<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include qrcode.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- JavaScript to generate QR code -->
<script>
    $(document).ready(function() {
        // Generate QR code
        var username = "{{ Auth::user()->name }} \n"+" Tanggal : {{ now() }}"; // Mendapatkan nama pengguna dari auth Laravel
        var qrText = "Ditanda tangan di D COFFEE LOE\n" + username;
        var qr = new QRCode(document.getElementById("qrcode"), {
            text: qrText,
            width: 90,  // Set the width of QR code
            height: 90  // Set the height of QR code
        });
        // Menunda pencetakan dengan setTimeout
        setTimeout(function() {
            window.print(); // Mencetak saat halaman dimuat
        }, 500); // Menunda pencetakan selama 500 milidetik (0.5 detik)
    });
</script>
</body>
</html>
