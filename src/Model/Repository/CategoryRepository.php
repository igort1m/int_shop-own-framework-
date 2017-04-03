<?php
namespace Model\Repository;

use Library\EntityRepository;
use Model\Category;


class CategoryRepository extends EntityRepository
{
    public function findAll($p)
    {
        $sth = $this->pdo->query("select * from category WHERE parent_id = $p");
        $cats = [];

        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {

            $cat = (new Category())
                ->setId($row['id'])
                ->setName($row['name'])
                ->setParentid($row['parent_id']);


            $cats[] = $cat;
        }
        return $cats;
    }
}