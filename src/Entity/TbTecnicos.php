<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TbTecnicosRepository")
 * @UniqueEntity(fields={"cpf"}, message="cpf.exists")
 */
class TbTecnicos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="cpf", type="string", length=11, unique=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome_completo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dt_nasc;

    /**
     * @ORM\Column(type="float")
     */
    private $valor_hora;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getNomeCompleto(): ?string
    {
        return $this->nome_completo;
    }

    public function setNomeCompleto(string $nome_completo): self
    {
        $this->nome_completo = $nome_completo;

        return $this;
    }

    public function getDtNasc(): ?\DateTimeInterface
    {
        return $this->dt_nasc;
    }

    public function setDtNasc(\DateTimeInterface $dt_nasc): self
    {
        $this->dt_nasc = $dt_nasc;

        return $this;
    }

    public function getValorHora(): ?float
    {
        return $this->valor_hora;
    }

    public function setValorHora(float $valor_hora): self
    {
        $this->valor_hora = $valor_hora;

        return $this;
    }
}
