<?php
function abort(int $code = 404): void
{
    http_response_code($code);
    require_once VIEWS . "/errors/{$code}.view.php";
}

function formCheck(array $formData, $post = true): array
{
    $loadData = $post ? $_POST : $_GET;
    $acceptableValues = [];
    foreach ($formData as $key) {
        if (isset($loadData[$key])) {
            if (!is_array($loadData[$key])) {
                $acceptableValues[$key] = trim($loadData[$key]);
            } else {
                $acceptableValues[$key] = $loadData[$key];
            }
        } else {
            $acceptableValues[$key] = '';
        }
    }
    return $acceptableValues;
}

function removeUnwantedCharacters(string $string): string|int|float
{
    return htmlspecialchars(trim($string), ENT_QUOTES);
}

function old(string $keyName): string
{
    return $_POST[$keyName] ?? '';
}

function redirect(string $url = ''): void
{
    if ($url) {
        $redirectUrl = $url;
    } else {
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? ROOT;
    }
    header("Location: {$redirectUrl}");
    die();
}


function get_alerts(): void
{
    if (!empty($_SESSION['success'])) {
        require VIEWS . '/incs/alert_success.php';
        unset($_SESSION['success']);
    }

    if (!empty($_SESSION['error'])) {
        require VIEWS . '/incs/alert_error.php';
        unset($_SESSION['error']);
    }
}

function db(): \myfrm\Db
{
    return \myfrm\App::get(Db::class);
}

function check_auth(): bool
{
    return isset($_SESSION['user']);
}

function checkImage($imageName, $rule_value): bool
{
    $fileExt = explode('.', $imageName);
    $fileExt = end($fileExt);
    $rule = explode(':', $rule_value);
    return in_array($fileExt, $rule);
}

function file_extImage(string $nameImage): string
{
    $fileExt = explode('.', $nameImage);
    $fileExt = end($fileExt);
    return $fileExt;
}

function routeParams(): array
{
    return \myfrm\Router::$routeParams;
}

function routeParam(string $name, $default = null): string
{
    return \myfrm\Router::$routeParams[$name] ?? $default;
}