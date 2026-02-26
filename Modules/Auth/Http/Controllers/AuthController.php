<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\AppHelper;
use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\UserUsk;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->session()->has('username')) {
            $firstMenu = MenuHelper::getFirstMenuRole(session('roleid'));
            return redirect($firstMenu);
        }
        return view('auth::index');
    }

    public function doLogin(Request $request)
    {
        if ($request->session()->has('username')) {
            return $this->resSuccess(null, "OK");
        }

        try {
            $username = $request->post('username');
            $password = $request->post('password');
            $captchaInput = $request->post('captcha_input');
            if ($captchaInput != session(config('captcha.session'))) {
                return $this->resError("Captcha tidak sesuai $captchaInput != " . session(config('captcha.session')));
            }

            $userModel = new UserUsk();
            $user = $userModel->attempLogin($username, $password);

            if (!$user) {
                $user = $userModel->attempLoginMhs($username, $password);
                if(!$user){
                    return $this->resError("Username atau password salah");
                }
            }

            $request->session()->regenerate();

            $listMenu = MenuHelper::getListMenu($user->role);
            $parent_menu = [];
            $submenu = [];
            $current_parent = "";
            $allAkses = [];
            foreach ($listMenu as $menu) {
                array_push($allAkses, $menu->url);
                if (!$menu->parent) {
                    $current_parent = $menu->nama;
                    array_push($parent_menu, array(
                        'icon' => $menu->menu_icon,
                        'name' => $menu->nama,
                        'url' => $menu->url,
                        'parent_path' => $menu->url
                    ));
                } else {
                    if ($current_parent != $menu->parent) {
                        $current_parent = $menu->parent;
                        array_push($parent_menu, array(
                            'icon' => $menu->icon_parent,
                            'name' => $menu->parent,
                            'url' => null,
                            'parent_path' => $menu->parent_path
                        ));
                    }

                    if (!isset($submenu[$current_parent])) {
                        $submenu[$current_parent] = [];
                    }
                    array_push($submenu[$current_parent], array(
                        'name' => $menu->nama,
                        'url' => $menu->url
                    ));
                }
            }

            session([
                'roleid' => $user->role,
                'rolename' => $user->role_name,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'all_akses' => $allAkses,
                'menus' => array(
                    'parent' => $parent_menu,
                    'sub' => $submenu
                )
            ]);

            return $this->resSuccess(null, "OK");
        } catch (Exception $e) {
            Log::error("Error saat login: " . $e->getMessage());
            return $this->resError("Terjadi kesalahan saat login. Harap coba lagi");
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('auth.form'));
    }
    public function generateImageCaptcha()
    {
        header("Content-Type: image/png");

        // Set image size
        $width = config('captcha.width');
        $height = config('captcha.height');

        // Create image resource
        $image = imagecreatetruecolor($width, $height);

        // Set background color
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $background_color);

        // Set text color
        $text_color = imagecolorallocate($image, 0, 0, 0);

        // Set text font
        $font = public_path('assets/fonts/roboto.ttf');

        // Set text
        $captcha_text = AppHelper::generateRandomString('5');
        $session_key = config('captcha.session');
        session([
            $session_key => $captcha_text
        ]);
        $text = $captcha_text;

        // Get text size
        $text_box = imagettfbbox(20, 0, $font, $text);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[3] - $text_box[1];

        // Calculate text position
        $x = ($width / 2) - ($text_width / 2);
        $y = ($height / 2) - ($text_height / 2);

        // Add text to image
        imagettftext($image, 20, 0, $x, $y, $text_color, $font, $text);

        // Set line color
        $line_color = imagecolorallocate($image, 128, 128, 128);

        // Draw random lines
        for ($i = 0; $i < 30; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
        }

        // Output image
        imagepng($image);

        // Destroy image resource
        imagedestroy($image);
    }
}
