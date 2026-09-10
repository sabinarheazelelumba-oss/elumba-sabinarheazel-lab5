<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UsersModel');
        $this->session = $this->call->library('session');
    }

    public function login()
    {
        if ($this->session->userdata('authenticated')) {
            redirect('products');
        }

        $error = NULL;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim((string) $this->request->post('username'));
            $password = (string) $this->request->post('password');
            $user = $this->UsersModel->find_by('username', $username);

            $databaseLogin = $user && (!isset($user['is_active']) || $user['is_active']) && !empty($user['password']) && password_verify($password, $user['password']);
            $environmentLogin = hash_equals((string) getenv('ADMIN_USERNAME'), $username)
                && hash_equals((string) getenv('ADMIN_PASSWORD'), $password)
                && getenv('ADMIN_USERNAME') !== false
                && getenv('ADMIN_PASSWORD') !== false;

            if ($databaseLogin || $environmentLogin) {
                session_regenerate_id(true);
                $this->session->set_userdata([
                    'authenticated' => true,
                    'user_id' => $user['id'] ?? 0,
                    'username' => $user['username'] ?? $username,
                ]);
                redirect('products');
            }

            $error = 'Invalid username or password.';
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}