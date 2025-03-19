class Admin extends Model
{
    protected $fillable = ['user_id', 'id_admin', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
