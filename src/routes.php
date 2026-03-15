<?php

return [

    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],

    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],

    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],

    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],

];