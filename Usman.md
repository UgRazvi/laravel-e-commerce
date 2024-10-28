php artisan tinker

$user = new User
$user->name = "ADMIN"
$user->email= "websenor@gmail.com"
$user->password= Hash::make("123456789")
$user->mobile_no= "9929114267"
$user->role = 1
$user->save();

$user = new User
$user->name = "Usman"
$user->email= "usman.websenor@gmail.com"
$user->password= Hash::make("123456789")
$user->mobile_no= "9929114267"
$user->role = 2
$user->save();