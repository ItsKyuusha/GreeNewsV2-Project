<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use App\Models\Tanaman;
use App\Models\Forum;
use App\Models\Komentar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@greenews.co.id',
            'password' => Hash::make('password'), // password
            'role' => 'admin',
        ]);

        // User Biasa
        $user = User::create([
            'name' => 'Petani Joko',
            'email' => 'joko@greenews.co.id',
            'password' => Hash::make('password'), // password
            'role' => 'user',
        ]);

        // Sample Berita
        Berita::create([
            'judul' => 'Inovasi Pertanian Berkelanjutan di Indonesia',
            'isi' => 'Pemerintah memperkenalkan teknologi pertanian presisi...',
            'gambar' => null,
            'publisher' => 'Kementan',
            'tanggal' => now()->toDateString(),
            'published' => true,
        ]);

        Berita::create([
            'judul' => 'Cuaca Ekstrem dan Dampaknya Terhadap Produksi Padi',
            'isi' => 'Petani menghadapi tantangan baru dalam menghadapi iklim yang tidak menentu...',
            'gambar' => null,
            'publisher' => 'Greenews Team',
            'tanggal' => now()->toDateString(),
            'published' => true,
        ]);

        // Sample Tanaman
        Tanaman::create([
            'nama' => 'Padi',
            'deskripsi' => 'Padi adalah tanaman utama penghasil beras, dibudidayakan secara luas di Asia.',
            'gambar' => null,
        ]);

        Tanaman::create([
            'nama' => 'Jagung',
            'deskripsi' => 'Jagung adalah tanaman pangan penting yang digunakan sebagai sumber karbohidrat alternatif.',
            'gambar' => null,
        ]);

        // Sample Forum & Komentar
        $forum = Forum::create([
            'user_id' => $user->id,
            'judul' => 'Bagaimana Cara Mengatasi Hama Wereng?',
            'isi' => 'Saya mengalami serangan hama wereng pada tanaman padi saya. Adakah solusi alami?',
            'tanggal' => now()->toDateString(),
        ]);

        Komentar::create([
            'forum_id' => $forum->id,
            'user_id' => $admin->id,
            'isi' => 'Coba gunakan predator alami seperti laba-laba atau semprotkan neem oil.',
            'tanggal' => now()->toDateString(),
        ]);
    }
}
