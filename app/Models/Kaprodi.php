class Kaprodi extends Model
{
    protected $table = 'kaprodi';
    protected $fillable = ['user_id', 'id_kaprodi', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
