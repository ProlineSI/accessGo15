<?php
namespace App\Model\Table;

use CakeS3\Datasource\AwsS3Table;

class S3Table extends AwsS3Table
{
    protected static $_connectionName = 's3_connection';
}
?>