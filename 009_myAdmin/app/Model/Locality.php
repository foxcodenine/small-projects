<?php

namespace app\Model;
use app\Model\Abstract\Collection;


class Locality extends Collection {
    protected static $tableName = 'Locality';
    protected static $fieldName = 'lName';
}