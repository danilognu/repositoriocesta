<?php

Class menuVO{

    public $mbIdNome;
    public $mbNome;
    public $mbUrl;
    public $mbIconCss;

}

Class comumEstadoVO{

    public $mbIdEstado;
    public $mbNome;
    public $mbUF;
}

Class comumCidadeVO{

    public $mbIdCidade;
    public $mbNome;
    public $mbIdEstado;

}

Class comumPermissoesVO{

    public $mbIndPadaro;
    public $mbIndExibeAgenda;
    public $mbIdPessoa;
    public $mbIdMenu;
    public $mbTipo;
    public $mbIndPermissao;

}

?>