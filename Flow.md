# Flow Aplikasi SIPIN
Berikut ini adalah flow aplikasi dari SIPIN.

## Akun
- nip : 12345
- password : password123

- nip : 23451
- password : password123

## Status Barang
- Diproses
- Dipinjam 
- Proses Pengembalian
- Dikembalikan

## Roles
SIPIN memiliki 2 role :
1. Admin
2. User

## Status Barang
- 1 = Tersedia
- 0 = Tidak tersedia

## Status Konfirmasi Peminjaman & Pengembalian
- 1 = Terkonfirmasi
- 0 = Belum dikonfirmasi

=================================================================================

## Admin
- Membuat jenis aset
- Membuat aset

### Peminjaman
- Membuat peminjaman barang untuk user, otomatis akan membuat data pengembalian barang dan data check kondisi barang.
- Melakukan Approval peminjaman mengubah status Diproses menjadi Dipinjam dan status_barang menjadi 0, confirmed menjadi 1
- Melakukan Un-Approval peminjaman mengubah status Dipinjam menjadi Diproses dan status_barang menjadi 1, confirmed menjadi 0

### Pengembalian
- Melakukan Approval pengembalian mengubah status "Proses Pengembalian" menjadi "Dikembalikan" dan status_barang menjadi 1, confirmed menjadi 1. Data peminjaman akan terhapus (berdasarkan id_pengembalian)
- Melakukan Un-Approval pengembalian mengubah status "Dikembalikan" menjadi "Proses Pengembalian" dan status_barang menjadi 0, confirmed menjadi 0

### Check Kondisi
- Data check kondisi akan ditampilkan apabila barang sudah dikembalikan.
- Memperbarui note check kondisi barang, otomatis data pengembalian akan terhapus (berdasarkan no_antrian)
- Menghapus check kondisi barang

### Cetak Laporan
- Download data peminjaman (ditampilkan bila status_peminjaman = Dipinjam), pengembalian (ditampilkan bila status_pengembalian = Dikembalikan), check kondisi versi PDF berdasarkan tanggal yg telah ditentukan
- Download data peminjaman, pengembalian, check kondisi versi Excel berdasarkan tanggal yg telah ditentukan

### Akses Pengelolaan User
- Memperbarui password user
- Memperbarui profile user
- Menghapus user

=================================================================================

## User
- User hanya dapat menambah data peminjaman
- Data pengembalian dan history otomatis akan dibuatkan setelah user menambah data peminjaman
- User hanya dapat melihat data pengembalian
- User hanya dapat melihat data history
- User dapat memperbarui profile, hingga password
- H-3 tgl pengembalian akan diingatkan melalui notifikasi aplikasi.
