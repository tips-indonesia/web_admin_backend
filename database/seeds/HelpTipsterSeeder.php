<?php

use Illuminate\Database\Seeder;

class HelpTipsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('help_tipsters')->insert([
            'title' => 'Lacak Pengiriman',
            'description' => 'Pengirim barang melalui TIPS dapat menelusuri status kirimannya dengan memasukan kode lacak (yang didapatkan setelah menyerahkan barang kiriman di drop point TIPS) pada aplikasi TIPS atau situs TIPS.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Pengiriman',
            'description' => 'Untuk mengirim barang, unduh aplikasi TIPS di Apps Store atau Play Store. Daftarkan pengiriman Anda, kemudian antar barang tersebut ke Drop Point TIPS di
kota Anda. Di Drop Point TIPS akan dilakukan pemeriksaan apakah barang yang akan dikirim memenuhi syarat yang berlaku untuk pengiriman barang di TIPS. Barang-barang yang tidak bisa diterima TIPS bisa dilihat pada menu larangan di sebelah kiri. Setelah dilakukan penimbangan, pengirim dapat melakukan pembayaran dan mendapatkan Kode Lacak untuk menelusuri status pengiriman barang tersebut. Pengirim dan penerima akan mendapatkan notifikasi melalui email pada setiap tahapan proses pengiriman barang, termasuk saat barang yang dikirimkan telah tiba dan tersedia di kantor TIPS di kota tujuan. Pengiriman barang melalui TIPS menggunakan fasilitas bagasi penumpang pesawat. Dengan demikian, jenis-jenis barang yang dapat dikirimkan dengan TIPS harus memenuhi persyaratan sesuai yang berlaku untuk bagasi pesawat',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Larangan',
            'description' => 'TIPS tidak melayani pengiriman barang-barang sebagai berikut:\n1. Material korosif : Merkuri (terdapat dalam thermometer), asam sulfat, alkali  dan aki kendaraan.\n2. Bahan Peledak: Semua tipe granat, detonator, sumbu, alat peledak;\n3. Gas bertekanan (tidak dan yang mudah terbakar, atau yang beracun): Propana, butana, aerosol iritan kimiawi.\n4. Cairan mudah terbakar: Bahan bakar, cat, thinner, perekat (lem), cairan pemantik api, methanol.\n5. Benda padat mudah terbakar: kembang api, petasan, suar;\n6. Zat oksidasi: bubuk pemutih, peroksida.\n7. Material radioaktif.\n8. Bahan kimia/zat beracun: arsenik, sianida, pembasmi hama/serangga, produk biologis yang berbahaya.\n9. Koper dengan instalasi perangkat alarm, atau dilengkapi baterai lithium dan/atau material piroteknik.\n10. Kendaraan kecil yang menggunakan baterai litium seperti airwheel, solowheel, hoverboard, mini-segway, balance wheel.\n11. Alat pelumpuh: Pistol pengejut, alat kejut listrik, tongkat pukul listrik, termasuk alat pelumpuh untuk hewan.\n12. Semprotan bela diri: Gas airmata dan semprotan asam fosfor\n13. Senjata api dan amunisi\n14. Rokok elektronik\n15. Pemantik dan korek api',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Mengambil Barang',
            'description' => 'Penerima barang akan mendapatkan notifikasi setelah barang tersedia di kantor TIPS di kota tujuan.\nPenerima barang bisa mengambil barang di kantor TIPS dengan menunjukkan email notifikasi pengambilan barang dari TIPS.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'TIPSTER',
            'description' => 'TIPSTER adalah Anda yang ingin memanfaatkan bagasi tidak terpakai dalam penerbangan Anda.\n1. Daftarkan penerbangan Anda melalui aplikasi TIPS yang bisa diunduh di Apps Store dan Play Store. Masukan info jadwal penerbangan dan berapa kg ruang bagasi yang ingin Anda manfaatkan untuk TIPS.\n2. Setelah mendapatkan notifikasi dari TIPS mengenai ketersediaan barang, lakukan konfirmasi kesediaan membawa barang.\n3. Datang lebih awal, 3 jam sebelum jadwal penerbangan Anda, kunjungi counter TIPS di terminal keberangkatan, tunjukkan notifikasi TIPS dalam aplikasi Anda untuk mengambil barang.\n4. Bawa barang TIPS ke counter check in penerbangan Anda. Foto luggage tag barang TIPS melalui aplikasi TIPS.\n5. Terbang menuju kota tujuan.\n6. Setelah tiba di kota tujuan, kunjungi counter TIPS di terminal kedatangan. Serahkan luggage tag kepada petugas TIPS.\n7. Anda bisa meninggalkan bandara dan silakan menunggu konfirmasi masuknya insentif TIPS ke dalam TIPS Money Anda.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Insentif TIPSTER',
            'description' => 'Besaran insentif TIPS tergantung kepada rute penerbangan.\nPerhitungan insentif berdasarkan satuan berat barang dengan pembulatan ke atas tiap kilogram. Berat minimal barang TIPS adalah 1 kg.\nInsentif akan masuk secara otomatis ke dalam TIPS Money TIPSTER setelah barang yang dititipkan diterima di kantor TIPS di kota tujuan.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Akun',
            'description' => 'Untuk menjadi TIPSTER dan/atau pengirim barang melalui TIPS diwajibkan memiliki akun TIPS.\nRegistrasi akun TIPS wajib menggunakan nama sesuai dengan identitas diri (KTP), untuk dicocokan dengan data penumpang pesawat.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Voucher & Promosi',
            'description' => 'Program promosi dan voucher dapat diselenggarakan oleh pihak TIPS dari waktu ke  waktu. Untuk informasi mengenai program promosi yang sedang berlaku, harap  selalu mengacu kepada media informasi resmi TIPS, seperti pada situs ini atau aplikasi TIPS.',
            'addt_info' => ''
        ]);

        DB::table('help_tipsters')->insert([
            'title' => 'Hubungi Kami',
            'description' => 'Apabila Anda menemui kendala atau permasalahan dalam menggunakan jasa TIPS, segera informasikan kepada petugas TIPS di bandara atau di kantor TIPS.',
            'addt_info' => 'Anda dapat juga menghubungi kami melalui +62 823 1777 6008 atau amanda@tips.co.id'
        ]);
    }
}
