# TP3DPBO2024C2
Saya Alfen Fajri Nurulhaq 2201431 TP3 dalam Mata Kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.
![image](https://github.com/ubbbeee/TP3DPBO2024C2/assets/120569318/a836c3b4-7b1f-473b-ba40-9179077dfc08)

Disini Saya Membuat Data Hewan Di Indonesia

## Penjelasan Desain Program
Memiliki 3 Tabel
yang pertama ada Tabel Hewan
atributnya yaitu
- id_hewan: primary key
- hewan_foto: untuk gambar hewan
- hewan_nama: untuk nama hewan
- hewan_populasi: untuk populasi hewan
- hewan_nama_latin: untuk nama latin atau scientific name hewan
- ciri_id: foreign key ke tabel ciri
- jenis_id: foreign key ke tabel jenis

yang kedua yaitu Tabel Ciri
- ciri_id: primary key untuk ciri
- ciri_nama: nama ciri, yaitu ciri hewan berdasarkan makanan bisa herbivora(pemakan tumbuhan), karnivora(pemakan daging), omnivora(pemakan segala) dan lain lain

yang ketiga yaitu Tabel Jenis
- jenis_id: primary key untuk jenis
- jenis_nama: nama jenis, yaitu jenis hewan seperti mamalia, aves(burung), pisces(ikan), reptil dan lain lain

## Alur Program
Pada halaman utama terdapat Daftar Hewan pada card dengan data hewan masing-masing seperti foto, nama, ciri, nama latin dan, jenis hewan tersebut.

User dapat melakukan sorting data hewan berdasarkan dengan menekan tombol descending atau ascending atau default untuk kembali ke tampilan semula. 

Selain itu user juga dapat melakukan pencarian data hewan dengan mengetikkan nama atau jenis atau ciri atau nama latin hewan tersebut di kolom search.

Ketika card hewan ditekan maka akan tampil detail dari hewan tersebut lalu user bisa mengubah atau menghapus data hewan.

Untuk menambah hewan, user bisa menekan tombol 'Tambah Hewan' pada navbar dan akan ditampilkan form untuk mengisi data hewan

Untuk melihat daftar ciri yang ada bisa menekan tombol 'Daftar Ciri' pada navbar, akan ada form di kanan untuk menambah data ciri baru, user juga bisa mengubah atau menghapus data ciri dengan menekan button yang ada di kolom 'Action' ketika user menekan edit maka data ciri akan ditampilkan di form yang ada di bagian kanan sehingga user bisa mengubah data nya. Perlu diperhatikan bahwa karena on update cascade dan ondelete cascade, ketika menghapus jenis atau ciri, maka hewan yang menggunakan ciri atau jenis tersebut akan ikut terhapus, untuk mencari satu data ciri juga bisa dicari melalui kolom cari

Sama untuk daftar jenis juga seperti daftar ciri

list ciri dan jenis juga bisa di sort secara ascending, descending, atau default

## Screen Record

https://github.com/ubbbeee/TP3DPBO2024C2/assets/120569318/a4dcf809-7d86-4a56-b7a2-9d53e6dbb9ed

