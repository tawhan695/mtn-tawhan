
composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

php artisan make:controller Api\UserController

# create
``` php artisan make:controller Api\Auth\LoginController ```
copy & paste to app\Api\Auth\LoginController
```
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;
.....
....
....
    public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'status' => $validator->errors(),
                    'status_code' => 401,
                    ]);
            }else{
        
        
        
                
                    return response()->json([
                        'status_code' => 200,
                        'status' => 'sucess',
                        ]);
            }
        }
```

php artisan make:controller Api\Auth\LogoutController
php artisan make:controller Api\Auth\ForgotController


## seed
php artisan make:seeder UserSeeder
php artisan db:seed
php artisan db:seed --class=UserSeeder
php artisan migrate:refresh --seed