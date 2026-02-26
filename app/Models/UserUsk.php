<?php

namespace App\Models;

use App\Helpers\AppHelper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class UserUsk extends Model
{
    use HasFactory;

    protected $table = "users";

    function attempLogin($username, $password)
    {
        $user = DB::table($this->table)->where('username', $username)->select(['users.*', 'roles.keterangan as role_name'])
        ->join('roles', 'roles.id','=','users.role')->first();
        if (!$user) {
            return false;
        }
        return password_verify($password, $user->password) ? $user : false;
    }

    function attempLoginMhs($npm, $password){
        try {

            $data['username']=$npm;
            $data['password']=$password;
            $response = AppHelper::post_encrypt_curl("index.php/login", $data); //eksekusi api login
            if ($response && is_object($response)) {
                if ($response->metadata->code != 200) {
                    return false;
                }
                $data_mhs = $response->result;
    
                //data return
                $dataUser = new stdClass();
                $dataUser->username = $data_mhs->nim13;
                $dataUser->name = $data_mhs->nama_mhs;
                $dataUser->role = 3; //3 adalah peserta
                $dataUser->role_name = "Mahasiswa"; //3 adalah peserta
                $dataUser->email = '';
                
                return $dataUser;
            } else {
                return false;
            }
        } catch(Exception $e){
            return false;
        }
    }

    function attempLoginPegawai($nip, $password){
        try{
            $key_ws_pegawai = config('ws.ws-dosen');
            $response = AppHelper::get_curl("http://ws.usk.ac.id/webservice/dosen/cdosen/login/nip/$nip/key/$key_ws_pegawai", 'xml'); //eksekusi api login

            if ($response && is_object($response)) {
                if ($response->status != 1) {
                    return false;
                }

                if($response->md5 != md5($password)){
                    return false;
                }
    
                //data return
                $dataUser = new stdClass();
                $dataUser->username = $nip;
                $dataUser->name = strval($response->nama);
                $dataUser->role = 2; //3 adalah mahasiswa
                $dataUser->role_name = "Pegawai"; //3 adalah mahasiswa
                $dataUser->email = '';
                
                return $dataUser;
            } else {
                return false;
            }
        } catch(Exception $e){
            return false;
        }
    }

    function allUsers()
    {
        return DB::select("SELECT username, name as nama, email, (select keterangan from roles r where r.id=u.role) as rolename from users u");
    }

    public static function getAllRole()
    {
        return DB::table('roles')->get();
    }

    public function getUserByUsername($username){
        return DB::selectOne("SELECT username, name as nama, email, 
            (select keterangan from roles r where r.id=u.role) as rolename 
        from users u where username=?",[$username]);
    }

    public function addUser($newUser){
        return DB::table('users')->insert($newUser);
    }

    public function deleteUser($username){
        return DB::table('users')->where('username', $username)->delete();
    }

    public function changePassword($username, $password){
        return DB::table('users')->where('username', $username)->update([
            'password'=>password_hash($password, PASSWORD_BCRYPT)
        ]);
    }
}
