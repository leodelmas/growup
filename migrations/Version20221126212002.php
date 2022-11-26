<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126212002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recorded_exercise_muscle (recorded_exercise_id INT NOT NULL, muscle_id INT NOT NULL, INDEX IDX_86049B507D19D6AB (recorded_exercise_id), INDEX IDX_86049B50354FDBB4 (muscle_id), PRIMARY KEY(recorded_exercise_id, muscle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recorded_exercise_muscle ADD CONSTRAINT FK_86049B507D19D6AB FOREIGN KEY (recorded_exercise_id) REFERENCES recorded_exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recorded_exercise_muscle ADD CONSTRAINT FK_86049B50354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recorded_exercise_muscle DROP FOREIGN KEY FK_86049B507D19D6AB');
        $this->addSql('ALTER TABLE recorded_exercise_muscle DROP FOREIGN KEY FK_86049B50354FDBB4');
        $this->addSql('DROP TABLE recorded_exercise_muscle');
    }
}
