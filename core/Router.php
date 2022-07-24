<?php

namespace Nest;

class Router
{
    private static array $paths = [
        'GET'  => [],
        'POST' => [],
    ];

    private static function _get($path, $callback)
    {
        self::$paths['GET'][$path] = [
            new $callback[0](),
            $callback[1],
        ];
    }

    private static function _post($path, $callback)
    {
        self::$paths['POST'][$path] = [
            new $callback[0](),
            $callback[1],
        ];
    }

    /**
     * TODO: Make routing work for functions as well.
     *
     * @return bool
     */
    private function _functionResolver($callback): bool
    {
        return false;
    }

    /**
     * It requires a [ class, method ].
     *
     * @param array $callback
     *
     * @return bool
     */
    private function _classResolver(array $callback): bool
    {
        if (count($callback) < 2) {
            /**
             * TODO: Write up an error.
             */
            throw new \Exception('');
        }

        $class = $callback[0];
        $method = $callback[1];

        $reflection = new \ReflectionClass($class);
        $parameters = $reflection->getMethod($method)->getParameters();
        $arguments = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType()->getName();
            $arguments[] = new $dependency();
        }

        $code = call_user_func_array(
            [
                new $class(),
                $method,
            ],
            $arguments
        );

        eval(sprintf(' ?> %s <?php ', $code));

        return true;
    }

    public function __call($name, $arguments)
    {
        $method = '_'.$name;
        $this->$method(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        $method = '_'.$name;

        $instance->$method(...$arguments);
    }

    /**
     * Does all the routing for you.
     * TODO: fucntionResolver is still left.
     *
     * @return void
     */
    public function __destruct()
    {
        $request = new Request();

        $path = $request->path;
        $method = $request->method;
        $callback = self::$paths[$method][$path];

        if ($callback) {
            $this->classResolver($callback);
        }
    }
}
