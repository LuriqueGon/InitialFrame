<?php

namespace IF\Backup;

use App\Connection;
use IF\Model\Backup;

class GetBackup extends Backup
{
    
    public function startBackup()
    {
        $tables = $this->selectAll('show tables');

        foreach ($tables as $key => $table) {
            $this->backupAll($table['Tables_in_'. Connection::DATABASE_NAME]);
        }
    }

    private function backupAll(String $table)
    {
        $$table = $this->getTable($table);
        $headers = $this->setHeaders($$table);

        if (!is_dir($this->path)) mkdir($this->path);

        $file = fopen("$this->path/$table.csv", "w+");
        
        fwrite($file, implode('|', $headers) . "\n");

        $this->setDataBackup($$table, $file);
        fclose($file);
    }

    private function getTable(String $table)
    {
        $query = "SELECT * FROM $table";
        return $this->selectAll($query);
    }

    private function setHeaders(array $array): array
    {
        $headers = array();
        foreach ($array[0] as $key => $value) array_push($headers, ucfirst($key));
        return $headers;
    }

    private function setDataBackup(array $data, $file)
    {
        foreach ($data as $row) {
            $data = array();
            foreach ($row as $value) array_push($data, $value);
            fwrite($file, implode('|', $data));
        }
    }
}
