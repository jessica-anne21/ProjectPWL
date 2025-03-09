class Mahasiswa extends Model
{
    protected $fillable = ['user_id', 'nrp', 'name', 'program_studi_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
