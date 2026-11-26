<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DapurRasaTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_publik_dapat_diakses(): void
    {
        $this->seed(DatabaseSeeder::class);
        foreach (['/', '/menu', '/tentang-kami', '/kontak', '/menu/1', '/login'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_seeder_idempoten(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);
        $this->assertSame(5, Kategori::count());
        $this->assertSame(10, Menu::count());
        $this->assertSame(1, User::count());
    }

    public function test_pencarian_dan_filter_katalog(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->get('/menu?q=Rendang')->assertSee('Nasi Rendang')->assertDontSee('Ayam Geprek');
    }

    public function test_route_admin_butuh_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/admin/menu')->assertRedirect('/login');
    }

    public function test_login_admin_seeder(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->post('/login', ['email' => 'admin@dapurrasa.com', 'password' => 'admin12345'])->assertRedirect('/admin');
        $this->post('/logout');
        $this->post('/login', ['email' => 'admin@dapurrasa.com', 'password' => 'salah'])->assertSessionHasErrors('email');
    }

    public function test_kategori_terpakai_tidak_bisa_dihapus(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::first();
        $kat = Kategori::first();
        $this->actingAs($admin)->delete("/admin/kategori/{$kat->id}")->assertSessionHas('error');
        $this->assertDatabaseHas('kategoris', ['id' => $kat->id]);
    }

    public function test_kategori_tidak_boleh_duplikat(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->actingAs(User::first())->post('/admin/kategori', ['nama_kategori' => 'Nasi Kotak'])->assertSessionHasErrors('nama_kategori');
    }

    public function test_crud_menu_dengan_foto(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);
        $admin = User::first();
        $kat = Kategori::first();

        $this->actingAs($admin)->post('/admin/menu', [
            'nama_menu' => 'Menu Uji', 'kategori_id' => $kat->id, 'harga' => 15000, 'deskripsi' => 'Uji',
            'foto' => UploadedFile::fake()->image('a.jpg'),
        ])->assertRedirect('/admin/menu');

        $menu = Menu::where('nama_menu', 'Menu Uji')->firstOrFail();
        Storage::disk('public')->assertExists($menu->foto);
        $fotoLama = $menu->foto;

        $this->actingAs($admin)->put("/admin/menu/{$menu->id}", [
            'nama_menu' => 'Menu Uji', 'kategori_id' => $kat->id, 'harga' => 16000, 'deskripsi' => 'Uji',
            'foto' => UploadedFile::fake()->image('b.png'),
        ]);
        Storage::disk('public')->assertMissing($fotoLama);

        $fotoBaru = $menu->fresh()->foto;
        $this->actingAs($admin)->delete("/admin/menu/{$menu->id}");
        Storage::disk('public')->assertMissing($fotoBaru);
    }

    public function test_validasi_menu(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->actingAs(User::first())->post('/admin/menu', ['harga' => -5, 'kategori_id' => 999])
            ->assertSessionHasErrors(['nama_menu', 'harga', 'kategori_id', 'deskripsi']);
    }
}
