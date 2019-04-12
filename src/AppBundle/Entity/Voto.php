<?php

namespace AppBundle\Entity;

/**
 * Voto
 */
class Voto
{
    /**
     * @var integer
     */
    private $valor;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \AppBundle\Entity\Candidatura
     */
    private $candidatura;

    /**
     * @var \AppBundle\Entity\Resposta
     */
    private $resposta;


    /**
     * Set valor
     *
     * @param integer $valor
     *
     * @return Voto
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fosUser
     *
     * @param \AppBundle\Entity\FosUser $fosUser
     *
     * @return Voto
     */
    public function setFosUser(\AppBundle\Entity\FosUser $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Set candidatura
     *
     * @param \AppBundle\Entity\Candidatura $candidatura
     *
     * @return Voto
     */
    public function setCandidatura(\AppBundle\Entity\Candidatura $candidatura = null)
    {
        $this->candidatura = $candidatura;

        return $this;
    }

    /**
     * Get candidatura
     *
     * @return \AppBundle\Entity\Candidatura
     */
    public function getCandidatura()
    {
        return $this->candidatura;
    }

    /**
     * Set resposta
     *
     * @param \AppBundle\Entity\Resposta $resposta
     *
     * @return Voto
     */
    public function setResposta(\AppBundle\Entity\Resposta $resposta = null)
    {
        $this->resposta = $resposta;

        return $this;
    }

    /**
     * Get resposta
     *
     * @return \AppBundle\Entity\Resposta
     */
    public function getResposta()
    {
        return $this->resposta;
    }
    /**
     * @var \AppBundle\Entity\Votacao
     */
    private $votacao;


    /**
     * Set votacao
     *
     * @param \AppBundle\Entity\Votacao $votacao
     *
     * @return Voto
     */
    public function setVotacao(\AppBundle\Entity\Votacao $votacao = null)
    {
        $this->votacao = $votacao;

        return $this;
    }

    /**
     * Get votacao
     *
     * @return \AppBundle\Entity\Votacao
     */
    public function getVotacao()
    {
        return $this->votacao;
    }
}
