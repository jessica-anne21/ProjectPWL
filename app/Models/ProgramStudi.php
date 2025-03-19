namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi'; // Sesuai dengan tabel di database
    protected $fillable = ['name', 'email', 'password', 'role', 'program_studi_id'];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
