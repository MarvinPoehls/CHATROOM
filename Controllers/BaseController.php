<?php

class BaseController
{
    protected $title = "BaseController";
    protected $view = false;
    protected $exception = null;

    public function render()
    {
        $viewPath = __DIR__."/../Views/".$this->view.".php";

        $controller = $this;

        $projectPath = Configuration::getConfigParameter("path");

        ob_start();
        try {
            include $viewPath;
        } catch (Throwable $exception) {
            $this->setException($exception);
        }
        $content = ob_get_contents();
        ob_end_clean();

        include __DIR__."/../Views/header.php";
        echo $content;
        include __DIR__."/../Views/footer.php";
    }

    public function getRequestParameter($key, $default = false)
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }
        return $default;
    }

    public function redirect($location)
    {
        header("Location: " . $location);
        exit();
    }

    public function getView()
    {
        return $this->view;
    }

    public function getUrl($data)
    {
        return Configuration::getConfigParameter("path") . $data;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function setException($exception)
    {
        $this->exception = $exception;
    }
}