<?php 

try {

    spl_autoload_register(function (string $className) {

        require_once __DIR__ . '/../src/' . $className . '.php';

    });

$route = $_GET['route'] ?? ''; // приходит из .htaccess

$routes = require __DIR__ . '/../src/routes.php';

$isRouteFound = false;

// проходимся по всем роутам из src/routes.php и ищем сопадения с текущим url
foreach ($routes as $pattern => $controllerAndAction) {

    preg_match($pattern, $route, $matches);

    if (!empty($matches)) {

        $isRouteFound = true;

        break;

    }

}

if (!$isRouteFound) {

    throw new \MyProject\Exceptions\NotFoundException();

}

unset($matches[0]); // удаляем ненужный элемент, потому что нужный всегда лежит после нулевого 

// === что делает этот кусок кода - не совсем понятно
$controllerName = $controllerAndAction[0];

$actionName = $controllerAndAction[1];

$controller = new $controllerName();

$controller->$actionName(...$matches);

} catch (\MyProject\Exceptions\DbException $e) {

    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');

    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);

} catch (\MyProject\Exceptions\NotFoundException $e) {

    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');

    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);

}
// ===

// ================================================================================

// $pattern = '~^$~';

// preg_match($pattern, $route, $matches);

// if (!empty($matches)) {

//     $controller = new \MyProject\Controllers\MainController();

//     $controller->main();

//     return;

// }

// echo 'Страница не найдена';

// $controller = new \MyProject\Controllers\MainController();

// if (!empty($_GET['name'])) {

//     $controller->sayHello($_GET['name']);

// } else {

//     $controller->main();

// }

// ================================================================================

// $author = new \MyProject\Models\Users\User('Иван');

// $article = new \MyProject\Models\Articles\Article('Заголовок', 'Текст', $author);

// var_dump($article);