<?php

namespace App\Meeting\Table;

class MeetingTable
{

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Pagine les article
     *
     * @return \stdClass[]
     */
    public function findPaginated(): array
    {
        return $this->pdo
            ->query('SELECT * FROM meetings m inner join utilisateur u on u.id_user = m.id_utilisateur')
            ->fetchAll();
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM meetings m 
                                inner join utilisateur u 
                                ON u.id_user = m.id_utilisateur 
                                WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch();
    }

    public function findParticipenr(int $id): array
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM participer p 
                                inner join utilisateur u 
                                on u.id_user = p.id_utilisateur
                                where id_meeting = ?');
        $query->execute([$id]);
        return $query->fetchall();
    }
}
