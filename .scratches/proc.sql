DO
$do$
DECLARE
_tbl text;
BEGIN
FOR _tbl  IN
SELECT quote_ident(table_schema) || '.'
           || quote_ident(table_name)      -- escape identifier and schema-qualify!
FROM   information_schema.tables
WHERE  table_name LIKE 'Temp' || '%'  -- your table name prefix
  AND  table_name LIKE 'TEMP' || '%'
  AND    table_schema NOT LIKE 'pg\_%'    -- exclude system schemas
    LOOP
   RAISE NOTICE '%',
-- EXECUTE
  'DROP TABLE ' || _tbl;  -- see below
END LOOP;
END
$do$;