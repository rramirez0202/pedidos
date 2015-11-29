<?php

$lang['db_invalid_connection_str'] = 'No es posible determinar la configuracion de la base de datos con base en la cadena de conexion enviada.';
$lang['db_unable_to_connect'] = 'No es posible conectar al servidor de base de datos utilizando los datos de configuración proporcionados.';
$lang['db_unable_to_select'] = 'No es posible seleccionar la base de datos especificada: %s';
$lang['db_unable_to_create'] = 'No es posible crear la base de datos especificada: %s';
$lang['db_invalid_query'] = 'La consulta enviada no es válida.';
$lang['db_must_set_table'] = 'Debes establecer tabla de la base de datos a usar en el query.';
$lang['db_must_use_set'] = 'Debes usar el método "set" para actualizar una entrada.';
$lang['db_must_use_index'] = 'Debes especificar un índice coincidir con los queries tipo batch.';
$lang['db_batch_missing_index'] = 'One or more rows submitted for batch updating is missing the specified index.';
$lang['db_must_use_where'] = 'Updates are not allowed unless they contain a "where" clause.';
$lang['db_del_must_use_where'] = 'Deletes are not allowed unless they contain a "where" or "like" clause.';
$lang['db_field_param_missing'] = 'To fetch fields requires the name of the table as a parameter.';
$lang['db_unsupported_function'] = 'This feature is not available for the database you are using.';
$lang['db_transaction_failure'] = 'Transaction failure: Rollback performed.';
$lang['db_unable_to_drop'] = 'No es posible to drop the specified database.';
$lang['db_unsuported_feature'] = 'Unsupported feature of the database platform you are using.';
$lang['db_unsuported_compression'] = 'The file compression format you chose is not supported by your server.';
$lang['db_filepath_error'] = 'No es posible to write data to the file path you have submitted.';
$lang['db_invalid_cache_path'] = 'The cache path you submitted is not valid or writable.';
$lang['db_table_name_required'] = 'A table name is required for that operation.';
$lang['db_column_name_required'] = 'A column name is required for that operation.';
$lang['db_column_definition_required'] = 'A column definition is required for that operation.';
$lang['db_unable_to_set_charset'] = 'No es posible to set client connection character set: %s';
$lang['db_error_heading'] = 'A Database Error Occurred';

/* End of file db_lang.php */
/* Location: ./system/language/english/db_lang.php */