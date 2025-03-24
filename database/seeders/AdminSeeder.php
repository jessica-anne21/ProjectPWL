use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Masukkan data admin ke tabel users
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role_id' => DB::table('roles')->where('role_name', 'Admin')->value('id'),
            'program_studi_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahkan admin ke tabel admin
        DB::table('admin')->insert([
            'user_id' => $adminId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
