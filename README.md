Portal Pengajuan Surat

1. Pertama, download zip program ini.
2. Import file database dengan nama 'portal_pengajuan_surat.sql' dari folder 'database' ke dalam device masing-masing.
3. Jalankan program Laravel dengan php artisan serve.

Penjelasan role : 
1. Admin
   - Register melalui link localhost lalu tambahkan 'register/admin'.
   - Login melalui link localhost, tambahkan 'login-admin'.
   - Menambahkan, mengedit, dan menghapus user.

2. Mahasiswa
   - Hanya dapat didaftarkan oleh admin.
   - Login dengan email dan password.
   - Dapat melihat riwayat pengajuan surat.
   - Dapat mengajukan surat dengan jenis Surat Keterangan Mahasiswa Aktif, Surat Keterangan Lulus, Surat Pengantar Tugas Mata Kuliah, dan Laporan Hasil Studi.
   - Dapat melihat status surat yang diajukan.
   - Dapat download file surat (pdf).
  
3. Ketua Prodi
   - Hanya dapat didaftarkan oleh admin.
   - Login dengan email dan password.
   - Dapat melihat surat yang diajukan oleh mahasiswa dengan prodi yang di bawah naungannya. (Misal Ketua Prodi Teknik Informatika hanya dapat melihat surat yang diajukan oleh mahasiswa jurusan Teknik Informatika saja).
   - Dapat melihat detail surat.
   - Dapat melakukan persetujuan maupun penolakan surat.
   - Surat yang disetujui akan diteruskan pada TU. Status surat pun akan berubah.
  
4. Tata Usaha
   - Hanya dapat didaftarkan oleh admin.
   - Login dengan email dan password.
   - Dapat melihat surat yang telah disetujui oleh ketua prodi (hanya berlaku pada prodi yang sama).
   - Dapat mengunggah surat kepada mahasiswa yang melakukan persetujuan (dalam bentuk pdf).
