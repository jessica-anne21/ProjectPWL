class TataUsaha extends Model
{
    protected $table = 'tata_usaha';
    protected $fillable = ['user_id', 'id_tu', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
