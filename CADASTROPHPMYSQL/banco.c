#include <stdio.h>
#include <mysql.h>

int main(int argc, char **argv)
{
  MYSQL *conn = mysql_init(NULL);

  if (mysql_real_connect(conn, "localhost", "root", "1234",
          NULL, 0, NULL, 0) == NULL)
  {
      fprintf(stderr, "%s\n", mysql_error(conn));
      mysql_close(conn);
      exit(1);
  }

  if (mysql_query(conn, "CREATE DATABASE TWDATA"))
  {
      fprintf(stderr, "%s\n", mysql_error(conn));
      mysql_close(conn);
      exit(1);
  }

  mysql_close(conn);
  exit(0);
}
