<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {

          //aqui mando la respuesta dependiendo el tipo de exepcion mandado un json
       // echo "hola Mundo";





        if(env('APP_ENV') == 'local'){ //para provar solo lo cambio a production 
            return parent::render($request, $exception);
        }

       if ($exception instanceof NotFoundHtppException) {
        return $this->errorResponse("no se econtro la paguina",$code = 404,$msj='pagina no econtrada');  //implemento mi metodo de error de la clase apiresponse error

       }

       if ($exception instanceof ModelNotFoundException) {
        return $this->errorResponse("recurso no econtrado",$code = 404,$msj='Recurso no econtrada');  //implemento mi metodo de error de la clase apiresponse error

       }

        
        return parent::render($request, $exception);
    }
}
