<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Parceiro
 */
class Parceiro {

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $imagem;
    private $imagemFile;

    /**
     * @var integer
     */
    private $id;
    private $isJuri;
    private $updatedAt;

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Parceiro
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imagem instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }


        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function setImagemFile(File $imagem = null) {
        $this->imagemFile = $imagem;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imagem) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImagemFile() {
        return $this->imagemFile;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    function getIsJuri() {
        return $this->isJuri;
    }

    function setIsJuri($isJuri) {
        $this->isJuri = $isJuri;
    }

}
