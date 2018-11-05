<?php

namespace Test;

use App\Model\Connection;
use Doctrine\ORM\EntityManagerInterface;


class DatabaseTest
{
    private $connection;


    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em->getConnection();
    }

    public function deleteDatabase()
    {
        $request = $this->connection->prepare( "DELETE FROM student" );
        $request->execute();
    }

    public function insertData()
    {
        $students = [
            [
                'id' => 'a4644de8-d088-11e8-a8d5-f2801f1b9fd1',
                'lastname' => 'François',
                'firstname' => 'Dupont',
                'birthdate' => '1992-09-09',
            ],
            [
                'id' => 'a464534c-d088-11e8-a8d5-f2801f1b9fd1',
                'lastname' => 'Michel',
                'firstname' => 'Smith',
                'birthdate' => '1978-01-11',
            ],
            [
                'id' => 'a46455d6-d088-11e8-a8d5-f2801f1b9fd1',
                'lastname' => 'Nicole',
                'firstname' => 'Van',
                'birthdate' => '2134-08-08',
            ],
            [
                'id' => 'a4645900-d088-11e8-a8d5-f2801f1b9fd1',
                'lastname' => 'Veronique',
                'firstname' => 'Michaud',
                'birthdate' => '2010-09-12',
            ],
            [
                'id' => 'a4645b62-d088-11e8-a8d5-f2801f1b9fd1',
                'lastname' => 'Benoit',
                'firstname' => 'Shauni',
                'birthdate' => '1997-04-10',
            ]
        ];

        foreach ($students as $student) {
            $request = $this->connection->prepare(
                'INSERT INTO student(id, lastname, firstname, birthdate) VALUES(:id, :lastname, :firstname, :birthdate)'
            );
            $request->execute( array(
                'id' => $student['id'],
                'lastname' => $student['lastname'],
                'firstname' => $student['firstname'],
                'birthdate' => $student['birthdate']
            ) );
        }
    }
}