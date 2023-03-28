<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\imgTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    use imgTrait;
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    //create login function 
    public function login(Request $request)
    {
        //validation email and password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        //if validate fails 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        //create your user_id not unriment for user image   
        $user_id = time();
        // check if user uploaded a profile image  
        $profile_img = $request->file('profile_img');
        $profile_img_id = $this->upload_img($profile_img, "group/profile", $user_id, "profile");
        $cover_img = $request->file('cover_img');
        $cover_img_id = $this->upload_img($cover_img, "group/cover", $user_id, "cover");

        //validate information for register
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:8',
            'birthday' => 'required|date_format:Y-m-d',
            'address' => 'string',
            'gender' => 'string',
            'breed_id' => 'required',
        ]);
        //if validate fails
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        // create user
        $user = User::create(
            array_merge(
                $validator->validated(),
                [
                    'id' => $user_id,
                    'password' => bcrypt($request->password),
                    'profile_img' => $profile_img_id,
                    'cover_img' => $cover_img_id,
                ]
            )
        );
        /**
         * Create a new notification instance.
         *
         * @return void
         */
        //create token for register
        $token = Auth::login($user);

        //response returned 
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        //get all data of user
        return response()->json(auth()->user());
    }



    public function forgotPassword(Request $request)
    {

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $userCount = User::where('email', $data['email'])->count();
        if ($userCount == 0) {
            return redirect()->back()->with('flash_message_error', 'Email does not exists!');
        }

        //Get User Details
        $userDetails = User::where('email', $data['email'])->first();

        //Generate Random Password
        $random_password = Str::random(8);

        //Encode/Secure Password
        $new_password = bcrypt($random_password);

        //Update Password
        User::where('email', $data['email'])->update(['password' => $new_password]);

        //Send Forgot Password Email Code
        $email = $data['email'];
        $name = $userDetails->name;
        $messageData = [
            'email' => $email,
            'name' => $name,
            'password' => $random_password
        ];
        Mail::send('email.forgetpassword', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('New Password - E-com Website');
        });

        return response()->json([
            'message'=>'youre password sended to youre email'
        ]);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}