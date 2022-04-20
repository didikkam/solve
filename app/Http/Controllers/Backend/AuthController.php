<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\AuthMail;
use App\Models\ModelHasRole;
use App\Models\UserData;
use App\Models\UserEva;
use App\Models\UserToken;
use File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

   public function index()
   {
      return view('pages.auth')->with([
         'title' => 'Auth'
      ]);
   }

   public function register(RegisterRequest $request)
   {
      $data = [
         'type' => 'user',
         'name' => $request->input('name'),
         'no_hp' => $request->input('no_hp'),
         'email' => $request->input('email'),
         'password' => Hash::make($request->input('password')),
         'timezone'  => 'Asia/Jakarta',
         'email_verified_at' => now(),
         'active' => false,
      ];
      $user = User::create($data);

      $role = Role::where('name', 'UserApp')->firstOrFail();
      // Assign User to Roles
      ModelHasRole::create([
         'role_id' => $role->id,
         'model_type' => User::class,
         'model_id' => $user->id
      ]);
      $user_data = [
         'users_id' => $user->id,
         'majors_id' => $request->input('majors_id'),
         'type' => $request->input('type'),
         'nim' => $request->input('nim'),
         'year_entry' => $request->input('year_entry'),
         'year_out' => $request->input('year_out'),
         'address' => $request->input('address'),
         'country_id' => $request->input('country_id'),
         'location' => $request->input('location'),
      ];
      if (isset($request->province_id)) {
         $user_data['province_id'] = $request->province_id;
      }
      if (isset($request->city_id)) {
         $user_data['city_id'] = $request->city_id;
      }
      $user_data = UserData::create($user_data);

      // user eva
      $user_eva = [
         'account_no' => '1' . str_pad($request->input('no_hp'), 16, "0", STR_PAD_LEFT),
         'account_user' => $user->id,
         'account_holder' => $user->name,
         'account_pin' => '',
         'balance' => 0,
      ];
      $user_eva = UserEva::create($user_eva);

      $data = UserData::with('user', 'major', 'country', 'province', 'city', 'user_eva')->findOrFail($user_data->id);
      $token = rand(1111111111, 9999999999) . time();
      $user_token = UserToken::create([
         'user_id' => $data->user->id,
         'name' => 'email_verify',
         'token' => $token
      ]);
      $details = [
         'title' => 'Verify Email Address',
         'link' => url('/emailVerify') . '?id=' . $user_token->id . '&name=email_verify&token=' . $token,
         'view' => 'emails.registerMail'
      ];
      Mail::to($data->user->email)->send(new AuthMail($details));

      return response([
         'message' => 'Berhasil registrasi, cek email untuk melakukan aktivasi',
         // 'data'  => new UserResource($data)
      ], Response::HTTP_OK);
   }

   public function login(Request $request)
   {
      $request->validate([
         'no_hp' => 'required|exists:users,no_hp|digits_between:11,13|numeric',
         'password' => 'required',
      ]);
      if (!Auth::attempt($request->only('no_hp', 'password'))) {
         return response([
            'message' => 'Nomor Hp/Password salah!'
         ], Response::HTTP_UNAUTHORIZED);
      }

      $user = Auth::user();
      if (!$user->isActive()) {
         return response([
            'message' => 'Email anda belum diaktivasi'
         ], Response::HTTP_UNAUTHORIZED);
      }
      User::findOrFail($user->id)->update([
         'last_login_at' => now(),
         'last_login_ip' => $request->ip(),
         'timezone' => $this->get_local_time()
      ]);
      $token = $user->createToken('token')->plainTextToken;
      $cookie = cookie('jwt', $token, 60 * 24); // 1 day
      return response([
         'message' => 'Berhasil login',
         // 'token' => $token,
      ])->withCookie($cookie);
   }

   private function get_local_time()
   {
      $ip = file_get_contents("http://ipecho.net/plain");
      $url = 'http://ip-api.com/json/' . $ip;
      $tz = file_get_contents($url);
      $tz = json_decode($tz, true)['timezone'];
      return $tz;
   }

   public function user()
   {
      $data = Auth::user();
      $data = UserData::with('user', 'major', 'country', 'province', 'city')->where('users_id', $data->id)->firstOrFail();
      $data = new UserResource($data);
      return response([
         'message' => 'List data user',
         'data'  => $data
      ], Response::HTTP_OK);
   }

   public function yearList()
   {
      $data = [];
      for ($i = (int) date('Y'); $i >= 1954; $i--) {
         array_push($data, $i);
      }
      return $data;
   }

   public function logout(Request $request)
   {
      $cookie = Cookie::forget('jwt');
      return response([
         'message' => 'Berhasil logout'
      ])->withCookie($cookie);
   }

   public function changePassword(Request $request)
   {
      $request->validate([
         'current_password' => 'required',
         'new_password' => 'required',
      ]);
      $user = Auth::user();
      $check = Hash::check($request->current_password, $user->password);
      if ($check) {
         $new_password = Hash::make($request->new_password);
         $update = User::findOrFail($user->id)->update([
            'password' => $new_password,
            'password_changed_at' => now(),
         ]);
         if ($update) {
            return response([
               'message' => 'Berhasil update password',
            ], Response::HTTP_OK);
         } else {
            return response([
               'message' => 'Gagal update password',
            ], Response::HTTP_BAD_REQUEST);
         }
      } else {
         return response([
            'message' => 'Password sebelumnya tidak valid',
         ], Response::HTTP_BAD_REQUEST);
      }
   }

   public function changeProfile(Request $request)
   {
      $request->validate([
         'name'              => 'max:255',
         'majors_id'         => 'exists:majors,id',
         'year_entry'        => 'numeric|digits:4',
         'year_out'          => 'numeric|digits:4',
         'profile_image'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
         'country_id'        => 'exists:geo_countries,id',
         'province_id'       => 'exists:geo_provinces,id',
         'city_id'           => 'exists:geo_cities,id',
      ]);

      $user = Auth::user();
      $data_user = [];
      $data_user_data = [];
      if ($request->name) {
         $data_user['name'] = $request->name;
         User::findOrFail($user->id)->update(['name' => $data_user['name']]);
         UserEva::query()->where('account_user', $user->id)->update(['account_holder' => $data_user['name']]);
      }
      if ($request->majors_id) {
         $data_user_data['majors_id'] = $request->majors_id;
      }
      if ($request->nim) {
         $data_user_data['nim'] = $request->nim;
      }
      if ($request->year_entry) {
         $data_user_data['year_entry'] = $request->year_entry;
      }
      if ($request->year_out) {
         $data_user_data['year_out'] = $request->year_out;
      }
      if ($request->address) {
         $data_user_data['address'] = $request->address;
      }
      if ($request->location) {
         $data_user_data['location'] = $request->location;
      }
      if ($request->country_id) {
         $data_user_data['country_id'] = $request->country_id;
      }
      if ($request->province_id) {
         $data_user_data['province_id'] = $request->province_id;
      }
      if ($request->profile_image) {
         $data_user_data['profile_image'] = $request->file('profile_image')->store('user_data', 'public');
      }
      $user_data = UserData::query()->where('users_id', $user->id)->firstOrFail();
      if ($user_data->profile_image && File::exists('storage/' . $user_data->profile_image) && isset($data_user_data['profile_image'])) {
         File::delete('storage/' . $user_data->profile_image);
      }
      $query = $user_data->update($data_user_data);
      if ($query) {
         return response([
            'message' => 'Berhasil update profil',
         ], Response::HTTP_OK);
      } else {
         return response([
            'message' => 'Gagal update profil',
         ], Response::HTTP_BAD_REQUEST);
      }
   }

   public function sendMail()
   {
      $token = rand(1111111111, 9999999999) . time();
      $user_token = UserToken::create([
         'user_id' => 8,
         'name' => 'email_verify',
         'token' => $token
      ]);
      return $user_token;
      // return rand(1111111111, 9999999999);
      // return new WelcomeMail;
      $details = [
         'title' => 'Verify Email Address',
         'link' => url('/emailVerify') . '?id=2&name=email_verify&token=' . rand(1111111111, 9999999999) . time(),
         'view' => 'emails.registerMail'
      ];
      return $details;

      Mail::to('dirodev91@gmail.com')->send(new AuthMail($details));
      return response([
         'message' => 'Email terkirim',
      ], Response::HTTP_OK);
   }

   public function emailVerify(Request $request)
   {
      $user_token = UserToken::query()
         ->where('id', $request->id)
         ->where('name', $request->name)
         ->where('token', $request->token)
         ->whereDate('created_at', Carbon::today())
         ->first();
      if ($user_token) {
         $user = User::findOrFail($user_token->user_id);
         $user->active = true;
         $user->update();
         $user_token->delete();
         return redirect('/successEmail');
      } else {
         return redirect('/failed');
      }
   }

   public function resetPassword(Request $request)
   {
      $request->validate([
         'email' => 'required|exists:users,email|email',
      ]);
      $user = User::query()->where('email', $request->email)->first();
      $token = rand(1111111111, 9999999999) . time();
      $user_token = UserToken::create([
         'user_id' => $user->id,
         'name' => 'reset_password',
         'token' => $token
      ]);
      $details = [
         'title' => 'Reset Your Password',
         'link' => url('/resetPasswordEmail') . '?id=' . $user_token->id . '&name=reset_password&token=' . $token,
         'view' => 'emails.resetPasswordEmail'
      ];
      Mail::to($user->email)->send(new AuthMail($details));
      return response([
         'message' => 'Reset password telah dikirim ke email anda',
      ], Response::HTTP_OK);
   }

   public function resetPasswordEmail(Request $request)
   {
      $user_token = UserToken::query()
         ->where('id', $request->id)
         ->where('name', $request->name)
         ->where('token', $request->token)
         ->latest('created_at')
         ->whereDate('created_at', Carbon::today())
         ->first();
      if ($user_token) {
         $new_pass = rand(111111, 999999);
         $data = [
            'new_password' => $new_pass
         ];
         $user = User::findOrFail($user_token->user_id);
         $user->password = Hash::make($new_pass);
         $user->update();
         $user_token->delete();
         return view('emails.changedPasswordEmail', $data);
      } else {
         return redirect('/failed');
      }
   }
}
