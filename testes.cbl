      * ---------------------------------------------------
      *   Module Name: COBOLDB2.cbl
      *
      *   Description: Sample COBOL with Db2 program.
      *
      *   Purpose: Performs a Select on the employee table
      *   in the Sample database shipped with Db2.
      *
      *   COMPLILER OPTIONS (be sure to change the USERNAME and PASSWORD):
      *   DATA,EXIT(ADEXIT(FTTDBKW)),sql('database sample user USERNAME using PASSWORD')
      *
      *   SYSLIB:
      *   C:\Program Files\IBM\SQLLIB\INCLUDE\COBOL_A
      *
      *   ILINK OPTIONS:
      *   /de db2api.lib
      *
      * ---------------------------------------------------
       Identification Division.
       Program-ID.  COBOLDB2.

       Data Division.

      *Make sure you have SQLCA included in Working-Storage
       Working-Storage Section.
       EXEC SQL INCLUDE SQLCA END-EXEC.

      *Data structure to store the Firstname of the employee
       01 Program-pass-fields.
          05 Firstnme         Pic x(30).

       Procedure Division.
      *A Connection to the database must be made!
            EXEC SQL CONNECT TO sample END-EXEC.

      *Performs a SQL SELECT to get the firstname of the employee
      *with the employee number of 10.
           EXEC SQL SELECT firstnme INTO :Firstnme
           FROM employee
           WHERE empno = '000010' END-EXEC.

      *Displays the firstname we pulled from the Sample database.
           Display "Firstname"
           Display "========="
           Display Firstnme

           Display " "
      *Displays the status of the SQL statements
           Display SQLCA

           Goback.