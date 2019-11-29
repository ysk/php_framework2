<?php

class action {
    public function run() {
        $GET = filter_input(INPUT_GET, 'url');
        $params    = explode('/', $GET);
        $fileName  = array_shift($params);
        $filePath  = __DIR__ . '/models/' . $fileName . '.php';
        $className = $fileName . '_action';

        if ($fileName && file_exists($filePath)) {
            require __DIR__ . '/models/' . $fileName . '.php';
            $app = new $className();
            extract($app->handle($params)); //viewに変数をアサイン
            require __DIR__ . '/views/' . $fileName . '.php';
        } else if(!$fileName || !file_exists($filePath)){
            require __DIR__ . '/models/index.php';
            $app = new index_action();
            extract($app->handle($params)); //viewに変数をアサイン
            require __DIR__ . '/views/index.php';
        }
    }
}

