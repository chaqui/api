<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once APPPATH . '/libraries/REST_Controller.php';

	/**
	* 
	*/
	class Pedido extends REST_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('pedido_model');
		}

//optener todos los datos de la tabla Categoria
	public function index_get(){
//se llama al modelo categoria 
		$data = $this->pedido_model->get();
//se valida si el resultado no es null de la respuesta
		if(!is_null($data)){
			header('Content-Type: application/json; charset=UTF-8');
            header('Access-Control-Allow-Origin: *'); 
            $this->response( array('pedido'=>$data), 200);
		}
		else{
			$this->response(null, 400);
		}
	}

//funcion para buscar por id en la tabla categoria
	public function find_get($id){
//se valida que el id no sea null
		if(!$id){
			$this->response(null, 400);
		}
//se llama la funcion get
		$data = $this->pedido_model->get($id);
//si el return de la funcion es true se imprime el resultado
			if($data){
			header('Content-Type: application/json; charset=UTF-8');
            header('Access-Control-Allow-Origin: *'); 
            $this->response( array('pedido'=>$data), 200);
			}
			else{
				$this->response(null, 404);
			}
	}

	//funcion para insertar
	public function index_post(){
		if(!$this->post('data')){
			header('Content-Type: application/json; charset=UTF-8');
            header('Access-Control-Allow-Origin: *'); 
			$this->response(null, 400);
		}

		$id = $this->pedido_model->save('data');

		if(!is_null($id)){
			$this->respose(array('pedido'=>$id),200);
		}
		else{
			$this->response(array('error'=>'no save'),400);
		}
	}

	    //funcion para actualizar 
    public function index_put($id){
        if(!$this->post('data') || !$id){
            $this->response(null, 400);
        }

        $update = $this->pedido_model->update($id, $this->post('data'));

        if(!is_null($update)){
            $this->response(array('pedido'=>'correct update'),200);
        }
        else{
            $this->response(array('error'=>'no save'), 400);
        }
    }

    //para borrar un pastel 
    public function index_delete($id){
        if(!$id){
            $this->response(null, 400);
        }

        $delete = $this->pedido_model->delete($id);

        if(!is_null($delete)){
            $this->response(array('pedido'=>'correct delete'), 200);
        }
        else{
            $this->response(array('error'=>'no save'), 400);
        }
    }
	}
?>