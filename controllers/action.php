<?php

class action {
    public function run() {
        $GET = filter_input(INPUT_GET, 'url');
        $params    = explode('/', $GET);
        $fileName  = array_shift($params);
        $filePath  = './models/' . $fileName . '.php';
        $className = $fileName . '_action';

        if ($fileName && file_exists($filePath)) {
            require './models/' . $fileName . '.php';
            $app = new $className();
            extract($app->handle($params)); //viewに変数をアサイン
            require './views/' . $fileName . '.php';
        } else if(!$fileName || !file_exists($filePath)){
            require './models/index.php';
            $app = new index_action();
            extract($app->handle($params)); //viewに変数をアサイン
            require './views/index.php';
        }
    }
}