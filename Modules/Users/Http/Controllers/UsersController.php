<?php

namespace Modules\Users\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\UserUsk;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index()
    {
        $userModel = new UserUsk();

        // print_r(User::all()->first());exit;

        return view('users::index', array(
            'users' => $userModel->allUsers(),
            'roles' => $userModel->getAllRole()
        ));
    }

    public function addUser(Request $request)
    {
        try {
            $userModel = new UserUsk();

            $username = $request->post('username');
            $nama = $request->post('name');
            $email = $request->post('email');
            $role = $request->post('role');
            $password = $request->post('password');
            $passwordConf = $request->post('password_confirm');

            if (!$username || !$nama || !$email || !$role || !$password || !$passwordConf) {
                return $this->resError("Harap isi semua data dengan benar");
            }

            if(preg_match('/[^a-zA-Z0-9_-]+/', $username)){
                return $this->resError("Username hanya boleh mengandung karakter angka, huruf, strip (-) dan/atau underscore (_)");
            }

            if (preg_match('/^[0-9]+$/', $username)) {
                return $this->resError("Username tidak boleh terdiri hanya dari angka");
            }

            if (!preg_match('/[a-zA-Z]+/', $username)) {
                return $this->resError("Username harus mengandung huruf");
            }

            if ($password != $passwordConf) {
                return $this->resError("Password dan konfirmasi password tidak sama");
            }

            //cek username valid
            if ($userModel->getUserByUsername($username)) {
                return $this->resError("Username sudah digunakan dan tidak dapat digunakan untuk akun lain");
            }

            $newUser = array(
                'username' => $username,
                'name' => $nama,
                'email' => $email,
                'role' => $role,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            );

            if ($userModel->addUser($newUser)) {
                $newUser = $userModel->getUserByUsername($username);
                return $this->resSuccess(['newUser' => $newUser], "Berhasil menambah user baru");
            } else {
                return $this->resError("Gagal menambahkan user baru");
            }
        } catch (Exception $e) {
            Log::error("Error saat menambahkan user baru: " . $e->getMessage());
            return $this->resError("Terjadi kesalahan saat menambahkan user baru");
        }
    }

    public function deleteUser(Request $request){
        try {
            $username = $request->input('username');
            if(!$username){
                return $this->resError("Username tidak dapat ditemukan");
            }

            $userModel = new UserUsk();

            if(!$userModel->getUserByUsername($username)){
                return $this->resError("User tidak dapat ditemukan");
            }

            if($userModel->deleteUser($username)){
                echo json_encode(array(
                    'status' => true,
                    'msg' => "User berhasil dihapus",
                    'csrf_token' => csrf_token()
                ));
                return;
            } else {
                return $this->resError("Gagal menghapus user");
            }
        } catch (Exception $e) {
            echo json_encode(array(
                'status' => false,
                'msg' => $e->getMessage(),
                'csrf_token' => csrf_token()
            ));
        }
    }

    public function resetPassword(Request $request){
        try {
            $username = $request->input('username');
            if(!$username){
                return $this->resError("Username tidak dapat ditemukan");
            }

            $userModel = new UserUsk();

            if(!$userModel->getUserByUsername($username)){
                return $this->resError("User tidak dapat ditemukan");
            }

            $randomPassword = AppHelper::generateRandomString();

            if($userModel->changePassword($username, $randomPassword)){
                echo json_encode(array(
                    'status' => true,
                    'msg' => "Password berhasil direset, Password baru adalah <strong class='text-danger'>$randomPassword</strong>",
                    'csrf_token' => csrf_token()
                ));
                return;
            } else {
                return $this->resError("Gagal mereset password user");
            }
        } catch (Exception $e) {
            echo json_encode(array(
                'status' => false,
                'msg' => $e->getMessage(),
                'csrf_token' => csrf_token()
            ));
        }
    }
}
