<?php

namespace app\Model;
use app\Model\Abstract\Collection;


class Category extends Collection {
    protected static $tableName = 'Category';
    protected static $fieldName = 'yName';
}