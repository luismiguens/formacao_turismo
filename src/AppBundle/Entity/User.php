<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Luis Miguens <lmiguens@consolidador.com>
 */


namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{

    protected $id;
    
     /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $candidaturas;
    
     /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $votacoes;
    



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    
  /**
     * Add candidatura
     *
     * @param \AppBundle\Entity\Candidatura $candidatura
     *
     * @return Candidatura
     */
    public function addCandidatura(\AppBundle\Entity\Candidatura $candidatura)
    {
       
        
        $candidatura->setCandidatura($this);
         $this->candidaturas->add($candidatura);
        
        //$this->candidaturas[] = $candidatura;

        return $this;
    }

    /**
     * Remove candidatura
     *
     * @param \AppBundle\Entity\Candidatura $candidatura
     */
    public function removeCandidatura(\AppBundle\Entity\Candidatura $candidatura)
    {
        $this->candidaturas->removeElement($candidatura);
    }

    /**
     * Get candidaturas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidaturas()
    {
        return $this->candidaturas;
    }
    
    

     /**
     * Add votacao
     *
     * @param \AppBundle\Entity\Votacao $votacao
     *
     * @return Votacao
     */
    public function addVotacao(\AppBundle\Entity\Votacao $votacao)
    {
       
        
        $votacao->setVotacao($this);
         $this->votacoes->add($votacao);
        
        //$this->votacaos[] = $votacao;

        return $this;
    }

    /**
     * Remove votacao
     *
     * @param \AppBundle\Entity\Votacao $votacao
     */
    public function removeVotacao(\AppBundle\Entity\Votacao $votacao)
    {
        $this->votacoes->removeElement($votacao);
    }

    /**
     * Get votacoes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotacoes()
    {
        return $this->votacoes;
    }
    
    
    
    
    
    
    
}
