<?php

    namespace App\Http\Middleware;

    use App\Exceptions\GenericException;
    use Closure;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

    class JWTMiddleware
    {
        /**
         * @throws GenericException
         */
        public function handle($request, Closure $next)
        {
            $token = $request->header('Authorization');

            if (!isset($token)) {
                throw new GenericException("No se encuentra autenticado!", 401);
            } else {
                try {
                    JWTAuth::parseToken()->authenticate();
                } catch (JWTException $e) {
                    throw new GenericException("La sesion ha caducado!", 401);
                }
            }

            return $next($request);
        }
    }

?>