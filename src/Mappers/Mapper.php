<?php
  class Mapper {
    public function mapRowToJSON($row) {
      return json_encode($row);
    }

    public function mapPgSqlToObject($row) {
      return pg_fetch_object($row);
    }
  } 
?>