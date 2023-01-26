<?php

class AddMessage extends BaseController
{
    public function render()
    {
        $values = [];
        $values[] .= $this->getRequestParameter("text");
        $values[] .= $this->getRequestParameter("user");
        $filename = $this->getRequestParameter("file");

        $file = fopen("chatlogs/".$filename, "a");

        fputcsv($file, $values);

        fclose($file);
    }
}