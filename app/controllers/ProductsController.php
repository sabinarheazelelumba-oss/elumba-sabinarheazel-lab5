<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
        $this->session = $this->call->library('session');
    }

    public function before_action()
    {
        $session = $this->call->library('session');
        if (!$session->userdata('authenticated')) {
            header('Location: ' . site_url('login'), true, 302);
            exit;
        }
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->order_by('created_at', 'DESC');
        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $this->call->view('products/form', [
            'product' => [],
            'action' => site_url('products/create'),
            'heading' => 'Add product',
        ]);
    }

    public function store()
    {
        $data = $this->validated_input();
        if ($data === false) {
            $this->call->view('products/form', [
                'product' => $this->request->all(),
                'action' => site_url('products/create'),
                'heading' => 'Add product',
                'error' => 'Complete all fields with valid values.',
            ]);
            return;
        }

        $this->ProductModel->insert($data);
        redirect('products');
    }

    public function edit($id)
    {
        $product = $this->ProductModel->find((int) $id);
        if (!$product) {
            redirect('products');
        }

        $this->call->view('products/form', [
            'product' => $product,
            'action' => site_url('products/edit/' . (int) $id),
            'heading' => 'Edit product',
        ]);
    }

    public function update($id)
    {
        $data = $this->validated_input();
        if ($data === false) {
            $data = $this->request->all();
            $data['id'] = (int) $id;
            $this->call->view('products/form', [
                'product' => $data,
                'action' => site_url('products/edit/' . (int) $id),
                'heading' => 'Edit product',
                'error' => 'Complete all fields with valid values.',
            ]);
            return;
        }

        $this->ProductModel->update((int) $id, $data);
        redirect('products');
    }

    public function delete($id)
    {
        $this->ProductModel->delete((int) $id);
        redirect('products');
    }

    private function validated_input()
    {
        $productName = trim((string) $this->request->post('product_name'));
        $description = trim((string) $this->request->post('description'));
        $price = $this->request->post('price');
        $quantity = $this->request->post('quantity');

        if ($productName === '' || $description === '' || !is_numeric($price) || (float) $price < 0 || filter_var($quantity, FILTER_VALIDATE_INT) === false || (int) $quantity < 0) {
            return false;
        }

        return [
            'product_name' => $productName,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }
}