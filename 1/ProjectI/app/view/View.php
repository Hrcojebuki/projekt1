<?php

class View {
    private $_templates = [];
    
    public function __construct($file) {
        $this->_templates = array();
        $this->add_template($file);
    }

    public function add_template($file) {
        if (file_exists($file)) {
            array_push($this->_templates, $file);
        } else {
            array_push($this->_templates, 'app/view/template/404.php');
        }
    }

    public function render($data) {
        include 'app/view/shared/header.php';
        foreach ($this->_templates as $_template) {
            include $_template;
        }
        include 'app/view/shared/footer.php';
    }
}