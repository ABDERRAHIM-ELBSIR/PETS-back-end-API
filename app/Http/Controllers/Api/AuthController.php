<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Files;
use Validator;

class AuthController extends Controller
{
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
        $profile_img_data = null;
        if ($profile_img != null) {
            $image_path = $profile_img->store('images/profiles', 'chat_imgs');
            $data = Files::create([
                "type" => "image/png",
                "size" => 20025,
                //change name to refer_to id 
                'name' => 'default',
                //add type of refer_to  
                "file" => "storage/" . $image_path
            ]);
            $profile_img_data = $data;
        }
        // check if user uploaded a cover image  
        $cover_img = $request->file('cover_img');
        $cover_img_data = null;
        if ($cover_img != null) {
            $image_path = $cover_img->store('images/covers', 'chat_imgs');
            $data = Files::create([
                "type" => "image/png",
                "size" => 20025,
                //change name to refer_to id 
                'name' => 'default',
                //add type of refer_to  
                "file" => "storage/" . $image_path
            ]);
            $cover_img_data = $data;
        }

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
        //check id profile and cover if null
        $profile_img_id = null;
        $cover_img_id = null;
        if ($profile_img_data != null) {
            $profile_img_id = $profile_img_data->id;
        }
        if ($cover_img_data != null) {
            $cover_img_id = $cover_img_data->id;
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