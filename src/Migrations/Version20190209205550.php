<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190209205550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tb_ferramentas (id INT AUTO_INCREMENT NOT NULL, tb_os_id INT NOT NULL, cod_ferramenta INT NOT NULL, nome_ferramenta VARCHAR(80) NOT NULL, marca_ferramenta VARCHAR(80) NOT NULL, aluguel_hora DOUBLE PRECISION NOT NULL, INDEX IDX_4825983457215421 (tb_os_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_os (id INT AUTO_INCREMENT NOT NULL, tecnico_id INT NOT NULL, sequence VARCHAR(15) NOT NULL, desconto DOUBLE PRECISION NOT NULL, valor_total DOUBLE PRECISION NOT NULL, data_servico DATETIME NOT NULL, UNIQUE INDEX UNIQ_17D6B0F9841DB1E7 (tecnico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_servicos (id INT AUTO_INCREMENT NOT NULL, tipo ENUM(\'Hidraulico\', \'Eletrico\', \'Pintura\'), descricao VARCHAR(100) NOT NULL, tempo_medio INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_tecnicos (id INT AUTO_INCREMENT NOT NULL, cpf VARCHAR(11) NOT NULL, nome_completo VARCHAR(150) NOT NULL, dt_nasc DATETIME NOT NULL, valor_hora DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tb_ferramentas ADD CONSTRAINT FK_4825983457215421 FOREIGN KEY (tb_os_id) REFERENCES tb_os (id)');
        $this->addSql('ALTER TABLE tb_os ADD CONSTRAINT FK_17D6B0F9841DB1E7 FOREIGN KEY (tecnico_id) REFERENCES tb_tecnicos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tb_ferramentas DROP FOREIGN KEY FK_4825983457215421');
        $this->addSql('ALTER TABLE tb_os DROP FOREIGN KEY FK_17D6B0F9841DB1E7');
        $this->addSql('DROP TABLE tb_ferramentas');
        $this->addSql('DROP TABLE tb_os');
        $this->addSql('DROP TABLE tb_servicos');
        $this->addSql('DROP TABLE tb_tecnicos');
    }
}
