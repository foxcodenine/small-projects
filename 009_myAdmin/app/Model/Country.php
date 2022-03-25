<?php

namespace app\Model;
use app\Model\Abstract\Collection;

class Country extends Collection {
    protected static $tableName = 'Country';
    protected static $fieldName = 'cName';
}