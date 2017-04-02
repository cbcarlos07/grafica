<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class TipoContatoListIterator
{
    protected $tipoContatoList;
    protected $currentTipoContato = 0;

    public function __construct(TipoContatoList $tipoContatoList_in) {
        $this->tipoContatoList = $tipoContatoList_in;
    }
    public function getCurrentTipoContato() {
        if (($this->currentTipoContato > 0) &&
            ($this->tipoContatoList->getTipoContatoCount() >= $this->currentTipoContato)) {
            return $this->tipoContatoList->getTipoContato($this->currentTipoContato);
        }
    }
    public function getNextTipoContato() {
        if ($this->hasNextTipoContato()) {
            return $this->tipoContatoList->getTipoContato(++$this->currentTipoContato);
        } else {
            return NULL;
        }
    }
    public function hasNextTipoContato() {
        if ($this->tipoContatoList->getTipoContatoCount() > $this->currentTipoContato) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}