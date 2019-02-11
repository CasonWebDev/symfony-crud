<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TbFerramentasRepository")
 */
class TbFerramentas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $cod_ferramenta;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nome_ferramenta;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $marca_ferramenta;

    /**
     * @ORM\Column(type="float")
     */
    private $aluguel_hora;

    public function getCodFerramenta(): ?int
    {
        return $this->cod_ferramenta;
    }

    public function getNomeFerramenta(): ?string
    {
        return $this->nome_ferramenta;
    }

    public function setNomeFerramenta(string $nome_ferramenta): self
    {
        $this->nome_ferramenta = $nome_ferramenta;

        return $this;
    }

    public function getMarcaFerramenta(): ?string
    {
        return $this->marca_ferramenta;
    }

    public function setMarcaFerramenta(string $marca_ferramenta): self
    {
        $this->marca_ferramenta = $marca_ferramenta;

        return $this;
    }

    public function getAluguelHora(): ?float
    {
        return $this->aluguel_hora;
    }

    public function setAluguelHora(float $aluguel_hora): self
    {
        $this->aluguel_hora = $aluguel_hora;

        return $this;
    }
}
