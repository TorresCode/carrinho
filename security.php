<?php

    function security($dados)
    {
        $dados = strip_tags($dados);
        $dados = filter_var($dados, FILTER_SANITIZE_STRIPPED);
        return $dados;
    }
