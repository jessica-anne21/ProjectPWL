protected $routeMiddleware = [
    // Middleware bawaan Laravel
    'auth' => \App\Http\Middleware\Authenticate::class,
    
    // Tambahkan middleware role
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
