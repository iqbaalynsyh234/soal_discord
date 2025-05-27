```sh
Tipe Soal  : 

Soal 1: Buatlah 2 function yang digunakan untuk generate token dan memverifikasi token. Dengan ketentuan seperti ini:
* Function generate dipanggil menggunakan parameter user, ketika dipanggil generate random string, masukkan kedalam array dengan indexnya adalah nama user. Satu index dapat memuat lebih dari 1 token, jadi ketika di panggil 2 kali dengan user yang sama dia akan simpan 2 token hasil generate. Dalam 1 index maksimal dapat menampung 10 token berbeda, jika lebih dari 10 maka buang token yang paling awal dibuat. Setelah itu return token hasil generate.
* Function verify_token dipanggil menggunakan parameter user dan token, ketika token yang dicari ketemu maka hapus token dari array tersebut dan return true, jika tidak ketemu return false.
Soal 2: Ada 2 class, class Siswa dengan attribut nrp, nama, daftarNilai, sedangkan class Nilai dengan attribut mapel, nilai. Buatlah:
* daftarNilai berisi class Nilai. Dimana daftarNilai ini adalah sebuah array yang memiliki panjang 3.
* Buat siswa baru dan set mapel menjadi inggris dan nilainya 100
* Generate 10 siswa dengan nama random string 10 char, mapel dirandom antara inggris, indonesia, jepang. Nilai dengan random antara 0-100.
Soal 3: Terdapat 1 array yang berisi nilai 'merah', 'kuning', 'hijau'. Buatkan function yang mereturn nilai seperti layaknya rambu lalu lintas. Function bisa di panggil terus menerus dan returnnya juga selalu mengikuti pola yang sama yaitu return pertama merah, trus kuning, trus hijau, trus merah lagi, dst. Contoh kasus ketika function di panggil 1x akan mereturn merah, kalo di panggil lagi akan return kuning, ketika pemanggilan ke 4 akan mereturn merah lagi.
Soal 4: Terdapat 1 array yang berisi 5 random integer, buatlah function yang di gunakan untuk mendapatkan nilai terbesar kedua.
Soal 5: Buatkan sebuah function yang digunakan untuk menghitung karakter mana yang kemunculannya paling banyak pada suatu kata. Contoh input kata 'wellcome' maka returnnya adalah 'l 2x', input kata 'strawberry' maka returnnya adalah 'r 2x'.
Soal 6: Selesaikan problem di bawah ini. (Report di halaman berikutnya)
* Report di generate setiap 15 menit
* Perhitungan laporan berdasarkan tanggal dia update
* Data yang tidak memiliki update, di anggap updatenya di tanggal create
* Report sebelumnya dapat berubah ketika ada perubahan data updated seperti contoh di bawah.  buatkan msing masing php native nya dengan dataset nya ini
```