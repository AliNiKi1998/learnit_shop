<?php

namespace System\Request\Traits;

use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{

    public function normalValidation($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == 'required') {
                $this->required($name);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxStr($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minStr($name, $rule);
            } elseif (strpos($rule, "exists:") === 0) {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            } elseif (strpos($rule, "unique:") === 0) {
                $rule = str_replace('unique:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->unique($name, $rule[0], $key);
            } elseif (strpos($rule, "owner:") === 0) {
                $rule = str_replace('owner:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[3]) == false ? null : $rule[3];
                $this->owner($name, $rule[0], $rule[1], $rule[2], $key);
            } elseif ($rule == 'confirmed') {
                $this->confirm($name);
            } elseif ($rule == 'email') {
                $this->email($name);
            } elseif ($rule == 'date') {
                $this->date($name);
            }
        }
    }

    public function numberValidation($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == 'required')
                $this->required($name);
            elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxNumber($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minNumber($name, $rule);
            } elseif (strpos($rule, "exists:") === 0) {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            } elseif ($rule == 'number') {
                $this->number($name);
            }
        }
    }

    protected function maxStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) > $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name max length lower than $count character");
            }
        }
    }

    protected function minStr($name, $count)
    {   
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) < $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name min length upper than $count character");
            }
        }
    }

    protected function maxNumber($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->request[$name] > $count && $this->checkFirstError($name)) {
                $this->setError($name, " $name max number lower than $count character");
            }
        }
    }

    protected function minNumber($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->request[$name] < $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name min number upper than $count character");
            }
        }
    }

    protected function required($name)
    {
        if ((empty($this->request[$name]) || strlen(trim($this->request[$name])) == 0) && $this->checkFirstError($name)) {
            $this->setError($name, "$name is required");
        }
    }

    protected function number($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!is_numeric($this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be number format");
            }
        }
    }

    protected function date($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be date format");
            }
        }
    }

    protected function email($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be email format");
            }
        }
    }

    public function existsIn($name, $table, $field = "id")
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if ($result == 0 || $result === false) {
                    $this->setError($name, "$name not already exist");
                }
            }
        }
    }


    public function unique($name, $table, $field = "id")
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if ($result != 0) {
                    $this->setError($name, "$name must be unique");
                }
            }
        }
    }

    public function owner($name, $firstTable, $firstTableField, $secTable, $secField = 'id')
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT * FROM $firstTable WHERE id = ? AND `deleted_at` IS NULL";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetch();

                $foreignKey = $result["$firstTableField"];

                $sql = "SELECT * FROM $secTable WHERE $secField = ? AND `deleted_at` IS NULL";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$foreignKey]);
                $resultTow = $statement->fetch();

                if ($result["$firstTableField"] == NULL and  $resultTow["$secField"] == NULL) {
                    $this->setError($name, "Does not belong to the owner");
                }
            }
            // $sql = "SELECT * from $secTable INNER JOIN $firstTable ON $secTable.$secField = $firstTable.$firstTableField WHERE $firstTable.id = ? AND $secTable.`deleted_at` IS NULL  AND $firstTable.$firstTableField = $secTable.$secField";
            //     "SELECT * from singers INNER JOIN albums ON singers.id = albums.singer_id WHERE albums.id = 1 AND singers.`deleted_at` IS NULL AND";
        }
    }


    protected function confirm($name)
    {
        if ($this->checkFieldExist($name)) {
            $fieldName = "confirm_" . $name;
            if (!isset($this->$fieldName)) {
                $this->setError($name, " $name $fieldName not exist");
            } elseif ($this->$fieldName != $this->$name) {
                $this->setError($fieldName, "$name confirmation does not match");
            }
        }
    }
}
