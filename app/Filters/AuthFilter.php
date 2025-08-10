<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        // print_r($this->session->get());die;
    	if ($this->session->get("status_login") == 0)
	    {
            // print_r($this->session->get());die;
	    	echo "invalid";
	        return redirect()->to(base_url('/'))->with('error', "Invalid Credential");
	    }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
?>