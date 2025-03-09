class TataUsaha extends Model
{
    protected $fillable = ['user_id', 'id_tu', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
